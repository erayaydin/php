<?php

function yonlendir($adres) {
    // Belirtilen sayfaya yönlendirme yapar.
    header("Location: ".$adres);
}

function eski($isim) {
    // Post listesinde $isim alanının olup olmadığını kontrol eder,
    // varsa o değeri döndürür, yoksa boş döndürür.
    return isset($_POST[$isim]) ? $_POST[$isim] : null;
}