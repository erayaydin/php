<?php
if(isset($_GET["konu_id"])) {
    $konuId = $_GET["konu_id"];
    $konu = $db->query("SELECT * FROM konular WHERE id = " . $konuId)->fetch(PDO::FETCH_OBJ);
    if (!$konu)
        hata("KONU", "Konu bulunamadı!");

    $sil = $db->prepare("DELETE FROM konular WHERE id = :id");
    $sil->execute([
            "id" => $konu->id
    ]);

    yonlendir("index.php?modul=yonetim/konu&sayfa=index");

} else {
    hata("KONU", "KonuID Belirtilmedi!");
}