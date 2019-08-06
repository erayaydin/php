<?php

session_start(); // Oturum kontrolünü başlat. (kullanıcı giriş yapabilmesi için)
ob_start(); // Tamponlamayı başlat. (yönlendirme yapabilmek için)

include "ayarlar.php"; // Veritabanı ayar bilgileri
include "lib/fonksiyonlar.php"; // Kendi yazdığım fonksiyonlar
include "lib/veritabani.php"; // Veritabanı bağlantısını sağla

$giris = null; // Varsayılan olarak giriş yapılmamış olsun.
if(isset($_SESSION["giris"])){ // Eğer oturumda giriş yapılmışsa...
    $girisId = $_SESSION["giris"];
    // Giriş yapan kişinin bilgilerini çek
    $giris = $db->query("SELECT * FROM kullanicilar WHERE id = ".$girisId)->fetch(PDO::FETCH_OBJ);
}