<?php
if(isset($_GET["meslek_id"])) {
    $meslekId = $_GET["meslek_id"];
    $meslek = $db->query("SELECT * FROM meslekler WHERE id = " . $meslekId)->fetch(PDO::FETCH_OBJ);
    if (!$meslek)
        hata("MESLEK", "Meslek bulunamadı!");

    $sil = $db->prepare("DELETE FROM meslekler WHERE id = :id");
    $sil->execute([
            "id" => $meslek->id
    ]);

    yonlendir("index.php?modul=yonetim/meslek&sayfa=index");

} else {
    hata("MESLEK", "MeslekID Belirtilmedi!");
}