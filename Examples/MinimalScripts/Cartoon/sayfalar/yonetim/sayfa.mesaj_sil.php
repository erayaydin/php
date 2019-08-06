<?php
$mesaj = $db->query("SELECT * FROM mesajlar WHERE id = ".$_GET['mesaj'])->fetch(PDO::FETCH_OBJ);

$delete = $db->prepare("DELETE FROM mesajlar WHERE id = :id");
$delete->execute([
    "id" => $mesaj->id
]);

yonlendir("index.php?modul=yonetim&sayfa=mesaj_index");