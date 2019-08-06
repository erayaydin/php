<?php

$adsoyad = $_POST["adsoyad"];
$email = $_POST["email"];
$telefon = $_POST["telefon"];
$adres = $_POST["adres"];

$kullanici = $giris ? $giris->id : null;
$tarih = date("Y-m-d H:i:s");

$siparis = $db->prepare("INSERT INTO siparisler(kullanici_id, adsoyad, eposta, telefon, adres, tarih, durum) VALUES(:kullanici, :adsoyad, :eposta, :telefon, :adres, :tarih, 0)");
$siparis->bindParam("kullanici", $kullanici);
$siparis->bindParam("adsoyad", $adsoyad);
$siparis->bindParam("eposta", $email);
$siparis->bindParam("telefon", $telefon);
$siparis->bindParam("adres", $adres);
$siparis->bindParam("tarih", $tarih);
$siparis->execute();

$siparisId = $db->lastInsertId();

foreach($_SESSION["sepet"] as $urunId => $sepet) {
    $siparisUrun = $db->prepare("INSERT INTO siparis_urunler(siparis_id, urun_id, adet) VALUES(:siparis, :urun, :adet)");
    $siparisUrun->bindParam("siparis", $siparisId);
    $siparisUrun->bindParam("urun", $urunId);
    $siparisUrun->bindParam("adet", $sepet["adet"]);
    $siparisUrun->execute();
}

unset($_SESSION["sepet"]);
yonlendir("index.php?sepet=ok");