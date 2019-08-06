<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($_POST["login"])){
                    if($_POST["login"] == "user"){
                        $username = $_POST["uUserName"];
                        $password = $_POST["uPassword"];
                    } else {
                        $username = $_POST["aUserName"];
                        $password = $_POST["aPassword"];
                    }

                    $hatalar = []; // Hatalar için boş bir dizi oluştur.
                    if(!$username)
                        $hatalar[] = "Lütfen bir kullanıcı adı belirtin.";
                    if(!$password)
                        $hatalar[] = "Lütfen bir şifre belirtin.";

                    if(count($hatalar) > 0) {
                        ?>
                        <div class="alert alert-danger">
                            <?php foreach ($hatalar as $hata): ?>
                                <p><?php echo $hata; ?></p>
                            <?php endforeach; ?>
                        </div>
                        <?php
                    } else {
                        $md5Password = md5($password);

                        if ($_POST["login"] == "user") {
                            $sorgu = "SELECT * FROM kullanicilar WHERE kullaniciadi = :kadi AND sifre = :sifre AND admin = 0 LIMIT 0,1";
                        } else {
                            $sorgu = "SELECT * FROM kullanicilar WHERE kullaniciadi = :kadi AND sifre = :sifre AND admin = 1 LIMIT 0,1";
                        }

                        $girisKontrol = $db->prepare($sorgu);
                        $girisKontrol->execute([
                            "kadi" => $username,
                            "sifre" => $md5Password
                        ]); // Giriş kontrolü için SQL sorgusunu çalıştır.
                        $giris = $girisKontrol->fetch(PDO::FETCH_OBJ);
                        if ($giris) { // Eğer bu kadı ve parola varsa...
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form method="POST">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Üye Girişi</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="uUserName"><i class="fa fa-user"></i></span>
                                    <input type="text" value="<?php echo post('uUserName'); ?>" name="uUserName" class="form-control" placeholder="Kullanıcı Adı" aria-describedby="uUserName">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="uPassword"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control" name="uPassword" placeholder="Şifre" aria-describedby="uPassword">
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <button type="submit" class="btn btn-primary" name="login" value="user">Üye Girişi Yap <i class="fa fa-sign-in"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form method="POST">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">Yönetici Girişi</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="aUserName"><i class="fa fa-user"></i></span>
                                    <input type="text" value="<?php echo post('aUserName'); ?>" name="aUserName" class="form-control" placeholder="Kullanıcı Adı" aria-describedby="aUserName">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="aPassword"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control" name="aPassword" placeholder="Şifre" aria-describedby="aPassword">
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <button type="submit" class="btn btn-warning" name="login" value="admin">Yönetici Girişi Yap <i class="fa fa-sign-in"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>