<?php

$giris = null; // Varsayılan olarak giriş yapılmamış olsun.
if(isset($_SESSION["giris"])){ // Eğer oturumda giriş yapılmışsa...
    $girisId = $_SESSION["giris"];
    // Giriş yapan kişinin bilgilerini çek
    $giris = $db->query("SELECT * FROM kullanicilar WHERE id = ".$girisId)->fetch(PDO::FETCH_OBJ);
}