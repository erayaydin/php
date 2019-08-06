<?php
$uye = $db->query("SELECT * FROM kullanicilar WHERE id = ".$_GET['kullanici'])->fetch(PDO::FETCH_OBJ);

$delete = $db->prepare("DELETE FROM kullanicilar WHERE id = :id");
$delete->execute([
    "id" => $_GET['kullanici']
]);

yonlendir("index.php?modul=yonetim&sayfa=kullanici_index");