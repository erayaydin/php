<?php

foreach($_POST["urun"] as $id => $adet) {
    $_SESSION["sepet"][$id]["adet"] = $adet;
}
yonlendir("index.php?modul=sepet&sayfa=goster");