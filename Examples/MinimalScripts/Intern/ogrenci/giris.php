<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Öğrenci Girişi</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        if(isset($_POST['action'])){
                            $number = $_POST['number'];
                            $pass   = $_POST['password'];

                            $hatalar = [];
                            if(!$number)
                                $hatalar[] = "Lütfen bir öğrenci numarası belirtin.";
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
                                $kontrol = $db->prepare("SELECT * FROM kullanicilar WHERE numara = :numara AND sifre = :sifre AND tur = 'ogrenci'");
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
                                            <p>Öğrenci numarası veya parola hatalı.</p>
                                        </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="studentnumber"><i class="fa fa-user"></i></span>
                                <input type="text" name="number" class="form-control" placeholder="Öğrenci Numarası" value="<?php echo post('number'); ?>" aria-describedby="studentnumber">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="studentpass"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Parola" aria-describedby="studentpass">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <button type="submit" name="action" value="go" class="btn btn-primary">Giriş Yap</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>