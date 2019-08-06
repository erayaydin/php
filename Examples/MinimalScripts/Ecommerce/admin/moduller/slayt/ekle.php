<?php
if(isset($_POST["action"])){
    $baslik = $_POST["baslik"];
    $link = $_POST["link"];
    $durum  = $_POST["durum"];

    // Ekleme işlemini yap.
    $ekle = $db->prepare("INSERT INTO slaytlar(baslik, link, durum) VALUES(:baslik, :link, :durum)");
    $ekle->execute([
        "baslik" => $baslik,
        "link" => $link,
        "durum"  => $durum,
    ]);

    if($ekle) { // Başarılı ise...
        $ekleId = $db->lastInsertId();

        move_uploaded_file($_FILES['resim']['tmp_name'], __DIR__.'/../../../upload/slayt/'.$ekleId.'.png');
        yonlendir("index.php?modul=slayt&sayfa=liste");
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Yeni Slayt Ekle</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Yeni Slayt Ekle
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="index.php?modul=slayt&sayfa=ekle" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" required name="baslik" value="<?php echo eski('baslik'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name="link" value="<?php echo eski('link'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Slayt Resmi</label>
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