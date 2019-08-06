<?php
if(!isset($_GET['siparis_id']))
    die("Sipariş ID bulunamadı!");
$siparis = $db->query("SELECT * FROM siparisler WHERE id = ".$_GET["siparis_id"])->fetch(PDO::FETCH_OBJ);
if(!$siparis)
    die("Sipariş bulunamadı!");

$durum = $_GET['durum'];

$duzenle = $db->prepare("UPDATE siparisler SET durum = :durum WHERE id = ".$siparis->id);
$duzenle->execute([
    "durum" => $durum
]);

yonlendir("index.php?modul=siparis&sayfa=detay&siparis_id=".$siparis->id);