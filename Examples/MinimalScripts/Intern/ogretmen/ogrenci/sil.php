<?php

$kulSil = $db->prepare("DELETE FROM kullanicilar WHERE id = :id");
$kulSil->execute([
    "id" => $_GET['ogrenci']
]);

$ogr = $db->query("SELECT * FROM ogrenciler WHERE kullanici_id = '".$_GET['ogrenci']."'")->fetch(PDO::FETCH_OBJ);

$ogrSil = $db->prepare("DELETE FROM ogrenciler WHERE id = :id");
$ogrSil->execute([
    "id" => $ogr->id
]);

$stajSil = $db->prepare("DELETE FROM stajlar WHERE ogrenci_id = :ogrenci");
$stajSil->execute([
    "ogrenci" => $ogr->id
]);

yonlendir("index.php?modul=ogrenci&dosya=liste");