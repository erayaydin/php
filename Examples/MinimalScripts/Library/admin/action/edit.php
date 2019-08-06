<?php $borrowm = Application::$db->db->query("SELECT * FROM borrows WHERE id = '".$_GET['action_id']."'")->fetch(PDO::FETCH_OBJ); ?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include __DIR__."/../side.php" ?>
        </div>
        <div class="col-md-10">
            <form method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-refresh"></i> Veriş Düzenle</h3>
                    </div>
                    <div class="panel-body">

                        <?php
                        if($_POST){
                            $bookId = $_POST["book_id"];
                            $userId = $_POST["user_id"];
                            $borrow = $_POST["borrow"];
                            $return = $_POST["return"];
                            $price = $_POST["price"];

                            $errors = Validation::valid([
                                "borrow" => [
                                    "text" => "veriş tarihi",
                                    "check" => "required"
                                ],
                                "price" => [
                                    "text" => "ücret",
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

                                $borrow = pcDate($borrow);
                                $status = 0;
                                if($return) {
                                    $return = pcDate($return);
                                    $status = 1;
                                }

                                $edit = Application::$db->db->prepare("UPDATE borrows SET book_id = :book, user_id = :user, status = :status, borrow_date = :borrow, return_date = :return, price = :price WHERE id = '".$borrowm->id."'");
                                $edit->execute([
                                    "book" => $bookId,
                                    "user" => $userId,
                                    "borrow" => $borrow,
                                    "return" => $return ? $return : null,
                                    "price" => $price,
                                    "status" => $status,
                                ]);

                                redirect("index.php?panel=admin&module=action&action=index");
                            }
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="user_id">Öğrenci</span>
                                        <select name="user_id" class="form-control">
                                            <?php foreach(Application::$db->db->query("SELECT * FROM users WHERE type = 'student' ORDER BY username ASC")->fetchAll(PDO::FETCH_OBJ) as $user): ?>
                                                <option <?php if($user->id == $borrowm->user_id): ?> selected <?php endif; ?> value="<?php echo $user->id; ?>"><?php echo $user->username." - ".$user->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="book_id">Kitap</span>
                                        <select name="book_id" class="form-control">
                                            <?php foreach(Application::$db->db->query("SELECT * FROM books ORDER BY name ASC")->fetchAll(PDO::FETCH_OBJ) as $book): ?>
                                                <option <?php if($book->id == $borrowm->book_id): ?> selected <?php endif; ?> value="<?php echo $book->id; ?>"><?php echo $book->name."(".$book->isbn.")"; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="borrow_date">Veriş Tarihi</span>
                                        <input type="text" class="form-control datepicker" name="borrow" value="<?php echo old("borrow_date", humanDate($borrowm->borrow_date)); ?>" placeholder="Veriş Tarihi" aria-describedby="borrow_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="return_date">İade Tarihi</span>
                                        <input type="text" class="form-control datepicker" name="return" value="<?php echo old("return_date", humanDate($borrowm->return_date)); ?>" placeholder="İade Tarihi" aria-describedby="return_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="price">Ücret</span>
                                        <input type="text" class="form-control" name="price" value="<?php echo old("price", $borrowm->price); ?>" placeholder="Ücret" aria-describedby="price">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Kitabı Güncelle</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>