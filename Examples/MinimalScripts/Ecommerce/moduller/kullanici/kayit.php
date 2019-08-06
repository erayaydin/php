<section class="giris">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Kayıt Ol</h3>
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
                            if(!isset($_POST["sifre"]) || empty($_POST["sifre"])) // Şifre boşsa...
                                $hatalar[]= "Şifre alanını boş bırakmayınız.";
                            if(!isset($_POST["sifre_onay"]) || empty($_POST["sifre_onay"])) // Şifre onay boşsa...
                                $hatalar[]= "Şifre onay alanını boş bırakmayınız.";

                            // Kullanıcı adı kullanılıyor mu kontrolü
                            if(isset($_POST["kullaniciadi"]) && !empty($_POST["kullaniciadi"])){
                                $kullaniciadiKontrol = $db->query("SELECT * FROM kullanicilar WHERE kullaniciadi = '".$_POST['kullaniciadi']."'")->fetch(PDO::FETCH_OBJ);
                                if($kullaniciadiKontrol)
                                    $hatalar[] = "Kullanıcı adı kullanılmakta";
                            }

                            // Eposta kullanılıyor mu kontrolü
                            if(isset($_POST["eposta"]) && !empty($_POST["eposta"])){
                                $epostaKontrol = $db->query("SELECT * FROM kullanicilar WHERE eposta = '".$_POST['eposta']."'")->fetch(PDO::FETCH_OBJ);
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
                                $kullanici = $db->prepare("INSERT INTO kullanicilar(kullaniciadi, eposta, sifre, adsoyad, durum) VALUES(:kullaniciadi, :eposta, :sifre, :adsoyad, 1)");
                                $kullanici->bindParam("kullaniciadi", $kullaniciadi);
                                $kullanici->bindParam("eposta", $eposta);
                                $kullanici->bindParam("adsoyad", $adsoyad);
                                $kullanici->bindParam("sifre", $sifre);
                                $kullanici->execute();
                                yonlendir("index.php?modul=kullanici&sayfa=giris");
                            }
                        }
                        ?>
                        <form method="post" action="index.php?modul=kullanici&sayfa=kayit">
                            <div class="form-group">
                                <label for="adsoyad">Ad Soyad</label>
                                <input type="text" class="form-control" value="<?php echo isset($_POST["adsoyad"]) ? $_POST["adsoyad"] : null; ?>" name="adsoyad" id="adsoyad" placeholder="Ad Soyad">
                            </div>
                            <div class="form-group">
                                <label for="kullaniciadi">Kullanıcı Adı</label>
                                <input type="text" class="form-control" value="<?php echo isset($_POST["kullaniciadi"]) ? $_POST["kullaniciadi"] : null; ?>" name="kullaniciadi" id="kullaniciadi" placeholder="Kullanıcı Adı">
                            </div>
                            <div class="form-group">
                                <label for="eposta">E-Posta Adresi</label>
                                <input type="email" class="form-control" value="<?php echo isset($_POST["eposta"]) ? $_POST["eposta"] : null; ?>" name="eposta" id="eposta" placeholder="E-Posta Adresi">
                            </div>
                            <div class="form-group">
                                <label for="sifre">Şifre</label>
                                <input type="password" class="form-control" name="sifre" id="sifre" placeholder="Şifre">
                            </div>
                            <div class="form-group">
                                <label for="sifre_onay">Şifre Tekrarı</label>
                                <input type="password" class="form-control" name="sifre_onay" id="sifre_onay" placeholder="Şifre Onayı">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="islem" value="kayit" class="btn btn-primary">Kayıt Ol</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>