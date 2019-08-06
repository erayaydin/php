<?php

// Session(oturum) yönetimini başlatalım (kullanıcı giriş kontrolü)
session_start();

// Tampon Önbelleklemeyi başlatalım (yönlendirme işleminin çalışmasını sağlayacak)
ob_start();

// Yazdığımız ek fonksiyonları içe aktaralım.
require 'sistem/fonksiyonlar.php';

// Ayar dosyasını içe aktaralım. (Veritabanı bilgileri, site bilgileri vs)
require 'ayar.php';

// Veritabanı bağlantısını sağlayalım
require 'sistem/veritabani.php';

$islem = $_GET['islem'];

switch($islem) {
    case "ekle":
        $yeniUrunId = $_POST["urun_id"];

        $adet = isset($_POST["adet"]) ? $_POST["adet"] : 1;

        if(isset($_SESSION["sepet"][$yeniUrunId])){
            $_SESSION["sepet"][$yeniUrunId]["adet"] += $adet;
        } else {
            $_SESSION["sepet"][$yeniUrunId] = [
                "urun_id" => $yeniUrunId,
                "adet" => $adet
            ];
        }
        break;

    case "sil":
        $urunId = $_POST['urun_id'];

        if(isset($_SESSION["sepet"][$urunId]))
            unset($_SESSION["sepet"][$urunId]);
        break;
}

// Sepette kalan ürünleri göster
$return = [];
foreach($_SESSION["sepet"] as $key => $sepet) {
    $urun = $db->query("SELECT * FROM urunler WHERE id = ".$sepet['urun_id'])->fetch(PDO::FETCH_OBJ);
    $return[$key] = [
        "id" => $urun->id,
        "adet" => $sepet['adet'],
        "baslik" => $urun->baslik,
        "fiyat" => number_format($urun->fiyat, 2),
    ];
}

header('Content-type: application/json');
echo json_encode($return);