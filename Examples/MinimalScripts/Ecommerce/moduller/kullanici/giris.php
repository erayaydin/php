<section class="giris">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Giriş Yap</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        if(isset($_POST["islem"])){ // Eğer giriş yap işlemi gönderilmişse...
                            if(isset($_POST["kullaniciadi"]) && !empty($_POST["kullaniciadi"])){ // Eğer kullanıcı adı gönderilmişse...
                                if(isset($_POST["sifre"]) && !empty($_POST["sifre"])){ // Eğer şifre gönderilmişse...
                                    $kullaniciadi = $_POST["kullaniciadi"];
                                    $sifre = $_POST["sifre"];

                                    $kontrol = $db->query("SELECT * FROM kullanicilar WHERE kullaniciadi = '".$kullaniciadi."' AND sifre = '".md5($sifre)."' AND durum = 1")->fetch(PDO::FETCH_OBJ);
                                    if($kontrol) {
                                        $_SESSION["giris"] = $kontrol->id;
                                        yonlendir("index.php");
                                    } else {
                                        ?>
                                        <div class="alert alert-danger">
                                            <p>Kullanıcı adı veya şifre hatalı.</p>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-danger">
                                        <p>Lütfen şifre kısmını doldurunuz.</p>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="alert alert-danger">
                                    <p>Lütfen kullanıcı adı kısmını doldurunuz.</p>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <form method="post" action="index.php?modul=kullanici&sayfa=giris">
                            <div class="form-group">
                                <label for="kullaniciadi">Kullanıcı Adı</label>
                                <input type="text" class="form-control" value="<?php echo isset($_POST["kullaniciadi"]) ? $_POST["kullaniciadi"] : null; ?>" name="kullaniciadi" id="kullaniciadi" placeholder="Kullanıcı Adı">
                            </div>
                            <div class="form-group">
                                <label for="sifre">Şifre</label>
                                <input type="password" class="form-control" name="sifre" id="sifre" placeholder="Şifre">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="islem" value="giris" class="btn btn-primary">Giriş Yap</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>