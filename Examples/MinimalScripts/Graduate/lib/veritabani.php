<?php

try {
    $db = new PDO('mysql:host='.ahmetVbAyar('host').';dbname='.ahmetVbAyar('veritabani'), ahmetVbAyar('kadi'), ahmetVbAyar('sifre'));
} catch (PDOException $e) { // Eğer bağlantı ile ilgili bir sorun olursa...
    switch($e->getCode()){
        case 2002: // Veritabanı adresi bulunamadı...
            mysqlHata("Veritabanı adresi hatalı veya MySQL kapalı.");
            break;

        case 1045: // Veritabanı kullanıcı adı veya şifre hatalı...
            mysqlHata("Veritabanı kullanıcı adı veya şifre hatalı!");
            break;

        case 1049: // Veritabanı bulunamadı hatası...
            mysqlHata("Veritabanı adı yanlış girilmiş veya veritabanı oluşturulmamış.");
            break;

        default: // Diğer hatalar için...
            mysqlHata($e->getMessage());
            break;
    }
}