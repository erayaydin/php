<?php
if(!isset($_GET["q"]) || empty($_GET["q"]))
    die("Sorgu boş olamaz.");

$q = "%".strtolower($_GET["q"])."%";

$urunler = $db->prepare("SELECT * FROM urunler WHERE baslik LIKE :baslik AND durum = 1 ORDER BY id DESC");
$urunler->bindParam("baslik", $q);
$urunler->execute();
$urunler = $urunler->fetchAll(PDO::FETCH_OBJ);
?>
<section class="kategori">
    <div class="container">
        <div class="row">
            <?php if(count($urunler) > 0): ?>
            <div class="col-md-12">
                <h3 class="text-center">'<?php echo htmlentities($_GET["q"]); ?>' Arama Sonucu</h3>
                <br>
            </div>
            <?php foreach($urunler as $urun): ?>
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
            <?php else: ?>
            <div class="alert alert-danger">
                <p>Arama sonucu bulunamadı.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>