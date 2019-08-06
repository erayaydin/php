<?php
if(!isset($_GET['urun_id']))
    die("Ürün ID bulunamadı!");
$urun = $db->query("SELECT * FROM urunler WHERE id = ".$_GET["urun_id"])->fetch(PDO::FETCH_OBJ);
if(!$urun)
    die("Ürün bulunamadı!");

$gor = $db->prepare("UPDATE urunler SET goruntulenme = :goruntulenme");
$gor->execute([
    "goruntulenme" => $urun->goruntulenme+1
]);

$kategori = $db->query("SELECT * FROM kategoriler WHERE id = ".$urun->kategori_id)->fetch(PDO::FETCH_OBJ);
?>
<section class="urun">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 urun-resim">
                <img src="http://placehold.it/800x400" class="img-responsive" />
            </div>
            <div class="col-xs-6 urun-detay">
                <h3 class="urun-baslik"><?php echo $urun->baslik; ?></h3>
                <?php
                $kategoriToplamUrun = $db->query("SELECT id FROM urunler WHERE kategori_id = ".$kategori->id)->rowCount();
                ?>
                <h5 class="urun-kategori"><a href="index.php?modul=kategori&sayfa=goster&kategori_id=<?php echo $kategori->id; ?>"><?php echo $kategori->baslik; ?></a> · <small>(<?php echo $kategoriToplamUrun; ?> ürün)</small></h5>

                <!-- Precios -->
                <h6 class="urun-ucret"><small>Fiyat</small></h6>
                <h3 class="urun-baslik"><?php echo number_format($urun->fiyat, 2); ?> <i class="fa fa-try"></i></h3>

                <h6><small>Adet</small></h6>
                <div class="input-group" style="width: 200px; margin-bottom: 20px;">
                    <span class="input-group-btn">
                        <button class="btn btn-default sepet-ekle-azalt" type="button"><i class="fa fa-minus"></i></button>
                    </span>
                    <input type="text" class="form-control sepet-ekle-adet" style="width: 150px;" value="1">
                    <span class="input-group-btn">
                        <button class="btn btn-default sepet-ekle-arttir" type="button"><i class="fa fa-plus"></i></button>
                    </span>
                </div><!-- /input-group -->

                <!-- Botones de compra -->
                <div class="section" style="padding-bottom:20px;">
                    <button class="btn btn-success sepet-coklu-ekle" data-id="<?php echo $urun->id; ?>"><span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Sepete Ekle</button>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#aciklama" aria-controls="aciklama" role="tab" data-toggle="tab">Açıklama</a></li>
                    <li role="presentation"><a href="#detay" aria-controls="detay" role="tab" data-toggle="tab">Detaylar</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content" style="padding: 20px; border-left: 1px solid #e7e7e7; border-bottom: 1px solid #e7e7e7; border-right: 1px solid #e7e7e7;">
                    <div role="tabpanel" class="tab-pane active" id="aciklama">
                        <?php echo $urun->aciklama; ?>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="detay">
                        <?php echo $urun->icerik; ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</section>