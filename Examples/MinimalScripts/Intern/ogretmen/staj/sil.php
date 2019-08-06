<?php

$stajSil = $db->prepare("DELETE FROM stajlar WHERE id = :id");
$stajSil->execute([
    "id" => $_GET['staj']
]);

yonlendir("index.php?modul=staj&dosya=liste");