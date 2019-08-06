<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include __DIR__."/../side.php" ?>
        </div>
        <div class="col-md-10">
            <p class="text-right">
                <a href="index.php?panel=admin&module=action&action=create" class="btn btn-success">Kitap Ver <i class="fa fa-plus-circle"></i></a>
            </p>
            <form method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-search"></i> İşlem Ara</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="user_id">Öğrenci</span>
                                        <select name="user_id" class="form-control">
                                            <option value="0">Hepsi</option>
                                            <?php foreach(Application::$db->db->query("SELECT * FROM users WHERE type = 'student' ORDER BY username ASC")->fetchAll(PDO::FETCH_OBJ) as $user): ?>
                                                <option <?php if($user->id == old("user_id")): ?> selected <?php endif; ?> value="<?php echo $user->id; ?>"><?php echo $user->username." - ".$user->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="borrow_date_start">Veriş Başlangıç Tarihi</span>
                                        <input type="text" class="form-control datepicker" name="borrow_date_start" value="<?php echo old("borrow_date_start"); ?>" placeholder="Veriş Tarihi Başlangıç" aria-describedby="borrow_date_start">
                                        <span class="input-group-addon" id="borrow_date_end">-</span>
                                        <input type="text" class="form-control datepicker" name="borrow_date_end" value="<?php echo old("borrow_date_end"); ?>" placeholder="Veriş Tarihi Bitiş" aria-describedby="borrow_date_end">
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
                $user_id = $_POST["user_id"];
                $start = $_POST["borrow_date_start"];
                $end = $_POST["borrow_date_end"];

                if($start){
                    $exp = explode(".", $start);
                    $start = $exp[2]."-".$exp[1]."-".$exp[0];
                }
                if($end) {
                    $exp = explode(".", $end);
                    $end = $exp[2]."-".$exp[1]."-".$exp[0];
                }

                $sql = "SELECT * FROM borrows WHERE id > 0";

                if($user_id)
                    $sql .= " AND user_id = '".$user_id."'";

                if($start)
                    $sql .= " AND borrow_date >= '".$start."'";
                if($end)
                    $sql .= " AND borrow_date <= '".$end."'";

                $sql .= " ORDER BY id DESC";

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
                                    <th>Öğrenci</th>
                                    <th>ISBN</th>
                                    <th class="text-center">Kitap</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Yazar</th>
                                    <th class="text-center">Rezervasyon</th>
                                    <th class="text-center">Veriş</th>
                                    <th class="text-center">Alış</th>
                                    <th class="text-center">Ücret</th>
                                    <th class="text-right" style="width: 24%;">İşlem</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($search as $borrow): ?>
                                    <?php
                                    $user = Application::$db->db->query("SELECT * FROM users WHERE id = '".$borrow->user_id."'")->fetch(PDO::FETCH_OBJ);
                                    $book = Application::$db->db->query("SELECT * FROM books WHERE id = '".$borrow->book_id."'")->fetch(PDO::FETCH_OBJ);
                                    $category = Application::$db->db->query("SELECT * FROM categories WHERE id = '".$book->category_id."'")->fetch(PDO::FETCH_OBJ);
                                    ?>
                                    <tr>
                                        <td><?php echo $user->username." - ".$user->name ?></td>
                                        <td><?php echo $book->isbn; ?></td>
                                        <td class="text-center"><?php echo $book->name; ?></td>
                                        <td class="text-center"><?php echo $category ? $category->name : "Kategori Yok"; ?></td>
                                        <td class="text-center"><?php echo $book->author; ?></td>
                                        <td class="text-center">
                                            <?php if($borrow->reservation_date): ?>
                                                <span class="label label-primary"><?php echo humanDate($borrow->reservation_date); ?></span>
                                            <?php else: ?>
                                                <span class="label label-default">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if($borrow->borrow_date): ?>
                                                <span class="label label-primary"><?php echo humanDate($borrow->borrow_date); ?></span>
                                            <?php else: ?>
                                                <span class="label label-default">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if($borrow->return_date): ?>
                                                <span class="label label-primary"><?php echo humanDate($borrow->return_date); ?></span>
                                            <?php else: ?>
                                                <span class="label label-default">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center"><?php echo number_format($borrow->price, 2); ?> <i class="fa fa-try"></i></td>
                                        <td class="text-right">
                                            <?php if($borrow->borrow_date && !$borrow->return_date): ?>
                                                <a href="index.php?panel=admin&module=action&action=give&action_id=<?php echo $borrow->id; ?>" class="btn btn-xs btn-primary">Alındı <i class="fa fa-reply"></i></a>
                                            <?php endif; ?>
                                            <?php if($borrow->reservation_date): ?>
                                                <a href="index.php?panel=admin&module=action&action=change&action_id=<?php echo $borrow->id; ?>" class="btn btn-xs btn-primary">Ver <i class="fa fa-send"></i></a>
                                            <?php endif; ?>
                                            <?php if(!$borrow->reservation_date): ?>
                                            <a href="index.php?panel=admin&module=action&action=edit&action_id=<?php echo $borrow->id; ?>" class="btn btn-xs btn-warning">Düzenle <i class="fa fa-pencil"></i></a>
                                            <?php endif; ?>
                                            <a href="index.php?panel=admin&module=action&action=delete&action_id=<?php echo $borrow->id; ?>" class="btn btn-xs btn-danger">Sil <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger">
                        <p>Henüz kitap eklenmedi.</p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>