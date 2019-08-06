<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include __DIR__."/../side.php" ?>
        </div>
        <div class="col-md-10">
            <form method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-plus"></i> Yeni Kategori Ekle</h3>
                    </div>
                    <div class="panel-body">

                        <?php
                        if($_POST){
                            $name = $_POST["name"];

                            $errors = Validation::valid([
                                "name" => [
                                    "text" => "kategori adı",
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
                                $create = Application::$db->db->prepare("INSERT INTO categories(name) VALUES(:name)");
                                $create->execute([
                                    "name" => $name,
                                ]);

                                redirect("index.php?panel=admin&module=category&action=index");
                            }
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="name">Kategori Adı</span>
                                        <input type="text" class="form-control" name="name" value="<?php echo old("name"); ?>" placeholder="Kitap Adı" aria-describedby="name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Yeni Kategori Ekle</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>