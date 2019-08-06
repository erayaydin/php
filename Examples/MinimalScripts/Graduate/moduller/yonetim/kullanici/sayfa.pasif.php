<?php
if(isset($_GET["kullanici_id"])) {
    $kullaniciId = $_GET["kullanici_id"];
    $kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = " . $kullaniciId)->fetch(PDO::FETCH_OBJ);
    if (!$kullanici)
        hata("KULLANICI", "Kullanıcı bulunamadı!");

    $pasif = $db->prepare("UPDATE kullanicilar SET durum = 0 WHERE id = :id");
    $pasif->execute([
            "id" => $kullanici->id
    ]);

    yonlendir("index.php?modul=yonetim/kullanici&sayfa=index");

} else {
    hata("KULLANICI", "KullanıcıID Belirtilmedi!");
}