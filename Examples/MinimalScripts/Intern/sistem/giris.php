<?php

$giris = null;
if(isset($_SESSION["giris"]))
    $giris = $db->query("SELECT * FROM kullanicilar WHERE id = ".$_SESSION['giris'])->fetch(PDO::FETCH_OBJ);