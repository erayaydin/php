<?php

if(!isset($_GET['sayfa_id']))
    die("Sayfa ID bulunamadı!");
$sayfa = $db->query("SELECT * FROM sayfalar WHERE id = ".$_GET["sayfa_id"])->fetch(PDO::FETCH_OBJ);
if(!$sayfa)
    die("Sayfa bulunamadı!");

$sil = $db->prepare("DELETE FROM sayfalar WHERE id = :id");
$sil->execute([
    "id" => $sayfa->id,
]);

if($sil) { // Başarılı ise...
    yonlendir("index.php?modul=sayfa&sayfa=liste");
}