<?php
if(!isset($_GET['kategori_id']))
    die("Kategori ID bulunamadı!");
$kategori = $db->query("SELECT * FROM kategoriler WHERE id = ".$_GET["kategori_id"])->fetch(PDO::FETCH_OBJ);
if(!$kategori)
    die("Kategori bulunamadı!");
?>
<section class="kategori">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center"><?php echo $kategori->baslik; ?></h3>
                <br>
            </div>
            <?php foreach($db->query("SELECT * FROM urunler WHERE kategori_id = '".$kategori->id."' AND durum = 1 ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ) as $urun): ?>
            <div class="col-md-3">
                <div class="well product-box">
                    <a href="index.php?modul=urun&sayfa=detay&urun_id=<?php echo $urun->id; ?>" title="<?php echo $urun->baslik; ?>">
                        <img src="upload/urun/<?php echo $urun->id; ?>.png" class="img-responsive" />
                    </a>
                    <div class="product-info">
                        <h3><a href="index.php?modul=urun&sayfa=detay&urun_id=<?php echo $urun->id; ?>" title="<?php echo $urun->baslik; ?>"><?php echo $urun->baslik; ?></a></h3>
                        <p><a href="index.php?modul=urun&sayfa=detay&urun_id=<?php echo $urun->id; ?>" class="label label-primary"><?php echo number_format($urun->fiyat, 2); ?> <i class="fa fa-try"></i></a></p>
                        <hr>
                        <p class="text-center">
                            <button class="btn btn-sm btn-default add-to-cart" data-id="<?php echo $urun->id; ?>"><i class="fa fa-shopping-cart"></i> Sepete Ekle</button> &nbsp;
                            <a href="index.php?modul=urun&sayfa=detay&urun_id=<?php echo $urun->id; ?>" class="btn btn-sm btn-primary"><i class="fa fa-bolt"></i> Detaylar</a>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>