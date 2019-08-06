<section class="home">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Yönetim Paneli</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p>
                    <a href="index.php?modul=yonetim&sayfa=kullanici_index" class="btn btn-default btn-block">
                        <i class="fa fa-users fa-3x"></i><br>
                        KULLANICI YÖNETİMİ
                    </a>
                </p>
            </div>
            <div class="col-md-3">
                <p>
                    <a href="index.php?modul=yonetim&sayfa=karikatur_index" class="btn btn-default btn-block">
                        <i class="fa fa-photo fa-3x"></i><br>
                        KARİKATÜR YÖNETİMİ &nbsp;
                        <?php $pasifKar = $db->query("SELECT * FROM karikaturler WHERE durum = 0")->rowCount(); ?>
                        <?php if($pasifKar > 0): ?>
                            <span class="label label-primary"><?php echo $pasifKar; ?> Onay Bekleyen</span>
                        <?php endif; ?>
                    </a>
                </p>
            </div>
            <div class="col-md-3">
                <p>
                    <a href="index.php?modul=yonetim&sayfa=cizer_index" class="btn btn-default btn-block">
                        <i class="fa fa-user-circle-o fa-3x"></i><br>
                        ÇİZERLER
                    </a>
                </p>
            </div>
            <div class="col-md-3">
                <p>
                    <a href="index.php?modul=yonetim&sayfa=mesaj_index" class="btn btn-default btn-block">
                        <i class="fa fa-envelope fa-3x"></i><br>
                        İLETİŞİM MESAJLARI
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>