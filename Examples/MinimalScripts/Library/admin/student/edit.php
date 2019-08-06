<?php
$user = Application::$db->db->query("SELECT * FROM users WHERE id = '".$_GET['user']."'")->fetch(PDO::FETCH_OBJ);
?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include __DIR__."/../side.php" ?>
        </div>
        <div class="col-md-10">
            <form method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-refresh"></i> Öğrenci Güncelle</h3>
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
                                $create = Application::$db->db->prepare("UPDATE users SET name = :name, username = :username, password = :password WHERE id = '".$user->id."'");
                                $create->execute([
                                    "name" => $name,
                                    "username" => $username,
                                    "password" => $password ? md5($password) : $user->password,
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
                                        <input type="text" class="form-control" name="name" value="<?php echo old("name", $user->name); ?>" placeholder="Öğrenci Adı" aria-describedby="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="username">Öğrenci No</span>
                                        <input type="text" class="form-control" name="username" value="<?php echo old("username", $user->username); ?>" placeholder="Öğrenci No" aria-describedby="username">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="password">Parola</span>
                                        <input type="password" class="form-control" name="password" placeholder="Değiştirmek istemiyorsanız boş bırakın" aria-describedby="password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Öğrenci Güncelle</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>