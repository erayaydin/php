<?php

try {
    // Veritabanı bilgilerini ayar değişkeninden çek (ayar.php den geliyor)
    $dbConfig = $ayar["veritabani"];
    // Veritabanı bağlantısını yap.
    $db = new PDO('mysql:host='.$dbConfig['host'].';dbname='.$dbConfig['name'], $dbConfig['user'], $dbConfig['pass']);
} catch (PDOException $e) { // Eğer bağlantı ile ilgili bir sorun olursa...
    switch($e->getCode()){
        case 2002: // Veritabanı adresi bulunamadı...
            die("<h1>MySQL: Veritabanı adresi bulunamadı!</h1>");
            break;

        case 1045: // Veritabanı kullanıcı adı veya şifre hatalı...
            die("<h1>MySQL: Veritabanı kullanıcı adı veya şifre hatalı!</h1>");
            break;

        case 1049: // Veritabanı bulunamadı hatası...
            die("<h1>MySQL: Veritabanı adı hatalı!</h1>");
            break;

        default: // Diğer hatalar için...
            die("<h1>MySQL: Bir hata oluştu!</h1><h2>Hata Mesajı: ".$e->getMessage()."</h2>");
            break;
    }
}