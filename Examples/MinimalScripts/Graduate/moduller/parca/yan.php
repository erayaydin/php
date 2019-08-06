<?php if($giris): // Eğer giriş yapılmışsa... ?>
    <div class="panel panel-primary user-box">
        <div class="panel-heading">
            <?php
            $meslek = $db->query("SELECT * FROM meslekler WHERE id = ".$giris->meslek_id)->fetch(PDO::FETCH_OBJ);
            ?>
            <h3 class="panel-title"><?php echo $giris->adsoyad; ?> (<?php echo $meslek->isim; ?>)</h3>
        </div>
        <div class="panel-body">
            <p class="text-center">
                <img src="<?php echo $giris->avatar; ?>" alt="<?php echo $giris->adsoyad; ?>">
            </p>
            <a href="index.php?modul=kullanici&sayfa=hesap" class="btn btn-primary btn-block">Hesap Ayarları</a>
            <a href="index.php?modul=kullanici&sayfa=cikis" class="btn btn-default btn-block">Çıkış Yap</a>
        </div>
    </div>
<?php else: // Giriş yapılmamışsa... ?>
    <form role="form" method="post">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Giriş Yap</h3>
            </div>
            <div class="panel-body">
                <?php
                if(isset($_POST["gonder"])){ // Eğer form gönderilmişse...
                    $hatalar = []; // Hatalar için boş bir dizi oluştur.
                    if(!isset($_POST["kadi"]) || empty($_POST["kadi"])){ // Eğer kullanıcı adı boşsa...
                        $hatalar[] = "Kullanıcı adını belirtmelisiniz."; // Hatalara bunu ekle.
                    }
                    if(!isset($_POST["parola"]) || empty($_POST["parola"])){ // Eğer şifre boşsa...
                        $hatalar[] = "Parolanızı belirtmelisiniz."; // Hatalara bunu ekle.
                    }

                    if(count($hatalar) > 0) { // Eğer hata varsa...
                        ?>
                        <div class="alert alert-danger">
                            <?php foreach($hatalar as $hata): // Her hata mesajı için hata mesajını göster... ?>
                                <p><?php echo $hata; ?></p>
                            <?php endforeach; ?>
                        </div>
                        <?php
                    } else { // Hata yoksa...
                        $kadi  = $_POST["kadi"];
                        $parola = $_POST["parola"];
                        $sifre = md5($parola); // Parolayı MD5 ile şifrele
                        $girisKontrol = $db->prepare("SELECT * FROM kullanicilar WHERE kullaniciadi = :kadi AND sifre = :sifre LIMIT 0,1");
                        $girisKontrol->execute([
                            "kadi" => $kadi,
                            "sifre" => $sifre
                        ]); // Giriş kontrolü için SQL sorgusunu çalıştır.
                        $giris = $girisKontrol->fetch(PDO::FETCH_OBJ);
                        if($giris){ // Eğer bu kadı ve parola varsa...
                            $_SESSION["giris"] = $giris->id; // Giriş yaptı olarak oturumda işaretle.
                            yonlendir("index.php"); // Sayfayı index.php'ye yönlendir.
                        } else { // Eğer kullanıcı adı veya parola hatalı ise...
                            ?>
                            <div class="alert alert-danger">
                                <p>Kullanıcı adı veya parola hatalı.</p>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
                <div class="form-group">
                    <div class="input-group">
                        <label for="kadi" class="input-group-addon glyphicon glyphicon-user"></label>
                        <input type="text" class="form-control" id="kadi" name="kadi" placeholder="Kullanıcı Adı" value="<?php echo post("kadi"); ?>">
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <div class="input-group">
                        <label for="parola" class="input-group-addon glyphicon glyphicon-lock"></label>
                        <input type="password" class="form-control" id="parola" name="parola" placeholder="Parola">
                    </div> <!-- /.input-group -->
                </div> <!-- /.form-group -->

                <p class="text-right">
                    <a href="index.php?modul=kullanici&sayfa=kayit" class="btn btn-default pull-left">Üye Değil Misiniz?</a>
                    <button name="gonder" value="giris" type="submit" class="btn btn-primary">Giriş Yap</button>
                </p>
            </div>
        </div>
    </form>
<?php endif; ?>