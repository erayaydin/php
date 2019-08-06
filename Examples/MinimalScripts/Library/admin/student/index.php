<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include __DIR__."/../side.php" ?>
        </div>
        <div class="col-md-10">
            <p class="text-right">
                <a href="index.php?panel=admin&module=student&action=create" class="btn btn-success">Yeni Öğrenci Ekle <i class="fa fa-plus-circle"></i></a>
            </p>

            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Öğrenciler</h3>
                </div>
                <div class="panel-body" style="padding: 0;">
                    <table class="table table-bordered table-striped table-hovered table-hover" style="margin: 0;">
                        <thead>
                        <tr>
                            <th>Öğrenci Adı</th>
                            <th>Öğrenci Numarası</th>
                            <th>Borç</th>
                            <th class="text-right" style="width: 220px;">İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach(Application::$db->db->query("SELECT * FROM users WHERE type = 'student' ORDER BY name ASC")->fetchAll(PDO::FETCH_OBJ) as $user): ?>
                            <?php
                            $borrows = Application::$db->db->prepare("SELECT * FROM borrows WHERE user_id = :user ORDER BY id DESC");
                            $borrows->execute([
                                "user" => $user->id
                            ]);
                            $borrows = $borrows->fetchAll(PDO::FETCH_OBJ);


                            $totalPay = 0;
                            foreach($borrows as $borrow)
                                $totalPay += $borrow->price;
                            $payments = 0;
                            $userPayments = Application::$db->db->query("SELECT * FROM payments WHERE user_id = '".$user->id."'")->fetchAll(PDO::FETCH_OBJ);
                            foreach($userPayments as $pay)
                                $payments += $pay->amount;
                            ?>
                            <tr>
                                <td><?php echo $user->name; ?></td>
                                <td><?php echo $user->username; ?></td>
                                <td>
                                    <?php if($totalPay-$payments > 0): ?>
                                        <span class="label label-danger"><?php echo number_format($totalPay-$payments, 2); ?> <i class="fa fa-try"></i></span>
                                    <?php else: ?>
                                        <span class="label label-success">Borç Yok</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <a href="index.php?panel=admin&module=student&action=payment&user=<?php echo $user->id; ?>" class="btn btn-xs btn-primary">Ödemeler <i class="fa fa-try"></i></a>
                                    <a href="index.php?panel=admin&module=student&action=edit&user=<?php echo $user->id; ?>" class="btn btn-xs btn-warning">Düzenle <i class="fa fa-pencil"></i></a>
                                    <a href="index.php?panel=admin&module=student&action=delete&user=<?php echo $user->id; ?>" class="btn btn-xs btn-danger">Sil <i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>