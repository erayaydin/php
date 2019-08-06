<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include __DIR__."/../side.php" ?>
        </div>
        <div class="col-md-10">
            <form method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-plus"></i> Yeni Öğrenci Ekle</h3>
                    </div>
                    <div class="panel-body">

                        <?php
                        if($_POST){
                            $name = $_POST["name"];
                            $username = $_POST["username"];
                            $password = $_POST["password"];

                            $errors = Validation::valid([
                                "name" => [
                                    "text" => "öğrenci adı",
                                    "check" => "required"
                                ],
                                "username" => [
                                    "text" => "öğrenci no",
                                    "check" => "required"
                                ],
                                "password" => [
                                    "text" => "parola",
                                    "check" => "required"
                                ],
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
                                $create = Application::$db->db->prepare("INSERT INTO users(name,username,password,type) VALUES(:name,:username,:password,'student')");
                                $create->execute([
                                    "name" => $name,
                                    "username" => $username,
                                    "password" => md5($password),
                                ]);

                                redirect("index.php?panel=admin&module=student&action=index");
                            }
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="name">Öğrenci Adı</span>
                                        <input type="text" class="form-control" name="name" value="<?php echo old("name"); ?>" placeholder="Öğrenci Adı" aria-describedby="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="username">Öğrenci No</span>
                                        <input type="text" class="form-control" name="username" value="<?php echo old("username"); ?>" placeholder="Öğrenci No" aria-describedby="username">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="password">Parola</span>
                                        <input type="password" class="form-control" name="password" placeholder="Öğrenci Parola" aria-describedby="password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Yeni Öğrenci Ekle</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>