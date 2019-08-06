<?php
if(isset($_GET["okul_id"])) {
    $okulId = $_GET["okul_id"];
    $okul = $db->query("SELECT * FROM okullar WHERE id = " . $okulId)->fetch(PDO::FETCH_OBJ);
    if (!$okul)
        hata("OKUL", "Okul bulunamadı!");

    $sil = $db->prepare("DELETE FROM okullar WHERE id = :id");
    $sil->execute([
            "id" => $okul->id
    ]);

    yonlendir("index.php?modul=yonetim/okul&sayfa=index");

} else {
    hata("OKUL", "OkulID Belirtilmedi!");
}