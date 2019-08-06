<?php

// Session(oturum) yönetimini başlatalım (kullanıcı giriş kontrolü)
session_start();

// Tampon Önbelleklemeyi başlatalım (yönlendirme işleminin çalışmasını sağlayacak)
ob_start();

// Yazdığımız ek fonksiyonları içe aktaralım.
require '../sistem/fonksiyonlar.php';

// Ayar dosyasını içe aktaralım. (Veritabanı bilgileri, site bilgileri vs)
require '../ayar.php';

// Veritabanı bağlantısını sağlayalım
require '../sistem/veritabani.php';

$admin = null;
// Giriş yapan yöneticiyi al
if(isset($_SESSION["admin"])){
    $adminId = $_SESSION["admin"];
    $admin = $db->query("SELECT * FROM kullanicilar WHERE yonetici = 1 AND id = ".$adminId)->fetch(PDO::FETCH_OBJ);
}

if($admin) { // Sadece giriş yapanlar modül ve sayfaları görebilecek...
    // Hangi modulün istendiğini öğren
    $modul = isset($_GET['modul']) ? $_GET['modul'] : "pano"; // Eğer adreste ?modul= varsa onu al, yoksa varsayılan pano olsun.
    $sayfa = isset($_GET['sayfa']) ? $_GET['sayfa'] : "index"; // Eğer adreste ?sayfa= varsa onu al, yoksa varsayılan index olsun.

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
            echo "Sayfa bulunamadı!";
        }
    } else { // Eğer modül klasörü yoksa...
        echo "Modül bulunamadı!";
    }

    // Alt kısmı çağır
    include_once "alt.php";
} else { // Giriş yapmayan kişiler sadece giris'i görebilecek.
    include_once "giris.php";
}

// Tampon çıktısını boşaltalım.
ob_end_flush();