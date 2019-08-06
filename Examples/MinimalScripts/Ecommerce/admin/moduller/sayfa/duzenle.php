<?php
if(!isset($_GET['sayfa_id']))
    die("Sayfa ID bulunamadı!");
$sayfa = $db->query("SELECT * FROM sayfalar WHERE id = ".$_GET["sayfa_id"])->fetch(PDO::FETCH_OBJ);
if(!$sayfa)
    die("Sayfa bulunamadı!");

if(isset($_POST["action"])){
    $baslik = $_POST["baslik"];
    $icerik = $_POST["icerik"];
    $durum  = $_POST["durum"];

    // Düzenleme işlemini yap.
    $duzenle = $db->prepare("UPDATE sayfalar SET baslik = :baslik, icerik = :icerik, durum = :durum WHERE id = :id");
    $duzenle->execute([
        "baslik" => $baslik,
        "icerik" => $icerik,
        "durum"  => $durum,
        "id" => $sayfa->id,
    ]);

    if($duzenle) { // Başarılı ise...
        yonlendir("index.php?modul=sayfa&sayfa=liste");
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Sayfa Düzenle</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Sayfa Düzenle
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="index.php?modul=sayfa&sayfa=duzenle&sayfa_id=<?php echo $sayfa->id; ?>">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" required name="baslik" value="<?php echo $sayfa->baslik; ?>">
                    </div>
                    <div class="form-group">
                        <label>İçerik</label>
                        <textarea rows="8" class="form-control" name="icerik"><?php echo $sayfa->icerik; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Durum</label>
                        <label class="radio-inline">
                            <input type="radio" name="durum" id="durum1" value="1" <?php if($sayfa->durum == 1): ?> checked <?php endif; ?>> Aktif
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="durum" id="durum0" value="0" <?php if($sayfa->durum == 0): ?> checked <?php endif; ?>> Pasif
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