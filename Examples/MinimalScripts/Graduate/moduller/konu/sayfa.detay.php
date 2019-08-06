<?php
if(isset($_GET["konu_id"])){
    $konuId = $_GET["konu_id"];
    $konu = $db->query("SELECT * FROM konular WHERE id = ".$konuId)->fetch(PDO::FETCH_OBJ);
    if(!$konu)
        hata("KONU", "Konu bulunamadı!");
    $kKul = $db->query("SELECT * FROM kullanicilar WHERE id = ".$konu->kullanici_id)->fetch(PDO::FETCH_OBJ);

    if(isset($_POST["yorum"])){
        $yorum = $_POST["yorum"];

        $ekle = $db->prepare("INSERT INTO yorumlar(konu_id,kullanici_id,mesaj,tarih) VALUES(:konu,:kullanici,:mesaj,:tarih)");
        $ekle->execute(["konu" => $konu->id, "kullanici" => $giris->id, "mesaj" => $yorum, "tarih" => date("Y-m-d H:i:s")]);
    }
} else {
    hata("KONU", "Konu ID belirtilmemiş");
}
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3 class="m-top"><?php echo $konu->baslik; ?></h3>
                <div class="row">
                    <div class="col-sm-2">
                        <div class="thumbnail avatar-kutu">
                            <img class="img-responsive user-photo" src="<?php echo $kKul->avatar; ?>">
                        </div><!-- /thumbnail -->
                    </div><!-- /col-sm-1 -->

                    <div class="col-sm-10">
                        <div class="panel panel-default panel-yorum">
                            <div class="panel-heading">
                                <strong><?php echo $kKul->kullaniciadi; ?></strong> <?php if($giris): ?> (<a href="index.php?modul=mesaj&sayfa=gonder&kullanici_id=<?php echo $kKul->id; ?>">Mesaj Gönder</a>) <?php endif; ?> <span class="text-muted pull-right"><?php echo date("d.m.Y H:i", strtotime($konu->tarih)); ?></span>
                            </div>
                            <div class="panel-body">
                                <?php echo nl2br($konu->mesaj); ?>
                            </div><!-- /panel-body -->
                        </div><!-- /panel panel-default -->
                    </div><!-- /col-sm-5 -->
                </div>
                <hr>
                <h4 id="yorumlar">Yorumlar</h4>
                <?php foreach($db->query("SELECT * FROM yorumlar WHERE konu_id = ".$konu->id)->fetchAll(PDO::FETCH_OBJ) as $yorum): ?>
                    <?php $yorumKul = $db->query("SELECT * FROM kullanicilar WHERE id = ".$yorum->kullanici_id)->fetch(PDO::FETCH_OBJ); ?>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="thumbnail avatar-kutu">
                                <img class="img-responsive user-photo" src="<?php echo $yorumKul->avatar; ?>">
                            </div><!-- /thumbnail -->
                        </div><!-- /col-sm-1 -->

                        <div class="col-sm-10">
                            <div class="panel panel-default panel-yorum">
                                <div class="panel-heading">
                                    <strong><?php echo $yorumKul->kullaniciadi; ?></strong>
                                    <?php if($giris): ?>
                                    (<a href="index.php?modul=mesaj&sayfa=gonder&kullanici_id=<?php echo $yorumKul->id; ?>">Mesaj Gönder</a>)
                                    <?php endif; ?>
                                    <?php if($giris && $giris->admin): ?>
                                        (<a href="index.php?modul=konu&sayfa=yorumSil&yorum_id=<?php echo $yorum->id; ?>">Sil</a>)
                                    <?php endif; ?>
                                    <span class="text-muted pull-right"><?php echo date("d.m.Y H:i", strtotime($yorum->tarih)); ?></span>
                                </div>
                                <div class="panel-body">
                                    <?php echo nl2br($yorum->mesaj); ?>
                                </div><!-- /panel-body -->
                            </div><!-- /panel panel-default -->
                        </div><!-- /col-sm-5 -->
                    </div>
                <?php endforeach; ?>
                <?php if($giris): ?>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Yorumunuz..." rows="4" name="yorum"></textarea>
                    </div>
                    <p class="text-right">
                        <button type="submit" class="btn btn-primary">Gönder <i class="fa fa-send"></i></button>
                    </p>
                </form>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <?php include "moduller/parca/yan.php"; ?>
            </div>
        </div>
    </div>
</section>