<?php
if(isset($_GET["mesaj_id"])){
    $mesajId = $_GET["mesaj_id"];
    $mesaj = $db->query("SELECT * FROM mesajlar WHERE id = ".$mesajId)->fetch(PDO::FETCH_OBJ);
    if(!$mesaj)
        hata("MESAJ", "Mesaj bulunamadı!");
    $gonderenKul = $db->query("SELECT * FROM kullanicilar WHERE id = ".$mesaj->gonderen_id)->fetch(PDO::FETCH_OBJ);
    $alanKul = $db->query("SELECT * FROM kullanicilar WHERE id = ".$mesaj->alan_id)->fetch(PDO::FETCH_OBJ);

    $mesajSahibi = null;
    if($gonderenKul->id == $giris->id){
        $mesajSahibi = $alanKul;
        $alan = $mesajSahibi->id;
    } else {
        $mesajSahibi = $gonderenKul;
        $alan = $mesajSahibi->id;
    }

    if(isset($_POST["cevap"])){
        $cevap = $_POST["cevap"];

        $gonderen = $giris->id;

        $ekle = $db->prepare("INSERT INTO mesajlar(gonderen_id,alan_id,mesaj,tarih) VALUES(:gonderen,:alan,:mesaj,:tarih)");
        $ekle->execute(["gonderen" => $gonderen, "alan" => $mesajSahibi->id, "mesaj" => $cevap, "tarih" => date("Y-m-d H:i:s")]);
        yonlendir("index.php?modul=mesaj&sayfa=index");
    }
} else {
    hata("MESAJ", "Mesaj ID belirtilmemiş");
}
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="thumbnail avatar-kutu">
                            <img class="img-responsive user-photo" src="<?php echo $gonderenKul->avatar; ?>">
                        </div><!-- /thumbnail -->
                    </div><!-- /col-sm-1 -->

                    <div class="col-sm-10">
                        <div class="panel panel-default panel-yorum">
                            <div class="panel-heading">
                                <strong><?php echo $gonderenKul->kullaniciadi; ?></strong> -> <strong><?php echo $alanKul->kullaniciadi; ?></strong> <span class="text-muted pull-right"><?php echo date("d.m.Y H:i", strtotime($mesaj->tarih)); ?></span>
                            </div>
                            <div class="panel-body">
                                <?php echo nl2br($mesaj->mesaj); ?>
                            </div><!-- /panel-body -->
                        </div><!-- /panel panel-default -->
                    </div><!-- /col-sm-5 -->
                </div>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Cevabınız..." rows="4" name="cevap"></textarea>
                    </div>
                    <p class="text-right">
                        <button type="submit" class="btn btn-primary">Gönder <i class="fa fa-send"></i></button>
                    </p>
                </form>
            </div>
            <div class="col-md-4">
                <?php include "moduller/parca/yan.php"; ?>
            </div>
        </div>
    </div>
</section>