<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form method="POST" enctype="multipart/form-data">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Hesap Ayarları</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            if(isset($_POST["gonder"])){ // Eğer gönder denilmişse...
                                $eposta = $_POST["eposta"];
                                $parola = $_POST["parola"];
                                $parola_onay = $_POST["parola_onay"];
                                $adsoyad = $_POST["adsoyad"];
                                $okul = $_POST["okul"];
                                $bolum = $_POST["bolum"];
                                $yil = $_POST["yil"];
                                $meslek = $_POST["meslek"];
                                $telefon = $_POST["telefon"];
                                $yer = $_POST["yer"];

                                $hatalar = [];
                                if(!isset($eposta) || empty($eposta))
                                    $hatalar[] = "Lütfen e-posta adresinizi belirtin.";
                                if(isset($parola) && !empty($parola)){
                                    if($parola != $parola_onay)
                                        $hatalar[] = "Parola ve parola onayı aynı değil.";
                                }
                                if(!isset($adsoyad) || empty($adsoyad))
                                    $hatalar[] = "Lütfen adınız ve soyadınızı belirtin.";
                                if($okul == 0)
                                    $hatalar[] = "Lütfen okulunuzu belirtin.";
                                if($bolum == 0)
                                    $hatalar[] = "Lütfen bölümünüzü belirtin.";
                                if($yil == 0)
                                    $hatalar[] = "Lütfen mezuniyet yılınızı belirtin.";
                                if($yer == 0)
                                    $hatalar[] = "Lütfen yerleşim yerinizi belirtin.";
                                if($meslek == 0)
                                    $hatalar[] = "Lütfen bir meslek belirtin.";
                                if(!isset($telefon) || empty($telefon))
                                    $hatalar[] = "Lütfen telefonunuzu belirtin.";

                                if(isset($eposta) && !empty($eposta)){
                                    $epostaKontrol = $db->prepare("SELECT * FROM kullanicilar WHERE eposta = :eposta AND id != ".$giris->id);
                                    $epostaKontrol->execute(["eposta" => $eposta]);
                                    if($epostaKontrol->rowCount() > 0)
                                        $hatalar[] = "E-Posta adresi kullanılmakta.";
                                }

                                if(isset($_FILES["foto"])){
                                    $foto = $_FILES["foto"];
                                    if(!empty($foto["tmp_name"])){
                                        if($foto["size"] <= 500000) {
                                            if(getimagesize($foto['tmp_name']) == false){
                                                $hatalar[] = "Yüklediğiniz fotoğraf dosyası yanlış formatta.";
                                            }
                                        } else {
                                            $hatalar[] = "Fotoğrafınız 500KB'dan fazla olamaz.";
                                        }
                                    }
                                }

                                if(count($hatalar) > 0){
                                    ?>
                                    <div class="alert alert-danger">
                                        <?php foreach($hatalar as $hata): ?>
                                            <p><?php echo $hata; ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php
                                } else {

                                    $avatar = $giris->avatar;
                                    if(isset($foto["tmp_name"]) && !empty($foto["tmp_name"])){
                                        $filename = $giris->kullaniciadi.".png";
                                        $i = 2;
                                        while(file_exists("upload/kullanici/".$filename)){
                                            $filename = $giris->kullaniciadi."-".$i.".png";
                                            $i++;
                                        }
                                        move_uploaded_file($foto["tmp_name"], "upload/kullanici/".$filename);
                                        $avatar = "upload/kullanici/".$filename;
                                    }

                                    if(isset($parola) && !empty($parola)){
                                        $sifre = md5($parola);
                                    } else {
                                        $sifre = $giris->sifre;
                                    }

                                    $query = $db->prepare("UPDATE kullanicilar SET sifre = :sifre, eposta = :eposta, adsoyad = :adsoyad, avatar = :avatar, okul_id = :okul, bolum_id = :bolum, meslek_id = :meslek, yer_id = :yer, yil = :yil, telefon = :telefon WHERE id = ".$giris->id);
                                    $query->execute([
                                        "sifre" => $sifre,
                                        "eposta" => $eposta,
                                        "adsoyad" => $adsoyad,
                                        "avatar" => $avatar,
                                        "okul" => $okul,
                                        "bolum" => $bolum,
                                        "meslek" => $meslek,
                                        "yer" => $yer,
                                        "yil" => $yil,
                                        "telefon" => $telefon,
                                    ]);

                                    if($query){
                                        header("Location: index.php?modul=kullanici&sayfa=hesap");
                                    } else {
                                        ?>
                                        <div class="alert alert-danger">
                                            <p>Ayar güncellemede sorun oluştu.</p>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="eposta">E-Posta Adresi</label>
                                        <input type="email" class="form-control" id="eposta" name="eposta" placeholder="E-Posta Adresi" value="<?php echo $giris->eposta; ?>">
                                    </div> <!-- /.form-group -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parola">Parola</label>
                                        <input type="password" class="form-control" id="parola" name="parola" placeholder="Değiştirmek istemiyorsanız boş bırakın">
                                    </div> <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parola_onay">Parola Onayı</label>
                                        <input type="password" class="form-control" id="parola_onay" name="parola_onay" placeholder="Parolanızı Onaylayın">
                                    </div> <!-- /.form-group -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="adsoyad">Ad Soyad</label>
                                        <input type="text" class="form-control" id="adsoyad" name="adsoyad" placeholder="Ad Soyad" value="<?php echo $giris->adsoyad; ?>">
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
                                                <option value="<?php echo $okul->id; ?>" <?php if($giris->okul_id == $okul->id): ?> selected="selected" <?php endif; ?>><?php echo $okul->isim; ?></option>
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
                                                <option value="<?php echo $bolum->id; ?>" <?php if($giris->bolum_id == $bolum->id): ?> selected="selected" <?php endif; ?>><?php echo $bolum->isim; ?></option>
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
                                            <option value="<?php echo $i; ?>" <?php if($giris->yil == $i): ?> selected="selected" <?php endif; ?>><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div> <!-- /.form-group -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telefon">Telefon</label>
                                        <input type="tel" class="form-control" id="telefon" name="telefon" placeholder="Telefon" value="<?php echo $giris->telefon; ?>">
                                    </div> <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="yer">Yerleşim Yeri</label>
                                        <select name="yer" id="yer" class="form-control">
                                            <option value="0">Seçiniz</option>
                                            <?php foreach($db->query("SELECT * FROM yerler ORDER BY isim ASC")->fetchAll(PDO::FETCH_OBJ) as $yer): ?>
                                                <option value="<?php echo $yer->id; ?>" <?php if($giris->yer_id == $yer->id): ?> selected="selected" <?php endif; ?>><?php echo $yer->isim; ?></option>
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
                                                <option value="<?php echo $meslek->id; ?>" <?php if($giris->meslek_id == $meslek->id): ?> selected="selected" <?php endif; ?>><?php echo $meslek->isim; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div> <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="foto">Fotoğraf Güncelle</label>
                                        <input type="file" name="foto" class="form-control">
                                    </div> <!-- /.form-group -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary" name="gonder" value="guncelle">Güncelle <i class="fa fa-cloud-upload"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>