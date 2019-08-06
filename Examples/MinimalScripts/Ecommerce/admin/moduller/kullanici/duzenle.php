<?php
if(!isset($_GET['kullanici_id']))
    die("Kullanıcı ID bulunamadı!");
$kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = ".$_GET["kullanici_id"])->fetch(PDO::FETCH_OBJ);
if(!$kullanici)
    die("Kullanıcı bulunamadı!");

$hatalar = [];
if(isset($_POST["action"])){
    if(!isset($_POST["adsoyad"]) || empty($_POST["adsoyad"])) // Ad soyad boşsa...
        $hatalar[] = "Ad soyad alanını boş bırakmayınız.";
    if(!isset($_POST["kullaniciadi"]) || empty($_POST["kullaniciadi"])) // Kullanıcı adı boşsa...
        $hatalar[]= "Kullanıcı adı alanını boş bırakmayınız.";
    if(!isset($_POST["eposta"]) || empty($_POST["eposta"])) // Eposta boşsa...
        $hatalar[]= "Eposta alanını boş bırakmayınız.";

    // Kullanıcı adı kullanılıyor mu kontrolü
    if(isset($_POST["kullaniciadi"]) && !empty($_POST["kullaniciadi"])){
        $kullaniciadiKontrol = $db->query("SELECT * FROM kullanicilar WHERE kullaniciadi = '".$_POST['kullaniciadi']."' AND id != ".$kullanici->id)->fetch(PDO::FETCH_OBJ);
        if($kullaniciadiKontrol)
            $hatalar[] = "Kullanıcı adı kullanılmakta";
    }

    // Eposta kullanılıyor mu kontrolü
    if(isset($_POST["eposta"]) && !empty($_POST["eposta"])){
        $epostaKontrol = $db->query("SELECT * FROM kullanicilar WHERE eposta = '".$_POST['eposta']."' AND id != ".$kullanici->id)->fetch(PDO::FETCH_OBJ);
        if($epostaKontrol)
            $hatalar[] = "E-Posta adresi kullanılmakta";
    }

    if(isset($_POST["sifre"]) && !empty($_POST["sifre"]))
        if(isset($_POST["sifre_onay"]) && !empty($_POST["sifre_onay"]))
            if($_POST["sifre"] != $_POST["sifre_onay"])
                $hatalar[] = "Şifre ve şifre onayı aynı değil.";

    if(count($hatalar) == 0) {

        $kullaniciadi = $_POST["kullaniciadi"];
        $adsoyad = $_POST["adsoyad"];
        $eposta = $_POST["eposta"];
        $sifre = md5($_POST["sifre"]);
        $telefon = isset($_POST["telefon"]) ? $_POST["telefon"] : null;
        $adres = isset($_POST["adres"]) ? $_POST["adres"] : null;
        $yonetici = $_POST["yonetici"];
        $durum = $_POST["durum"];

        if(isset($_POST["sifre"]) && !empty($_POST["sifre"])){
            $duzenle = $db->exec("UPDATE kullanicilar SET kullaniciadi = '".$kullaniciadi."', eposta = '".$eposta."', adsoyad = '".$adsoyad."', sifre = '".$sifre."', telefon = '".$telefon."', adres = '".$adres."', yonetici = '".$yonetici."', durum = '".$durum."' WHERE id = ".$kullanici->id);
        } else {
            $query = "UPDATE kullanicilar SET kullaniciadi = '".$kullaniciadi."', eposta = '".$eposta."', adsoyad = '".$adsoyad."', telefon = '".$telefon."', adres = '".$adres."', yonetici = '".$yonetici."', durum = '".$durum."' WHERE id = ".$kullanici->id;
            $duzenle = $db->exec($query);
        }

        if($duzenle) { // Başarılı ise...
            yonlendir("index.php?modul=kullanici&sayfa=liste");
        } else {
            var_dump($duzenle);
        }
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Kullanıcı Düzenle</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Kullanıcı Düzenle
            </div>
            <div class="panel-body">
                <?php
                if(count($hatalar) > 0){
                    ?>
                    <div class="alert alert-danger">
                        <?php foreach($hatalar as $hata): ?>
                            <p><?php echo $hata; ?></p>
                        <?php endforeach; ?>
                    </div>
                    <?php
                }
                ?>
                <form role="form" method="post" action="index.php?modul=kullanici&sayfa=duzenle&kullanici_id=<?php echo $kullanici->id; ?>">
                    <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input class="form-control" required name="kullaniciadi" value="<?php echo $kullanici->kullaniciadi; ?>">
                    </div>
                    <div class="form-group">
                        <label>E-Posta Adresi</label>
                        <input type="email" class="form-control" required name="eposta" value="<?php echo $kullanici->eposta; ?>">
                    </div>
                    <div class="form-group">
                        <label>Ad Soyad</label>
                        <input type="text" class="form-control" required name="adsoyad" value="<?php echo $kullanici->adsoyad; ?>">
                    </div>
                    <div class="form-group">
                        <label>Şifre</label>
                        <input type="password" class="form-control" name="sifre">
                        <span class="help-block">Değiştirmek istemiyorsanız boş bırakın.</span>
                    </div>
                    <div class="form-group">
                        <label>Şifre Onayı</label>
                        <input type="password" class="form-control" name="sifre_onay">
                        <span class="help-block">Değiştirmek istemiyorsanız boş bırakın.</span>
                    </div>
                    <div class="form-group">
                        <label>Telefon</label>
                        <input type="tel" class="form-control" name="telefon" value="<?php echo $kullanici->telefon; ?>">
                    </div>
                    <div class="form-group">
                        <label>Adres</label>
                        <textarea class="form-control" name="adres"><?php echo $kullanici->adres; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Yöneticilik</label>
                        <label class="radio-inline">
                            <input type="radio" name="yonetici" id="yonetici1" value="1" <?php if($kullanici->yonetici == 1): ?> checked <?php endif; ?>> Yönetici
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="yonetici" id="yonetici0" value="0" <?php if($kullanici->yonetici == 0): ?> checked <?php endif; ?>> Kullanıcı
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Durum</label>
                        <label class="radio-inline">
                            <input type="radio" name="durum" id="durum1" value="1" <?php if($kullanici->durum == 1): ?> checked <?php endif; ?>> Aktif
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="durum" id="durum0" value="0" <?php if($kullanici->durum == 0): ?> checked <?php endif; ?>> Pasif
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