<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form method="post">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Öğretmen Girişi</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        if(isset($_POST['action'])){
                            $number = $_POST['number'];
                            $pass   = $_POST['password'];

                            $hatalar = [];
                            if(!$number)
                                $hatalar[] = "Lütfen bir sicil numarası belirtin.";
                            if(!$pass)
                                $hatalar[] = "Lütfen bir parola belirtin.";

                            if(count($hatalar) > 0){
                                ?>
                                    <div class="alert alert-danger">
                                        <?php foreach($hatalar as $hata): ?>
                                            <p><?php echo $hata; ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                <?php
                            } else {
                                $kontrol = $db->prepare("SELECT * FROM kullanicilar WHERE numara = :numara AND sifre = :sifre AND tur = 'ogretmen'");
                                $kontrol->execute([
                                    'numara' => $number,
                                    'sifre'  => md5($pass)
                                ]);
                                $kontrol = $kontrol->fetch(PDO::FETCH_OBJ);
                                if($kontrol){
                                    $_SESSION['giris'] = $kontrol->id;
                                    yonlendir('index.php');
                                } else {
                                    ?>
                                        <div class="alert alert-danger">
                                            <p>Sicil numarası veya parola hatalı.</p>
                                        </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="number"><i class="fa fa-user"></i></span>
                                <input type="text" name="number" class="form-control" placeholder="Sicil Numarası" value="<?php echo post('number'); ?>" aria-describedby="number">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="pass"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Parola" aria-describedby="pass">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <button type="submit" name="action" value="go" class="btn btn-danger">Giriş Yap <i class="fa fa-sign-in"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>