<?php
if(!isset($_GET['kategori_id']))
    die("Kategori ID bulunamadı!");
$kategori = $db->query("SELECT * FROM kategoriler WHERE id = ".$_GET["kategori_id"])->fetch(PDO::FETCH_OBJ);
if(!$kategori)
    die("Kategori bulunamadı!");

if(isset($_POST["action"])){
    $baslik = $_POST["baslik"];
    $aciklama = $_POST["aciklama"];
    $durum  = $_POST["durum"];

    // Düzenleme işlemini yap.
    $duzenle = $db->prepare("UPDATE kategoriler SET baslik = :baslik, aciklama = :aciklama, durum = :durum WHERE id = :id");
    $duzenle->execute([
        "baslik" => $baslik,
        "aciklama" => $aciklama,
        "durum"  => $durum,
        "id" => $kategori->id,
    ]);

    if($duzenle) { // Başarılı ise...
        yonlendir("index.php?modul=kategori&sayfa=liste");
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Kategori Düzenle</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Kategori Düzenle
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="index.php?modul=kategori&sayfa=duzenle&kategori_id=<?php echo $kategori->id; ?>">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" required name="baslik" value="<?php echo $kategori->baslik; ?>">
                    </div>
                    <div class="form-group">
                        <label>İçerik</label>
                        <textarea rows="4" class="form-control" name="aciklama"><?php echo $kategori->aciklama; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Durum</label>
                        <label class="radio-inline">
                            <input type="radio" name="durum" id="durum1" value="1" <?php if($kategori->durum == 1): ?> checked <?php endif; ?>> Aktif
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="durum" id="durum0" value="0" <?php if($kategori->durum == 0): ?> checked <?php endif; ?>> Pasif
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