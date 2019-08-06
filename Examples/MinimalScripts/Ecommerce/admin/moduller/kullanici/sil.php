<?php

if(!isset($_GET['kullanici_id']))
    die("Kullanıcı ID bulunamadı!");
$kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = ".$_GET["kullanici_id"])->fetch(PDO::FETCH_OBJ);
if(!$kullanici)
    die("Kullanıcı bulunamadı!");

$sil = $db->prepare("DELETE FROM kullanicilar WHERE id = :id");
$sil->execute([
    "id" => $kullanici->id,
]);

if($sil) { // Başarılı ise...
    yonlendir("index.php?modul=kullanici&sayfa=liste");
}