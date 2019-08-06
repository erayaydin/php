<?php
$karikatur = $db->query("SELECT * FROM karikaturler WHERE id = ".$_GET['karikatur'])->fetch(PDO::FETCH_OBJ);

$delete = $db->prepare("DELETE FROM karikaturler WHERE id = :id");
$delete->execute([
    "id" => $_GET['karikatur']
]);

yonlendir("index.php?modul=yonetim&sayfa=karikatur_index");