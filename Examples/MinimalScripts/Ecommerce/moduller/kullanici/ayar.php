<section class="giris">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hesap Ayarları</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        if(isset($_POST["islem"])){ // Eğer giriş yap işlemi gönderilmişse...
                            $hatalar = [];
                            if(!isset($_POST["adsoyad"]) || empty($_POST["adsoyad"])) // Ad soyad boşsa...
                                $hatalar[] = "Ad soyad alanını boş bırakmayınız.";
                            if(!isset($_POST["kullaniciadi"]) || empty($_POST["kullaniciadi"])) // Kullanıcı adı boşsa...
                                $hatalar[]= "Kullanıcı adı alanını boş bırakmayınız.";
                            if(!isset($_POST["eposta"]) || empty($_POST["eposta"])) // Eposta boşsa...
                                $hatalar[]= "Eposta alanını boş bırakmayınız.";

                            // Kullanıcı adı kullanılıyor mu kontrolü
                            if(isset($_POST["kullaniciadi"]) && !empty($_POST["kullaniciadi"])){
                                $kullaniciadiKontrol = $db->query("SELECT * FROM kullanicilar WHERE kullaniciadi = '".$_POST['kullaniciadi']."' AND id != ".$giris->id)->fetch(PDO::FETCH_OBJ);
                                if($kullaniciadiKontrol)
                                    $hatalar[] = "Kullanıcı adı kullanılmakta";
                            }

                            // Eposta kullanılıyor mu kontrolü
                            if(isset($_POST["eposta"]) && !empty($_POST["eposta"])){
                                $epostaKontrol = $db->query("SELECT * FROM kullanicilar WHERE eposta = '".$_POST['eposta']."' AND id != ".$giris->id)->fetch(PDO::FETCH_OBJ);
                                if($epostaKontrol)
                                    $hatalar[] = "E-Posta adresi kullanılmakta";
                            }

                            if(isset($_POST["sifre"]) && !empty($_POST["sifre"]))
                                if(isset($_POST["sifre_onay"]) && !empty($_POST["sifre_onay"]))
                                    if($_POST["sifre"] != $_POST["sifre_onay"])
                                        $hatalar[] = "Şifre ve şifre onayı aynı değil.";

                            if(count($hatalar) > 0){
                                ?>
                                <div class="alert alert-danger">
                                    <?php foreach($hatalar as $hata): ?>
                                        <p><?php echo $hata; ?></p>
                                    <?php endforeach; ?>
                                </div>
                                <?php
                            } else {

                                $kullaniciadi = $_POST["kullaniciadi"];
                                $adsoyad = $_POST["adsoyad"];
                                $eposta = $_POST["eposta"];
                                $sifre = md5($_POST["sifre"]);
                                $telefon = isset($_POST["telefon"]) ? $_POST["telefon"] : null;
                                $adres = isset($_POST["adres"]) ? $_POST["adres"] : null;

                                if(isset($_POST["sifre"]) && !empty($_POST["sifre"])){
                                    $kullanici = $db->exec("UPDATE kullanicilar SET kullaniciadi = '".$kullaniciadi."', eposta = '".$eposta."', adsoyad = '".$adsoyad."', sifre = '".$sifre."', telefon = '".$telefon."', adres = '".$adres."' WHERE id = ".$giris->id);
                                } else {
                                    $query = "UPDATE kullanicilar SET kullaniciadi = '".$kullaniciadi."', eposta = '".$eposta."', adsoyad = '".$adsoyad."', telefon = '".$telefon."', adres = '".$adres."' WHERE id = ".$giris->id;
                                    $kullanici = $db->exec($query);
                                }
                                yonlendir("index.php?modul=kullanici&sayfa=ayar");
                            }
                        }
                        ?>
                        <form method="post" action="index.php?modul=kullanici&sayfa=ayar">
                            <div class="form-group">
                                <label for="adsoyad">Ad Soyad</label>
                                <input type="text" class="form-control" value="<?php echo isset($_POST["adsoyad"]) ? $_POST["adsoyad"] : $giris->adsoyad; ?>" name="adsoyad" id="adsoyad" placeholder="Ad Soyad">
                            </div>
                            <div class="form-group">
                                <label for="kullaniciadi">Kullanıcı Adı</label>
                                <input type="text" class="form-control" value="<?php echo isset($_POST["kullaniciadi"]) ? $_POST["kullaniciadi"] : $giris->kullaniciadi; ?>" name="kullaniciadi" id="kullaniciadi" placeholder="Kullanıcı Adı">
                            </div>
                            <div class="form-group">
                                <label for="eposta">E-Posta Adresi</label>
                                <input type="email" class="form-control" value="<?php echo isset($_POST["eposta"]) ? $_POST["eposta"] : $giris->eposta; ?>" name="eposta" id="eposta" placeholder="E-Posta Adresi">
                            </div>
                            <div class="form-group">
                                <label for="sifre">Şifre</label>
                                <input type="password" class="form-control" name="sifre" id="sifre" placeholder="Şifreyi değiştirmek istemiyorsanız boş bırakın">
                            </div>
                            <div class="form-group">
                                <label for="sifre_onay">Şifre Tekrarı</label>
                                <input type="password" class="form-control" name="sifre_onay" id="sifre_onay" placeholder="Şifre Onayı">
                            </div>
                            <div class="form-group">
                                <label for="telefon">Telefon</label>
                                <input type="text" class="form-control" value="<?php echo isset($_POST["telefon"]) ? $_POST["telefon"] : $giris->telefon; ?>" name="telefon" id="telefon" placeholder="Telefon Numarası">
                            </div>
                            <div class="form-group">
                                <label for="adres">Adres</label>
                                <textarea class="form-control" id="adres" name="adres" placeholder="Adres"><?php echo isset($_POST["adres"]) ? $_POST["adres"] : $giris->adres; ?></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="islem" value="guncelle" class="btn btn-primary">Güncelle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>