<?php

if(!isset($_GET['slayt_id']))
    die("Slayt ID bulunamadı!");
$slayt = $db->query("SELECT * FROM slaytlar WHERE id = ".$_GET["slayt_id"])->fetch(PDO::FETCH_OBJ);
if(!$slayt)
    die("Slayt bulunamadı!");

$sil = $db->prepare("DELETE FROM slaytlar WHERE id = :id");
$sil->execute([
    "id" => $slayt->id,
]);

if($sil) { // Başarılı ise...
    yonlendir("index.php?modul=slayt&sayfa=liste");
}