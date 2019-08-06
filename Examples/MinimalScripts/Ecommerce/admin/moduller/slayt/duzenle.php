<?php
if(!isset($_GET['slayt_id']))
    die("Slayt ID bulunamadı!");
$slayt = $db->query("SELECT * FROM slaytlar WHERE id = ".$_GET["slayt_id"])->fetch(PDO::FETCH_OBJ);
if(!$slayt)
    die("Slayt bulunamadı!");

if(isset($_POST["action"])){
    $baslik = $_POST["baslik"];
    $link = $_POST["link"];
    $durum  = $_POST["durum"];

    // Düzenleme işlemini yap.
    $duzenle = $db->prepare("UPDATE slaytlar SET baslik = :baslik, link = :link, durum = :durum WHERE id = :id");
    $duzenle->execute([
        "baslik" => $baslik,
        "link" => $link,
        "durum"  => $durum,
        "id" => $slayt->id,
    ]);

    if($duzenle) { // Başarılı ise...

        if(isset($_FILES["resim"])){
            move_uploaded_file($_FILES["resim"]["tmp_name"], __DIR__.'/../../../upload/slayt/'.$slayt->id.'.png');
        }

        yonlendir("index.php?modul=slayt&sayfa=liste");
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Slayt Düzenle</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Slayt Düzenle
            </div>
            <div class="panel-body">
                <form role="form" method="post" enctype="multipart/form-data" action="index.php?modul=slayt&sayfa=duzenle&slayt_id=<?php echo $slayt->id; ?>">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" required name="baslik" value="<?php echo $slayt->baslik; ?>">
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name="link" value="<?php echo $slayt->link; ?>">
                    </div>
                    <div class="form-group">
                        <label>Slayt Resmi</label>
                        <input type="file" required class="form-control" name="resim">
                        <span class="helper-block">Değiştirmek istemiyorsanız boş bırakın.</span>
                    </div>
                    <div class="form-group">
                        <label>Durum</label>
                        <label class="radio-inline">
                            <input type="radio" name="durum" id="durum1" value="1" <?php if($slayt->durum == 1): ?> checked <?php endif; ?>> Aktif
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="durum" id="durum0" value="0" <?php if($slayt->durum == 0): ?> checked <?php endif; ?>> Pasif
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