<?php
$kullaniciSayisi = $db->query("SELECT id FROM kullanicilar")->rowCount();
$konuSayisi = $db->query("SELECT id FROM konular")->rowCount();
$onaySayisi = $db->query("SELECT id FROM konular WHERE durum = 0")->rowCount();
$mesajSayisi = $db->query("SELECT id FROM mesajlar")->rowCount();
$okulSayisi = $db->query("SELECT id FROM okullar")->rowCount();
$bolumSayisi = $db->query("SELECT id FROM bolumler")->rowCount();
$meslekSayisi = $db->query("SELECT id FROM meslekler")->rowCount();
$yerSayisi = $db->query("SELECT id FROM yerler")->rowCount();
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="m-top text-center">Yönetim Paneli</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p>
                    <a href="index.php?modul=yonetim/kullanici&sayfa=index" class="btn btn-block btn-primary">
                        <i class="fa fa-users fa-3x"></i><br>
                        Kullanıcı Yönetimi <br>
                        <span class="label label-info"><?php echo $kullaniciSayisi; ?> Kullanıcı</span>
                    </a>
                </p>
            </div>
            <div class="col-md-4">
                <p>
                    <a href="index.php?modul=yonetim/konu&sayfa=index" class="btn btn-block btn-primary">
                        <i class="fa fa-paperclip fa-3x"></i><br>
                        Konu Yönetimi <br>
                        <span class="label label-info"><?php echo $konuSayisi; ?> Konu</span>
                        <span class="label label-warning"><?php echo $onaySayisi; ?> Onay Bekleyen Konu</span>
                    </a>
                </p>
            </div>
            <div class="col-md-4">
                <p>
                    <a href="index.php?modul=yonetim/mesaj&sayfa=index" class="btn btn-block btn-primary">
                        <i class="fa fa-send fa-3x"></i><br>
                        Mesaj Yönetimi <br>
                        <span class="label label-info"><?php echo $mesajSayisi; ?> Mesajlaşma</span>
                    </a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p>
                    <a href="index.php?modul=yonetim/okul&sayfa=index" class="btn btn-block btn-default">
                        <i class="fa fa-building fa-3x"></i><br>
                        Okullar <br>
                        <span class="label label-info"><?php echo $okulSayisi; ?> Okul</span>
                    </a>
                </p>
            </div>
            <div class="col-md-3">
                <p>
                    <a href="index.php?modul=yonetim/bolum&sayfa=index" class="btn btn-block btn-default">
                        <i class="fa fa-graduation-cap fa-3x"></i><br>
                        Bölümler <br>
                        <span class="label label-info"><?php echo $bolumSayisi; ?> Bölüm</span>
                    </a>
                </p>
            </div>
            <div class="col-md-3">
                <p>
                    <a href="index.php?modul=yonetim/meslek&sayfa=index" class="btn btn-block btn-default">
                        <i class="fa fa-briefcase fa-3x"></i><br>
                        Meslekler <br>
                        <span class="label label-info"><?php echo $meslekSayisi; ?> Meslek</span>
                    </a>
                </p>
            </div>
            <div class="col-md-3">
                <p>
                    <a href="index.php?modul=yonetim/yer&sayfa=index" class="btn btn-block btn-default">
                        <i class="fa fa-map-marker fa-3x"></i><br>
                        Yerler <br>
                        <span class="label label-info"><?php echo $yerSayisi; ?> Şehir</span>
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>