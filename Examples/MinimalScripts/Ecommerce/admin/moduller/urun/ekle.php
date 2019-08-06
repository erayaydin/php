<?php
if(isset($_POST["action"])){
    $baslik = $_POST["baslik"];
    $aciklama = $_POST["aciklama"];
    $icerik = $_POST["icerik"];
    $fiyat = $_POST["fiyat"];
    $kategori_id = $_POST["kategori_id"];
    $durum  = $_POST["durum"];

    // Ekleme işlemini yap.
    $ekle = $db->prepare("INSERT INTO urunler(baslik, aciklama, icerik, durum, fiyat, goruntulenme, kategori_id) VALUES(:baslik, :aciklama, :icerik, :durum, :fiyat, :goruntulenme, :kategori)");
    $ekle->execute([
        "baslik" => $baslik,
        "aciklama" => $aciklama,
        "icerik" => $icerik,
        "durum"  => $durum,
        "fiyat" => $fiyat,
        "goruntulenme" => 0,
        "kategori" => $kategori_id
    ]);

    if($ekle) { // Başarılı ise...

        $ekleId = $db->lastInsertId();
        move_uploaded_file($_FILES['resim']['tmp_name'], __DIR__.'/../../../upload/urun/'.$ekleId.'.png');

        yonlendir("index.php?modul=urun&sayfa=liste");
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Yeni Ürün Ekle</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Yeni Ürün Ekle
            </div>
            <div class="panel-body">
                <form role="form" enctype="multipart/form-data" method="post" action="index.php?modul=urun&sayfa=ekle">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" required name="baslik" value="<?php echo eski('baslik'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea rows="4" class="form-control" name="aciklama"><?php echo eski('aciklama'); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>İçerik</label>
                        <textarea rows="8" class="form-control" name="icerik"><?php echo eski('icerik'); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Fiyat</label>
                        <input class="form-control" required name="fiyat" value="<?php echo eski('fiyat'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori_id" required>
                            <option>Kategori Seçiniz</option>
                            <?php foreach($db->query("SELECT * FROM kategoriler ORDER BY baslik ASC")->fetchAll(PDO::FETCH_OBJ) as $cat): ?>
                                <option value="<?php echo $cat->id; ?>"><?php echo $cat->baslik; ?></option>
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
                            <input type="radio" name="durum" id="durum1" value="1" checked> Aktif
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="durum" id="durum0" value="0"> Pasif
                        </label>
                    </div>
                    <button name="action" value="kaydet" type="submit" class="btn btn-primary">Oluştur</button>
                </form>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->