<?php
if(isset($_POST["action"])){
    $siteadi = $_POST["siteadi"];
    $telefon = $_POST["telefon"];
    $eposta  = $_POST["eposta"];
    $fax     = $_POST["fax"];
    $facebook = $_POST["facebook"];
    $twitter  = $_POST["twitter"];
    $google   = $_POST["google"];
    $pinterest = $_POST["pinterest"];
    $youtube = $_POST["youtube"];

    $update = $db->prepare("UPDATE ayarlar SET siteadi = :siteadi, telefon = :telefon, eposta = :eposta, 
fax = :fax, facebook = :facebook, twitter = :twitter, google = :google, pinterest = :pinterest, youtube = :youtube");
    $exec = $update->execute([
        "siteadi" => $siteadi,
        "telefon" => $telefon,
        "eposta"  => $eposta,
        "fax"     => $fax,
        "facebook" => $facebook,
        "twitter"  => $twitter,
        "google"   => $google,
        "pinterest" => $pinterest,
        "youtube"   => $youtube
    ]);
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Site Ayarları</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Site Ayarları
            </div>
            <div class="panel-body">
                <?php
                $ayar = $db->query("SELECT * FROM ayarlar LIMIT 0,1")->fetch(PDO::FETCH_OBJ);
                ?>
                <form role="form" method="post" action="index.php?modul=ayar&sayfa=ayar">
                    <div class="form-group">
                        <label>Site Adı</label>
                        <input class="form-control" name="siteadi" value="<?php echo $ayar->siteadi; ?>">
                    </div>
                    <div class="form-group">
                        <label>Telefon</label>
                        <input class="form-control" name="telefon" value="<?php echo $ayar->telefon; ?>">
                    </div>
                    <div class="form-group">
                        <label>E-Posta</label>
                        <input type="email" class="form-control" name="eposta" value="<?php echo $ayar->eposta; ?>">
                    </div>
                    <div class="form-group">
                        <label>Fax</label>
                        <input class="form-control" name="fax" value="<?php echo $ayar->fax; ?>">
                    </div>
                    <div class="form-group">
                        <label>Facebook Adresi</label>
                        <input class="form-control" name="facebook" value="<?php echo $ayar->facebook; ?>">
                    </div>
                    <div class="form-group">
                        <label>Twitter Adresi</label>
                        <input class="form-control" name="twitter" value="<?php echo $ayar->twitter; ?>">
                    </div>
                    <div class="form-group">
                        <label>Google+ Adresi</label>
                        <input class="form-control" name="google" value="<?php echo $ayar->google; ?>">
                    </div>
                    <div class="form-group">
                        <label>Pinterest Adresi</label>
                        <input class="form-control" name="pinterest" value="<?php echo $ayar->pinterest; ?>">
                    </div>
                    <div class="form-group">
                        <label>Youtube Adresi</label>
                        <input class="form-control" name="youtube" value="<?php echo $ayar->youtube; ?>">
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