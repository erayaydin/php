<?php

try {
    $db = new PDO('mysql:host='.$ayar["db"]['host'].';dbname='.$ayar["db"]["name"], $ayar["db"]["user"], $ayar["db"]["pass"]);
} catch (PDOException $e) { // Eğer bağlantı ile ilgili bir sorun olursa...
    switch($e->getCode()){
        case 2002: // Veritabanı adresi bulunamadı...
            hata("Veritabanı adresi hatalı veya MySQL kapalı.");
            break;

        case 1045: // Veritabanı kullanıcı adı veya şifre hatalı...
            hata("Veritabanı kullanıcı adı veya şifre hatalı!");
            break;

        case 1049: // Veritabanı bulunamadı hatası...
            hata("Veritabanı adı yanlış girilmiş veya veritabanı oluşturulmamış.");
            break;

        default: // Diğer hatalar için...
            hata($e->getMessage());
            break;
    }
}