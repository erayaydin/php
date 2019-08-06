<?php
$cizer = $db->query("SELECT * FROM cizerler WHERE id = ".$_GET['cizer'])->fetch(PDO::FETCH_OBJ);

$delete = $db->prepare("DELETE FROM cizerler WHERE id = :id");
$delete->execute([
    "id" => $_GET['cizer']
]);

yonlendir("index.php?modul=yonetim&sayfa=cizer_index");