<?php

// Post'tan gelen eski anahtarı döndürür. (Bir hata olduğunda tekrar alanları doldurmak için)
function post($anahtar) {
    if(isset($_POST[$anahtar])) // Eğer eski post varsa...
        return $_POST[$anahtar]; // O değeri döndür.
    else // Yoksa...
        return null; // Boş döndür.
}

// Belirli bir adrese yönlendirmeyi sağlayan fonksiyon
function yonlendir($url) {
    header("Location: ".$url);
}

// Hata gösterir
function hata($mesaj) {
    die("<h1>".$mesaj."</h1>");
}

function seciliMi($anahtar, $deger, $diger) {
    if(post($anahtar)){
        return post($anahtar) == $deger;
    } else {
        return $diger == $deger;
    }
}

function duzgunTarih($tarih) {
    $exp = explode("-", $tarih);
    return $exp[2].".".$exp[1].".".$exp[0];
}