<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include __DIR__."/../side.php" ?>
        </div>
        <div class="col-md-10">
            <form method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-plus"></i> Yeni Kitap Ekle</h3>
                    </div>
                    <div class="panel-body">

                        <?php
                        if($_POST){
                            $isbn = $_POST["isbn"];
                            $name = $_POST["name"];
                            $category_id = $_POST["category_id"];
                            $author = $_POST["author"];
                            $quantity = $_POST["quantity"];

                            $errors = Validation::valid([
                                "isbn" => [
                                    "text"  => "isbn",
                                    "check" => "required"
                                ],
                                "name" => [
                                    "text" => "kitap adı",
                                    "check" => "required"
                                ],
                                "author" => [
                                    "text" => "yazar",
                                    "check" => "required"
                                ],
                                "quantity" => [
                                    "text" => "adet",
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
                                $create = Application::$db->db->prepare("INSERT INTO books(category_id,name,author,quantity,isbn) VALUES(:category,:name,:author,:quantity,:isbn)");
                                $create->execute([
                                    "category" => $category_id,
                                    "name" => $name,
                                    "author" => $author,
                                    "quantity" => $quantity,
                                    "isbn" => $isbn
                                ]);

                                redirect("index.php?panel=admin&module=book&action=index");
                            }
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="author_id">ISBN</span>
                                        <input type="text" class="form-control" name="isbn" value="<?php echo old("isbn"); ?>" placeholder="ISBN No" aria-describedby="isbn">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="name">Kitap Adı</span>
                                        <input type="text" class="form-control" name="name" value="<?php echo old("name"); ?>" placeholder="Kitap Adı" aria-describedby="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="category_id">Kategori</span>
                                        <select name="category_id" class="form-control">
                                            <option value="0">Tanımsız</option>
                                            <?php foreach(Application::$db->db->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll(PDO::FETCH_OBJ) as $category): ?>
                                                <option <?php if($category->id == old("category_id")): ?> selected <?php endif; ?> value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="author">Yazar</span>
                                        <input type="text" class="form-control" name="author" value="<?php echo old("author"); ?>" placeholder="Yazar" aria-describedby="author">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="quantity">Adet</span>
                                        <input type="text" class="form-control" name="quantity" value="<?php echo old("quantity"); ?>" placeholder="Adet" aria-describedby="quantity">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Yeni Kitap Ekle</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>