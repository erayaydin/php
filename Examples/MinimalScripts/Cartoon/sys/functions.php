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

// MySQL hatasını gösterir.
function mysqlHata($mesaj) {
    hata("MySQL", $mesaj); // hata fonksiyonuna 'MySQL' başlığı ile hata mesajını ilet.
}

// Ölümcül hata gösterir.
function hata($baslik, $mesaj) {
    die("<h1>[".$baslik."] ".$mesaj."</h1>"); // die ile işlemi sonlandırdık.
}

function karikaturGoster($yeni) {
    global $db;
    global $giris;
    $cizer = $db->query("SELECT * FROM cizerler WHERE id = ".$yeni->cizer_id)->fetch(PDO::FETCH_OBJ);
    $gonderen = $db->query("SELECT * FROM kullanicilar WHERE id = ".$yeni->kullanici_id)->fetch(PDO::FETCH_OBJ);
    if($giris){
        $liked = $db->query("SELECT * FROM kullanici_begenme WHERE kullanici_id = ".$giris->id." AND karikatur_id = ".$yeni->id)->rowCount() > 0;
    } else {
        $liked = false;
    }
    ?>
    <div class="panel panel-default cartoon-box">
        <div class="panel-heading">
            <h3 class="panel-title">
                <?php echo substr($yeni->baslik, 0, 50); ?>
                <?php if($liked): ?>
                    <div class="pull-right unlike" data-id="<?php echo $yeni->id; ?>"><?php echo $yeni->begenme; ?> <i class="fa fa-heart"></i></div>
                <?php else: ?>
                    <div class="pull-right like" data-id="<?php echo $yeni->id; ?>"><?php echo $yeni->begenme; ?> <i class="fa fa-heart-o"></i></div>
                <?php endif; ?>
            </h3>
        </div>
        <div class="panel-body">
            <a href="index.php?modul=cartoon&sayfa=show&karikatur=<?php echo $yeni->id; ?>">
                <img src="upload/karikatur/<?php echo $yeni->id; ?>.png" class="img-responsive thumbnail">
            </a>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-6">
                                <span>
                                    <i class="fa fa-user-circle-o"></i> Çizer:
                                    <a href="index.php?modul=author&sayfa=show&cizer=<?php echo $cizer->id; ?>"><?php echo $cizer->name; ?></a>
                                </span>
                </div>
                <div class="col-md-6 text-right-md">
                                <span>
                                    <i class="fa fa-user"></i> Ekleyen:
                                    <a href="index.php?modul=uye&sayfa=show&uye=<?php echo $gonderen->kullaniciadi; ?>"><?php echo $gonderen->kullaniciadi; ?></a>
                                </span>
                </div>
            </div>
        </div>
    </div>
    <?php
}