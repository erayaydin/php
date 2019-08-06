<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Öğrenci Girişi</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if($_POST){
                        $username = $_POST["username"];
                        $password = $_POST["password"];

                        $errors = Validation::valid([
                            "username" => [
                                "text"  => "öğrenci no",
                                "check" => "required"
                            ],
                            "password" => [
                                "text" => "şifre",
                                "check" => "required"
                            ]
                        ]);

                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger">
                                <?php foreach($errors as $error): ?>
                                    <p><?php echo $error; ?></p>
                                <?php endforeach; ?>
                            </div>
                            <?php
                        } else {
                            if(Application::$auth->login($username, $password)){
                                redirect("index.php?panel=student");
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
                    <form method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="username"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" value="<?php echo old("username"); ?>" name="username" placeholder="Öğrenci No" aria-describedby="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="password"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Parola" aria-describedby="password">
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="index.php?panel=admin" class="btn btn-warning pull-left"><i class="fa fa-chevron-left"></i> Yönetici Girişi</a>
                            <button type="submit" class="btn btn-primary">Giriş Yap <i class="fa fa-sign-in"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>