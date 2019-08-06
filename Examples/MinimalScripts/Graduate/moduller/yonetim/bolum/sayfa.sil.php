<?php
if(isset($_GET["bolum_id"])) {
    $bolumId = $_GET["bolum_id"];
    $bolum = $db->query("SELECT * FROM bolumler WHERE id = " . $bolumId)->fetch(PDO::FETCH_OBJ);
    if (!$bolum)
        hata("BOLUM", "Bölüm bulunamadı!");

    $sil = $db->prepare("DELETE FROM bolumler WHERE id = :id");
    $sil->execute([
            "id" => $bolum->id
    ]);

    yonlendir("index.php?modul=yonetim/bolum&sayfa=index");

} else {
    hata("BOLUM", "BolumID Belirtilmedi!");
}