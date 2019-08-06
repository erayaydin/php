<?php
if(isset($_GET["yorum_id"])) {
    $yorumId = $_GET["yorum_id"];
    $yorum = $db->query("SELECT * FROM yorumlar WHERE id = " . $yorumId)->fetch(PDO::FETCH_OBJ);
    if (!$yorum)
        hata("YORUM", "Yorum bulunamadı!");

    $konuId = $yorum->konu_id;
    $sil = $db->prepare("DELETE FROM yorumlar WHERE id = :id");
    $sil->execute([
            "id" => $yorum->id
    ]);

    yonlendir("index.php?modul=konu&sayfa=detay&konu_id=".$konuId);

} else {
    hata("YORUM", "YorumID Belirtilmedi!");
}