<?php

session_start(); // Oturum yönetimini başlat. (giriş işlemleri için)

include "ayar.php"; // Veritabanı bilgilerini alalım.
include "sys/functions.php"; // Kendi tarafımdan yazılan özel fonksiyonların bulunduğu dosya.
include "sys/database.php"; // Veritabanı bağlantısını yapalım.
include "sys/login.php"; // Giriş kontrolü.

if($db->query("SELECT * FROM kullanici_begenme WHERE kullanici_id = ".$giris->id." AND karikatur_id = ".$_POST["id"])->rowCount() == 0){
    $query = $db->prepare("INSERT INTO kullanici_begenme(kullanici_id,karikatur_id) VALUES(:kullanici,:karikatur)");
    $query->execute([
        "kullanici" => $giris->id,
        "karikatur" => $_POST["id"]
    ]);

    $karikatur = $db->query("SELECT * FROM karikaturler WHERE id = ".$_POST["id"])->fetch(PDO::FETCH_OBJ);
    $query = $db->prepare("UPDATE karikaturler SET begenme = :begenme WHERE id = ".$karikatur->id);
    $query->execute([
        "begenme" => $karikatur->begenme+1
    ]);

    $totalLike = $db->query("SELECT * FROM kullanici_begenme WHERE karikatur_id = ".$karikatur->id)->rowCount();

    header('Content-Type: application/json');
    echo json_encode(["like" => $totalLike]);
}