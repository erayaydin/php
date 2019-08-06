<?php
$karikatur = $db->query("SELECT * FROM karikaturler WHERE id = ".$_GET['karikatur'])->fetch(PDO::FETCH_OBJ);

$cizer = $db->query("SELECT * FROM cizerler WHERE id = ".$karikatur->cizer_id)->fetch(PDO::FETCH_OBJ);
$gonderen = $db->query("SELECT * FROM kullanicilar WHERE id = ".$karikatur->kullanici_id)->fetch(PDO::FETCH_OBJ);

$liked = !$giris ? false : $db->query("SELECT * FROM kullanici_begenme WHERE kullanici_id = ".$giris->id." AND karikatur_id = ".$karikatur->id)->rowCount() > 0;
?>
<section class="home">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <?php echo $karikatur->baslik; ?>
                            <?php if($liked): ?>
                                <div class="pull-right unlike" data-id="<?php echo $karikatur->id; ?>"><?php echo $karikatur->begenme; ?> <i class="fa fa-heart"></i></div>
                            <?php else: ?>
                                <div class="pull-right like" data-id="<?php echo $karikatur->id; ?>"><?php echo $karikatur->begenme; ?> <i class="fa fa-heart-o"></i></div>
                            <?php endif; ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <img src="upload/karikatur/<?php echo $karikatur->id; ?>.png" class="img-responsive thumbnail">
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
            </div>
        </div>
    </div>
</section>