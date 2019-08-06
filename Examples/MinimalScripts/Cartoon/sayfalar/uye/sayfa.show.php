<?php
$uye = $db->query("SELECT * FROM kullanicilar WHERE kullaniciadi = '".$_GET['uye']."'")->fetch(PDO::FETCH_OBJ);
$gonderdikleri = $db->query("SELECT * FROM karikaturler WHERE durum = 1 AND kullanici_id = '".$uye->id."' ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ);
$begendikleri = $db->query("SELECT * FROM kullanici_begenme WHERE kullanici_id = '".$uye->id."' ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ);
?>
<section class="home">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> <i class="fa fa-user"></i> <?php echo $uye->kullaniciadi; ?> KULLANICISININ GÖNDERDİĞİ KARİKATÜRLER</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if($gonderdikleri): ?>
            <?php foreach($gonderdikleri as $yeni): ?>
                <div class="col-md-4">
                    <?php karikaturGoster($yeni); ?>
                </div>
            <?php endforeach; ?>
            <?php else: ?>
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        <p>Henüz bu kullanıcının gönderdiği bir karikatür yok.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title"> <i class="fa fa-heart"></i> <?php echo $uye->kullaniciadi; ?> KULLANICISININ BEĞENDİĞİ KARİKATÜRLER</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if($begendikleri): ?>
            <?php foreach($begendikleri as $begenme): ?>
                <?php $yeni = $db->query("SELECT * FROM karikaturler WHERE id = ".$begenme->karikatur_id)->fetch(PDO::FETCH_OBJ); ?>
                <div class="col-md-4">
                    <?php karikaturGoster($yeni); ?>
                </div>
            <?php endforeach; ?>
            <?php else: ?>
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        <p>Henüz bu kullanıcının beğendiği bir karikatür yok.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>