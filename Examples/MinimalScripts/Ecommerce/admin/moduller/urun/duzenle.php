<?php
if(!isset($_GET['urun_id']))
    die("Ürün ID bulunamadı!");
$urun = $db->query("SELECT * FROM urunler WHERE id = ".$_GET["urun_id"])->fetch(PDO::FETCH_OBJ);
if(!$urun)
    die("Ürün bulunamadı!");

if(isset($_POST["action"])){
    $baslik = $_POST["baslik"];
    $aciklama = $_POST["aciklama"];
    $icerik = $_POST["icerik"];
    $fiyat = $_POST["fiyat"];
    $kategori_id = $_POST["kategori_id"];
    $durum  = $_POST["durum"];

    // Düzenleme işlemini yap.
    $duzenle = $db->prepare("UPDATE urunler SET baslik = :baslik, aciklama = :aciklama, icerik = :icerik, durum = :durum, fiyat = :fiyat, kategori_id = :kategori WHERE id = :id");
    $duzenle->execute([
        "baslik" => $baslik,
        "aciklama" => $aciklama,
        "icerik" => $icerik,
        "durum"  => $durum,
        "fiyat" => $fiyat,
        "kategori" => $kategori_id,
        "id" => $urun->id,
    ]);

    if($duzenle) { // Başarılı ise...

        if(isset($_FILES["resim"])){
            move_uploaded_file($_FILES["resim"]["tmp_name"], __DIR__.'/../../../upload/urun/'.$urun->id.'.png');
        }

        yonlendir("index.php?modul=urun&sayfa=liste");
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Ürün Düzenle</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Ürün Düzenle
            </div>
            <div class="panel-body">
                <form role="form" enctype="multipart/form-data" method="post" action="index.php?modul=urun&sayfa=duzenle&urun_id=<?php echo $urun->id; ?>">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" required name="baslik" value="<?php echo $urun->baslik; ?>">
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea rows="4" class="form-control" name="aciklama"><?php echo $urun->aciklama; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>İçerik</label>
                        <textarea rows="8" class="form-control" name="icerik"><?php echo $urun->icerik; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Fiyat</label>
                        <input class="form-control" required name="fiyat" value="<?php echo $urun->fiyat; ?>">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori_id" required>
                            <option>Kategori Seçiniz</option>
                            <?php foreach($db->query("SELECT * FROM kategoriler ORDER BY baslik ASC")->fetchAll(PDO::FETCH_OBJ) as $cat): ?>
                                <option <?php if($urun->kategori_id == $cat->id): // Eğer bu kategori bizim ürünümüzün kategorisi ise seçili yap ?> selected <?php endif; ?> value="<?php echo $cat->id; ?>"><?php echo $cat->baslik; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ürün Resmi</label>
                        <input type="file" required class="form-control" name="resim">
                    </div>
                    <div class="form-group">
                        <label>Durum</label>
                        <label class="radio-inline">
                            <input type="radio" name="durum" id="durum1" value="1" <?php if($urun->durum == 1): ?> checked <?php endif; ?>> Aktif
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="durum" id="durum0" value="0" <?php if($urun->durum == 0): ?> checked <?php endif; ?>> Pasif
                        </label>
                    </div>
                    <button name="action" value="guncelle" type="submit" class="btn btn-primary">Güncelle</button>
                </form>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->