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

// Veritabanında bulunan ayar bilgilerini çek (Yönetim Paneli > Site Ayarları)
$siteayar = $db->query("SELECT * FROM ayarlar LIMIT 0,1")->fetch(PDO::FETCH_OBJ);

$giris = null;
// Giriş yapan kullanıcıyı al
if(isset($_SESSION["giris"])){
    $girisId = $_SESSION["giris"];
    $giris = $db->query("SELECT * FROM kullanicilar WHERE id = ".$girisId)->fetch(PDO::FETCH_OBJ);
}

// Hangi modulün istendiğini öğren
$modul = isset($_GET['modul']) ? $_GET['modul'] : "anasayfa"; // Eğer adreste ?modul= varsa onu al, yoksa varsayılan anasayfa olsun.
$sayfa = isset($_GET['sayfa']) ? $_GET['sayfa'] : "listeleme"; // Eğer adreste ?sayfa= varsa onu al, yoksa varsayılan listeleme olsun.

// Üst kısmı çağır
include_once "ust.php";

/*
 * Kullanıcı hangi sayfayı istediyse onu göster...
 * ---------------------
 * Örneğin; Eğer kullanıcı 'urun' modulünden 'detay' sayfasını görmek istiyorsa
 * moduller/urun/detay.php dosyasını çağır.
 */
if(file_exists("moduller/".$modul)){ // Eğer modül klasörü varsa...
    if(file_exists("moduller/".$modul."/".$sayfa.".php")){ // Eğer modül klasörünün içinde aradığımız sayfa varsa...
        include_once("moduller/".$modul."/".$sayfa.".php"); // Kullanıcının istediği sayfayı göster.
    } else { // Aradığımız sayfa yoksa...
        include_once("moduller/genel/bulunamadi.php"); // 404 sayfasını göster.
    }
} else { // Eğer modül klasörü yoksa...
    include_once("moduller/genel/bulunamadi.php"); // 404 sayfasını göster.
}

// Alt kısmı çağır
include_once "alt.php";

// Tampon çıktısını boşaltalım.
ob_end_flush();