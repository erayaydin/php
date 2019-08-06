<?php
/**
 * Ahmetcan Doğar Fonksiyonlar
 */

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

// Belirli veritabanı ayarını döndüren fonksiyon
function ahmetVbAyar($isim) {
    global $ayar;
    return $ayar["veritabani"][$isim];
}

// MySQL hatasını gösterir.
function mysqlHata($mesaj) {
    hata("MySQL", $mesaj); // hata fonksiyonuna 'MySQL' başlığı ile hata mesajını ilet.
}

// Ölümcül hata gösterir.
function hata($baslik, $mesaj) {
    die("<h1>[".$baslik."] ".$mesaj."</h1>"); // die ile işlemi sonlandırdık.
}

// Veritabanındaki site ayarlarından istenilen bilgiyi gösterir. (Site adı vs.)
function siteAyar($anahtar) {
    global $db;
    // Sorguyu yap
    $sorgu = $db->query("SELECT * FROM ayarlar WHERE anahtar = '".$anahtar."' LIMIT 0,1");

    if($sorgu) { // Eğer sorgu doğruysa...
        return $sorgu->fetch(PDO::FETCH_OBJ)->deger; // Değeri döndür
    } else { // Doğru değilse...
        return null; // Boş döndür
    }
}