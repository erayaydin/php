<?php
$user = Application::$db->db->query("SELECT * FROM users WHERE id = '".$_GET['user']."'")->fetch(PDO::FETCH_OBJ);

if($_POST){
    $price = $_POST["price"];
    if($price){
        $create = Application::$db->db->prepare("INSERT INTO payments(user_id,amount) VALUES(:user,:amount)");
        $create->execute([
            "user" => $user->id,
            "amount" => $price
        ]);
    }
}

$payments = Application::$db->db->query("SELECT * FROM payments WHERE user_id = '".$user->id."' ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ);

$borrows = Application::$db->db->prepare("SELECT * FROM borrows WHERE user_id = :user ORDER BY id DESC");
$borrows->execute([
    "user" => $user->id
]);
$borrows = $borrows->fetchAll(PDO::FETCH_OBJ);

$totalPay = 0;
foreach($borrows as $borrow)
    $totalPay += $borrow->price;
$payed = 0;
$userPayments = Application::$db->db->query("SELECT * FROM payments WHERE user_id = '".$user->id."'")->fetchAll(PDO::FETCH_OBJ);
foreach($userPayments as $pay)
    $payed += $pay->amount;

$debt = $totalPay - $payed;
?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include __DIR__."/../side.php" ?>
        </div>
        <div class="col-md-10">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $user->name; ?> - Ödemeler</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="alert alert-danger">
                                <p class="text-center">Borç<br><span style="font-size: 24px;"><?php echo number_format($totalPay,2) ?> <i class="fa fa-try"></i></span></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-success">
                                <p class="text-center">Ödenen<br><span style="font-size: 24px;"><?php echo number_format($payed,2) ?> <i class="fa fa-try"></i></span></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?php if($debt > 0): ?>
                                <div class="alert alert-danger">
                                    <p class="text-center">Kalan<br><span style="font-size: 24px;"><?php echo number_format($debt,2) ?> <i class="fa fa-try"></i></span></p>
                                </div>
                            <?php elseif($debt == 0): ?>
                                <div class="alert alert-success">
                                    <p class="text-center" style="font-size: 25px; padding: 9px;">Tüm Borç Ödendi!</p>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-warning">
                                    <p class="text-center">Fazla Ödenen<br><span style="font-size: 24px;"><?php echo number_format(($debt*-1),2) ?> <i class="fa fa-try"></i></span></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <form method="POST">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="price" class="form-control" placeholder="Tutar">
                                <span class="input-group-btn">
                            <button class="btn btn-success" type="submit">Ödeme Ekle</button>
                          </span>
                            </div><!-- /input-group -->
                        </div>
                    </form>
                    <?php if($payments): ?>
                        <table class="table table-bordered table-striped table-hovered table-hover" style="margin: 0;">
                            <thead>
                            <tr>
                                <th>Miktar</th>
                                <th class="text-right" style="width: 220px;">İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($payments as $payment): ?>
                                <tr>
                                    <td><?php echo number_format($payment->amount,2); ?> <i class="fa fa-try"></i></td>
                                    <td class="text-right">
                                        <a href="index.php?panel=admin&module=student&action=paymentDelete&user=<?php echo $user->id; ?>&payment=<?php echo $payment->id; ?>" class="btn btn-xs btn-danger">Sil <i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-danger" style="margin: 0;">
                            <p>Ödeme Eklenmedi.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>