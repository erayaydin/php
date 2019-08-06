<?php

$urunId = $_GET['urun_id'];

unset($_SESSION["sepet"][$urunId]);
yonlendir("index.php?modul=sepet&sayfa=goster");