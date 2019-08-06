<?php

/**
 * Cartoon Project
 *
 * Author: Azra Mısır
 * IDE: PHPStorm
 * Year: 2017
 */

session_start(); // Oturum yönetimini başlat. (giriş işlemleri için)
ob_start(); // Tampon önbelleklemeyi başlat. (yönlendirme işlemleri için)

include "ayar.php"; // Veritabanı bilgilerini alalım.
include "sys/functions.php"; // Kendi tarafımdan yazılan özel fonksiyonların bulunduğu dosya.
include "sys/database.php"; // Veritabanı bağlantısını yapalım.
include "sys/login.php"; // Giriş kontrolü.

// Hangi modulün istendiğini öğren
$modul = isset($_GET['modul']) ? $_GET['modul'] : "home"; // Eğer adreste ?modul= varsa onu al, yoksa varsayılan ana olsun.
$sayfa = isset($_GET['sayfa']) ? $_GET['sayfa'] : "index"; // Eğer adreste ?sayfa= varsa onu al, yoksa varsayılan index olsun.

// Header'ı çağır
include "header.php";

$sayfaDosya  = "sayfalar/".$modul."/sayfa.".$sayfa.".php";
if(file_exists($sayfaDosya)){ // Eğer istenilen sayfa mevcutsa...
    include_once $sayfaDosya; // O sayfayı göster
} else { // Yoksa...
    include_once "sayfalar/genel/sayfa.404.php"; // 404 hata sayfasını göster.
}

// Footer'ı çağır
include "footer.php";

ob_end_flush(); // Tampon önbelleğini boşalt. (Yönlendirme varsa yap, yoksa çıktıyı göster)