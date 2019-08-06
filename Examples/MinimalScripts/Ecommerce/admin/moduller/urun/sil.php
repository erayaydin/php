<?php

if(!isset($_GET['urun_id']))
    die("Ürün ID bulunamadı!");
$urun = $db->query("SELECT * FROM urunler WHERE id = ".$_GET["urun_id"])->fetch(PDO::FETCH_OBJ);
if(!$urun)
    die("Ürün bulunamadı!");

$sil = $db->prepare("DELETE FROM urunler WHERE id = :id");
$sil->execute([
    "id" => $urun->id,
]);

if($sil) { // Başarılı ise...
    yonlendir("index.php?modul=urun&sayfa=liste");
}