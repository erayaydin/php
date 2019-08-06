<?php

class Database
{

    public $db;

    public function __construct($host, $user, $pass, $name) {
        try {
            $this->db = new PDO('mysql:host='.$host.';dbname='.$name, $user, $pass);
            $this->db->exec("set names utf8");
        } catch (PDOException $e) { // Eğer bağlantı ile ilgili bir sorun olursa...
            switch($e->getCode()){
                case 2002: // Veritabanı adresi bulunamadı...
                    die("Veritabanı adresi hatalı veya MySQL kapalı.");
                    break;

                case 1045: // Veritabanı kullanıcı adı veya şifre hatalı...
                    die("Veritabanı kullanıcı adı veya şifre hatalı!");
                    break;

                case 1049: // Veritabanı bulunamadı hatası...
                    die("Veritabanı adı yanlış girilmiş veya veritabanı oluşturulmamış.");
                    break;

                default: // Diğer hatalar için...
                    die($e->getMessage());
                    break;
            }
        }
    }
}