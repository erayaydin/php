<?php
if(isset($_GET["mesaj_id"])) {
    $mesajID = $_GET["mesaj_id"];
    $mesaj = $db->query("SELECT * FROM mesajlar WHERE id = " . $mesajID)->fetch(PDO::FETCH_OBJ);
    if (!$mesaj)
        hata("MESAJ", "Mesaj bulunamadı!");

    $sil = $db->prepare("DELETE FROM mesajlar WHERE id = :id");
    $sil->execute([
            "id" => $mesaj->id
    ]);

    yonlendir("index.php?modul=yonetim/mesaj&sayfa=index");

} else {
    hata("MESAJ", "MesajID Belirtilmedi!");
}