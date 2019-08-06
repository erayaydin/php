<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include __DIR__."/../side.php" ?>
        </div>
        <div class="col-md-10">
            <form method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-search"></i> Kitap Ara</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="author_id">ISBN</span>
                                        <input type="text" class="form-control" name="isbn" value="<?php echo old("isbn"); ?>" placeholder="ISBN No'ya Göre Ara" aria-describedby="isbn">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="category_id">Kategori</span>
                                        <select name="category_id" class="form-control">
                                            <option value="0">Hepsi</option>
                                            <?php foreach(Application::$db->db->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll(PDO::FETCH_OBJ) as $category): ?>
                                                <option <?php if($category->id == old("category_id")): ?> selected <?php endif; ?> value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="name">Kitap Adı</span>
                                        <input type="text" class="form-control" name="name" value="<?php echo old("name"); ?>" placeholder="Kitap Adına Göre Ara" aria-describedby="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="author">Yazar</span>
                                        <input type="text" class="form-control" name="author" value="<?php echo old("author"); ?>" placeholder="Kitap Adına Göre Ara" aria-describedby="author">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search-plus"></i> Arama Yap</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <?php if($_POST): ?>
                <?php
                $name = $_POST["name"];
                $author = $_POST["author"];
                $isbn = $_POST["isbn"];
                $category = $_POST["category_id"];

                $sql = "SELECT * FROM books WHERE id > 0";

                if($isbn){
                    $sql .= " AND isbn = '".$isbn."'";
                } else {
                    if($name)
                        $sql .= " AND name LIKE '%".$name."%'";
                    if($author)
                        $sql .= " AND author LIKE '%".$author."%'";
                    if($category)
                        $sql .= " AND category_id = '".$category."'";
                }

                $sql .= " ORDER BY name ASC";

                $search = Application::$db->db->query($sql)->fetchAll(PDO::FETCH_OBJ);
                ?>

                <?php if($search): ?>
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">Arama Sonucu</h3>
                        </div>
                        <div class="panel-body" style="padding: 0;">
                            <table class="table table-bordered table-striped table-hovered table-hover" style="margin: 0;">
                                <thead>
                                <tr>
                                    <th>ISBN</th>
                                    <th class="text-center">Kitap Adı</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Yazar</th>
                                    <th class="text-center">Mevcut</th>
                                    <th class="text-right">Rezervasyon</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($search as $book): ?>
                                <?php
                                $borrows = Application::$db->db->query("SELECT id FROM borrows WHERE book_id = '".$book->id."' AND status != 1")->rowCount();
                                $category = Application::$db->db->query("SELECT * FROM categories WHERE id = '".$book->category_id."'")->fetch(PDO::FETCH_OBJ);
                                ?>
                            <tr>
                                <td><?php echo $book->isbn; ?></td>
                                <td class="text-center"><?php echo $book->name; ?></td>
                                <td class="text-center"><?php echo $category ? $category->name : "Kategori Yok"; ?></td>
                                <td class="text-center"><?php echo $book->author; ?></td>
                                <td class="text-center">
                                    <?php if($book->quantity <= $borrows): ?>
                                        <span class="label label-danger">Mevcut Değil</span>
                                    <?php else: ?>
                                        <span class="label label-success">Mevcut</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <?php if($book->quantity > $borrows): ?>
                                        <?php $reserv = Application::$db->db->query("SELECT id FROM borrows WHERE user_id = '".Application::$auth->user->id."' AND book_id = '".$book->id."' AND reservation_date != null")->rowCount(); ?>
                                        <?php if(!$reserv): ?>
                                            <a href="index.php?panel=student&module=book&action=reservation&book=<?php echo $book->id; ?>" class="btn btn-success btn-xs">Rezervasyon Yap <i class="fa fa-book"></i></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger">
                        <p>Aradığınız kitap bulunamadı.</p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>