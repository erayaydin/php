<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($_POST["register"])){
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $passwordConfirm = $_POST["password_confirm"];

                    $hatalar = []; // Hatalar için boş bir dizi oluştur.
                    if(!$username)
                        $hatalar[] = "Lütfen bir kullanıcı adı belirtin.";
                    if(!$password)
                        $hatalar[] = "Lütfen bir parola belirtin.";
                    if($password != $passwordConfirm)
                        $hatalar[] = "Parola ve parola onayı aynı olmalıdır.";

                    if($username){
                        $kadiKontrol = $db->prepare("SELECT * FROM kullanicilar WHERE kullaniciadi = :kullaniciadi");
                        $kadiKontrol->execute(["kullaniciadi" => $username]);
                        if($kadiKontrol->rowCount() > 0)
                            $hatalar[] = "Kullanıcı adı kullanılmakta.";
                    }

                    if(count($hatalar) > 0) {
                        ?>
                        <div class="alert alert-danger">
                            <?php foreach ($hatalar as $hata): ?>
                                <p><?php echo $hata; ?></p>
                            <?php endforeach; ?>
                        </div>
                        <?php
                    } else {
                        $query = $db->prepare("INSERT INTO kullanicilar(kullaniciadi,sifre,admin) VALUES(:kadi,:sifre,0)");
                        $query->execute([
                            "kadi" => $username,
                            "sifre" => md5($password),
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form method="POST">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Kayıt Ol</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="username"><i class="fa fa-user"></i></span>
                                    <input type="text" value="<?php echo post('username'); ?>" name="username" class="form-control" placeholder="Kullanıcı Adı" aria-describedby="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="password"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control" name="password" placeholder="Parola" aria-describedby="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="password_confirm"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control" name="password_confirm" placeholder="Parola Tekrarı" aria-describedby="password_confirm">
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <button type="submit" class="btn btn-primary" name="register" value="register">Kayıt Ol <i class="fa fa-sign-in"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>