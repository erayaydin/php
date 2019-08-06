<?php
if(isset($_POST["action"])){
    $baslik = $_POST["baslik"];
    $aciklama = $_POST["aciklama"];
    $durum  = $_POST["durum"];

    // Ekleme işlemini yap.
    $ekle = $db->prepare("INSERT INTO kategoriler(baslik, aciklama, durum) VALUES(:baslik, :aciklama, :durum)");
    $ekle->execute([
        "baslik" => $baslik,
        "aciklama" => $aciklama,
        "durum"  => $durum,
    ]);

    if($ekle) { // Başarılı ise...
        yonlendir("index.php?modul=kategori&sayfa=liste");
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Yeni Kategori Ekle</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Yeni Kategori Ekle
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="index.php?modul=kategori&sayfa=ekle">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" required name="baslik" value="<?php echo eski('baslik'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea rows="4" class="form-control" name="aciklama"><?php echo eski('aciklama'); ?></textarea>
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