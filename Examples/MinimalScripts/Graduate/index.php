<?php

/**
 * Mezun Takip Sistemi
 * ---
 * Author: Ahmetcan Doğan
 * Copyright 2017
 */

// Başlangıçta yapılacak işlemler
include "baslangic.php";

// Hangi modulün istendiğini öğren
$modul = isset($_GET['modul']) ? $_GET['modul'] : "ana"; // Eğer adreste ?modul= varsa onu al, yoksa varsayılan ana olsun.
$sayfa = isset($_GET['sayfa']) ? $_GET['sayfa'] : "index"; // Eğer adreste ?sayfa= varsa onu al, yoksa varsayılan index olsun.

// Üst kısmı çağır (header)
include "ust.php";

$sayfaDosya  = "moduller/".$modul."/sayfa.".$sayfa.".php";
if(file_exists($sayfaDosya)){ // Eğer istenilen sayfa mevcutsa...
    include_once $sayfaDosya; // O sayfayı göster
} else { // Yoksa...
    include_once "moduller/genel/sayfa.404.php"; // 404 hata sayfasını göster.
}

// Alt kısmı çağır (footer)
include "alt.php";

// Bitişte yapılacak işlemler
include "bitis.php";