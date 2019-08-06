<?php

if(!isset($_GET['kategori_id']))
    die("Kategori ID bulunamadı!");
$kategori = $db->query("SELECT * FROM kategoriler WHERE id = ".$_GET["kategori_id"])->fetch(PDO::FETCH_OBJ);
if(!$kategori)
    die("Kategori bulunamadı!");

$sil = $db->prepare("DELETE FROM kategoriler WHERE id = :id");
$sil->execute([
    "id" => $kategori->id,
]);

if($sil) { // Başarılı ise...
    yonlendir("index.php?modul=kategori&sayfa=liste");
}