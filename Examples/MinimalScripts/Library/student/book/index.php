<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include __DIR__."/../side.php" ?>
        </div>
        <div class="col-md-10">
            <?php
            $borrows = Application::$db->db->prepare("SELECT * FROM borrows WHERE user_id = :user ORDER BY id DESC");
            $borrows->execute([
                "user" => Application::$auth->user->id
            ]);
            $borrows = $borrows->fetchAll(PDO::FETCH_OBJ);
            ?>

            <?php
            $totalPay = 0;
            foreach($borrows as $borrow)
                $totalPay += $borrow->price;
            $payments = 0;
            $userPayments = Application::$db->db->query("SELECT * FROM payments WHERE user_id = '".Application::$auth->user->id."'")->fetchAll(PDO::FETCH_OBJ);
            foreach($userPayments as $pay)
                $payments += $pay->amount;
            ?>

            <?php if($totalPay-$payments > 0): ?>
            <div class="alert alert-danger">
                <p class="text-center">Ödemeniz Gereken Tutar<br><span style="font-size: 24px;"><?php echo number_format($totalPay-$payments,2) ?> <i class="fa fa-try"></i></span></p>
            </div>
            <?php endif; ?>

            <?php if($borrows): ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Rezervasyonlarım</h3>
                </div>
                <div class="panel-body" style="padding: 0;">
                    <table class="table table-bordered table-striped table-hovered table-hover" style="margin: 0;">
                        <thead>
                        <tr>
                            <th>ISBN</th>
                            <th class="text-center">Kitap Adı</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Yazar</th>
                            <th class="text-center">Rezervasyon Tarihi</th>
                            <th class="text-center">Alış Tarihi</th>
                            <th class="text-center">Teslim Tarihi</th>
                            <th class="text-center">Ücret</th>
                            <th class="text-right">İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($borrows as $borrow): ?>
                            <?php
                            $book = Application::$db->db->query("SELECT * FROM books WHERE id = '".$borrow->book_id."'")->fetch(PDO::FETCH_OBJ);
                            $category = Application::$db->db->query("SELECT * FROM categories WHERE id = '".$book->category_id."'")->fetch(PDO::FETCH_OBJ);
                            ?>
                            <tr>
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
                                    <?php if($borrow->reservation_date): ?>
                                        <a href="index.php?panel=student&module=book&action=cancel&borrow=<?php echo $borrow->id; ?>" class="btn btn-danger btn-xs">İptal Et <i class="fa fa-times"></i></a>
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
                    <p>Aldığınız veya rezerve etiğiniz bir kitap bulunamadı.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>