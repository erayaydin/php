<?php
if(isset($_GET["yer_id"])) {
    $yerId = $_GET["yer_id"];
    $yer = $db->query("SELECT * FROM yerler WHERE id = " . $yerId)->fetch(PDO::FETCH_OBJ);
    if (!$yer)
        hata("YER", "Yer bulunamadı!");

    $sil = $db->prepare("DELETE FROM yerler WHERE id = :id");
    $sil->execute([
            "id" => $yer->id
    ]);

    yonlendir("index.php?modul=yonetim/yer&sayfa=index");

} else {
    hata("YER", "YerID Belirtilmedi!");
}