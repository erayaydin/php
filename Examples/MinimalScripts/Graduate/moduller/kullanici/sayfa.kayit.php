<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form method="POST" enctype="multipart/form-data">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Kayıt Ol</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            if(isset($_POST["gonder"])){ // Eğer gönder denilmişse...
                                $kadi   = $_POST["kadi"];
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
                                if(!isset($kadi) || empty($kadi))
                                    $hatalar[] = "Lütfen kullanıcı adınızı belirtin.";
                                if(!isset($eposta) || empty($eposta))
                                    $hatalar[] = "Lütfen e-posta adresinizi belirtin.";
                                if(!isset($parola_onay) || empty($parola_onay))
                                    $hatalar[] = "Lütfen parola onayını belirtin.";
                                if(!isset($parola) || empty($parola))
                                    $hatalar[] = "Lütfen parolanızı belirtin.";
                                elseif($parola != $parola_onay)
                                    $hatalar[] = "Parola ve parola onayı aynı değil.";
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
                                    $epostaKontrol = $db->prepare("SELECT * FROM kullanicilar WHERE eposta = :eposta");
                                    $epostaKontrol->execute(["eposta" => $eposta]);
                                    if($epostaKontrol->rowCount() > 0)
                                        $hatalar[] = "E-Posta adresi kullanılmakta.";
                                }

                                if(isset($kadi) && !empty($kadi)){
                                    $kadiKontrol = $db->prepare("SELECT * FROM kullanicilar WHERE kullaniciadi = :kullaniciadi");
                                    $kadiKontrol->execute(["kullaniciadi" => $kadi]);
                                    if($kadiKontrol->rowCount() > 0)
                                        $hatalar[] = "Kullanıcı adı kullanılmakta.";
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
                                    } else {
                                        $hatalar[] = "Lütfen bir fotoğraf seçiniz.";
                                    }
                                } else {
                                    $hatalar[] = "Lütfen fotoğraf seçiniz.";
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

                                    $avatar = null;
                                    $filename = $kadi.".png";
                                    $i = 2;
                                    while(file_exists("upload/kullanici/".$filename)){
                                        $filename = $kadi."-".$i.".png";
                                        $i++;
                                    }
                                    move_uploaded_file($foto["tmp_name"], "upload/kullanici/".$filename);
                                    $avatar = "upload/kullanici/".$filename;

                                    $query = $db->prepare("INSERT INTO kullanicilar(kullaniciadi,sifre,eposta,durum,adsoyad,avatar,okul_id,bolum_id,meslek_id,yer_id,telefon,yil) VALUES(:kadi,:sifre,:eposta,1,:adsoyad,:avatar,:okul,:bolum,:meslek,:yer,:telefon,:yil)");
                                    $query->execute([
                                        "kadi" => $kadi,
                                        "sifre" => md5($parola),
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

                                    if($query){
                                        header("Location: index.php?mesaj=kayit");
                                    } else {
                                        ?>
                                        <div class="alert alert-danger">
                                            <p>Yeni kullanıcı eklemede sorun oluştu.</p>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kadi">Kullanıcı Adı</label>
                                        <input type="text" class="form-control" id="kadi" name="kadi" placeholder="Kullanıcı Adı" value="<?php echo post("kadi"); ?>">
                                    </div> <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eposta">E-Posta Adresi</label>
                                        <input type="email" class="form-control" id="eposta" name="eposta" placeholder="E-Posta Adresi" value="<?php echo post("eposta"); ?>">
                                    </div> <!-- /.form-group -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parola">Parola</label>
                                        <input type="password" class="form-control" id="parola" name="parola" placeholder="Parolanız">
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
                                        <input type="text" class="form-control" id="adsoyad" name="adsoyad" placeholder="Ad Soyad" value="<?php echo post("adsoyad"); ?>">
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
                                                <option value="<?php echo $okul->id; ?>" <?php if(post("okul") == $okul->id): ?> selected="selected" <?php endif; ?>><?php echo $okul->isim; ?></option>
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
                                                <option value="<?php echo $bolum->id; ?>" <?php if(post("bolum") == $bolum->id): ?> selected="selected" <?php endif; ?>><?php echo $bolum->isim; ?></option>
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
                                            <option value="<?php echo $i; ?>" <?php if(post("yil") == $i): ?> selected="selected" <?php endif; ?>><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div> <!-- /.form-group -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telefon">Telefon</label>
                                        <input type="tel" class="form-control" id="telefon" name="telefon" placeholder="Telefon" value="<?php echo post("telefon"); ?>">
                                    </div> <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="yer">Yerleşim Yeri</label>
                                        <select name="yer" id="yer" class="form-control">
                                            <option value="0">Seçiniz</option>
                                            <?php foreach($db->query("SELECT * FROM yerler ORDER BY isim ASC")->fetchAll(PDO::FETCH_OBJ) as $yer): ?>
                                                <option value="<?php echo $yer->id; ?>" <?php if(post("yer") == $yer->id): ?> selected="selected" <?php endif; ?>><?php echo $yer->isim; ?></option>
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
                                                <option value="<?php echo $meslek->id; ?>" <?php if(post("meslek") == $meslek->id): ?> selected="selected" <?php endif; ?>><?php echo $meslek->isim; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div> <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="foto">Fotoğraf</label>
                                        <input type="file" name="foto" class="form-control">
                                    </div> <!-- /.form-group -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary" name="gonder" value="kayit">Kayıt Ol <i class="fa fa-send"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>