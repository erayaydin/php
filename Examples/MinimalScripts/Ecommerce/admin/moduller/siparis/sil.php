<?php

if(!isset($_GET['siparis_id']))
    die("Sipariş ID bulunamadı!");
$siparis = $db->query("SELECT * FROM siparisler WHERE id = ".$_GET["siparis_id"])->fetch(PDO::FETCH_OBJ);
if(!$siparis)
    die("Sipariş bulunamadı!");

$sil = $db->prepare("DELETE FROM siparisler WHERE id = :id");
$sil->execute([
    "id" => $siparis->id,
]);

if($sil) { // Başarılı ise...
    yonlendir("index.php?modul=siparis&sayfa=siparisler");
}