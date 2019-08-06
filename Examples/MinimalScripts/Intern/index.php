<?php

session_start();
ob_start();

include "ayar.php";
include "sistem/fonksiyonlar.php";
include "sistem/veritabani.php";
include "sistem/giris.php";

if($giris){
    $sistem = $giris->tur;
} else {
    $sistem = isset($_GET['sistem']) ? $_GET['sistem'] : "ogrenci";
}
$modul  = isset($_GET['modul']) ? $_GET['modul'] : "pano";
$dosya  = isset($_GET['dosya']) ? $_GET['dosya'] : "index";

include "ust.php";

if(!$giris){
    include $sistem."/giris.php";
} else {
    if($sistem == "ogrenci" && $giris->tur == 'ogretmen'){
        hata('Bu sayfayı görüntüleme yetkiniz yok.');
    }
    if($sistem == "ogretmen" && $giris->tur == 'ogrenci'){
        hata('Bu sayfayı görüntüleme yetkiniz yok.');
    }

    include $sistem."/".$modul."/".$dosya.".php";
}

include "alt.php";