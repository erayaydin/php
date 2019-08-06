<?php
if(isset($_GET["kullanici_id"])) {
    $kullaniciId = $_GET["kullanici_id"];
    $kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = " . $kullaniciId)->fetch(PDO::FETCH_OBJ);
    if (!$kullanici)
        hata("KULLANICI", "Kullanıcı bulunamadı!");
} else {
    hata("KULLANICI", "KullanıcıID Belirtilmedi!");
}

if(isset($_POST["islem"])){
    $kadi   = $_POST["kadi"];
    $eposta = $_POST["eposta"];
    $parola = $_POST["parola"];
    $adsoyad = $_POST["adsoyad"];
    $okul = $_POST["okul"];
    $bolum = $_POST["bolum"];
    $yil = $_POST["yil"];
    $meslek = $_POST["meslek"];
    $telefon = $_POST["telefon"];
    $yer = $_POST["yer"];

    $avatar = $kullanici->avatar;
    $sifre = $kullanici->sifre;
    if(isset($parola) && !empty($parola)){
        $sifre = md5($parola);
    }
    if(isset($_FILES["foto"]["tmp_name"]) && !empty($_FILES["foto"]["tmp_name"])){
        $foto = $_FILES["foto"];
        $filename = $kadi.".png";
        $i = 2;
        while(file_exists("upload/kullanici/".$filename)){
            $filename = $kadi."-".$i.".png";
            $i++;
        }
        move_uploaded_file($foto["tmp_name"], "upload/kullanici/".$filename);
        $avatar = "upload/kullanici/".$filename;
    }

    $query = $db->prepare("UPDATE kullanicilar SET kullaniciadi = :kadi, sifre = :sifre, eposta = :eposta, adsoyad = :adsoyad, avatar = :avatar, okul_id = :okul, bolum_id = :bolum, meslek_id = :meslek, yer_id = :yer, telefon = :telefon, yil = :yil WHERE id = ".$kullanici->id);
    $query->execute([
        "kadi" => $kadi,
        "sifre" => $sifre,
        "eposta" => $eposta,
        "adsoyad" => $adsoyad,
        "avatar" => $avatar,
        "okul" => $okul,
        "bolum" => $bolum,
        "meslek" => $meslek,
        "telefon" => $telefon,
        "yer" => $yer,
        "yil" => $yil,
    ]);

    yonlendir("index.php?modul=yonetim/kullanici&sayfa=index");
}
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-top">Kullanıcı Düzenle</h3>
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kadi">Kullanıcı Adı</label>
                                <input type="text" class="form-control" id="kadi" name="kadi" placeholder="Kullanıcı Adı" value="<?php echo $kullanici->kullaniciadi; ?>">
                            </div> <!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eposta">E-Posta Adresi</label>
                                <input type="email" class="form-control" id="eposta" name="eposta" placeholder="E-Posta Adresi" value="<?php echo $kullanici->eposta; ?>">
                            </div> <!-- /.form-group -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="parola">Parola (Değiştirmek İstemiyorsanız Boş Bırakın)</label>
                                <input type="password" class="form-control" id="parola" name="parola" placeholder="Parola">
                            </div> <!-- /.form-group -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="adsoyad">Ad Soyad</label>
                                <input type="text" class="form-control" id="adsoyad" name="adsoyad" placeholder="Ad Soyad" value="<?php echo $kullanici->adsoyad; ?>">
                            </div> <!-- /.form-group -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="okul">Okul</label>
                                <select name="okul" id="okul" class="form-control">
                                    <option value="0">Seçiniz</option>
                                    <?php foreach($db->query("SELECT * FROM okullar ORDER BY isim ASC")->fetchAll(PDO::FETCH_OBJ) as $okul): ?>
                                        <option value="<?php echo $okul->id; ?>" <?php if($kullanici->okul_id == $okul->id): ?> selected="selected" <?php endif; ?>><?php echo $okul->isim; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> <!-- /.form-group -->
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bolum">Bölüm</label>
                                <select name="bolum" id="bolum" class="form-control">
                                    <option value="0">Seçiniz</option>
                                    <?php foreach($db->query("SELECT * FROM bolumler ORDER BY isim ASC")->fetchAll(PDO::FETCH_OBJ) as $bolum): ?>
                                        <option value="<?php echo $bolum->id; ?>" <?php if($kullanici->bolum_id == $bolum->id): ?> selected="selected" <?php endif; ?>><?php echo $bolum->isim; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> <!-- /.form-group -->
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="yil">Mezuniyet Yılı</label>
                                <select name="yil" id="yil" class="form-control">
                                    <option value="0">Seçiniz</option>
                                    <?php for($i=2000;$i<=date("Y")+4;$i++): ?>
                                        <option value="<?php echo $i; ?>" <?php if($kullanici->yil == $i): ?> selected="selected" <?php endif; ?>><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div> <!-- /.form-group -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefon">Telefon</label>
                                <input type="tel" class="form-control" id="telefon" name="telefon" placeholder="Telefon" value="<?php echo $kullanici->telefon; ?>">
                            </div> <!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="yer">Yerleşim Yeri</label>
                                <select name="yer" id="yer" class="form-control">
                                    <option value="0">Seçiniz</option>
                                    <?php foreach($db->query("SELECT * FROM yerler ORDER BY isim ASC")->fetchAll(PDO::FETCH_OBJ) as $yer): ?>
                                        <option value="<?php echo $yer->id; ?>" <?php if($kullanici->yer_id == $yer->id): ?> selected="selected" <?php endif; ?>><?php echo $yer->isim; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> <!-- /.form-group -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="meslek">Meslek</label>
                                <select name="meslek" id="meslek" class="form-control">
                                    <option value="0">Seçiniz</option>
                                    <?php foreach($db->query("SELECT * FROM meslekler ORDER BY isim ASC")->fetchAll(PDO::FETCH_OBJ) as $meslek): ?>
                                        <option value="<?php echo $meslek->id; ?>" <?php if($kullanici->meslek_id == $meslek->id): ?> selected="selected" <?php endif; ?>><?php echo $meslek->isim; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> <!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto">Fotoğraf (Değiştirmek İstemiyorsanız Boş Bırakın)</label>
                                <input type="file" name="foto" class="form-control">
                            </div> <!-- /.form-group -->
                        </div>
                    </div>
                    <p class="text-right">
                        <button type="submit" name="islem" value="guncelle" class="btn btn-primary">Güncelle <i class="fa fa-cloud-upload"></i></button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>