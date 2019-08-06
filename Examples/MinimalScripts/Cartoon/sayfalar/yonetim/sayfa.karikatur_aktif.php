<?php
$karikatur = $db->query("SELECT * FROM karikaturler WHERE id = ".$_GET['karikatur'])->fetch(PDO::FETCH_OBJ);

$guncelle = $db->prepare("UPDATE karikaturler SET durum = 1 WHERE id = :id");
$guncelle->execute([
    "id" => $_GET['karikatur']
]);

yonlendir("index.php?modul=yonetim&sayfa=karikatur_index");