<?php
$totalBook = 0;
foreach(Application::$db->db->query("SELECT quantity FROM books")->fetchAll(PDO::FETCH_OBJ) as $tb)
    $totalBook += $tb->quantity;
$totalStudent = Application::$db->db->query("SELECT id FROM users WHERE type = 'student'")->rowCount();
$totalCategory = Application::$db->db->query("SELECT id FROM categories")->rowCount();

$willPay = 0;
$payed = 0;

$borrows = Application::$db->db->query("SELECT * FROM borrows")->fetchAll(PDO::FETCH_OBJ);
foreach($borrows as $borrow)
    $willPay += $borrow->price;

$pays = Application::$db->db->query("SELECT * FROM payments")->fetchAll(PDO::FETCH_OBJ);
foreach($pays as $pay)
    $payed += $pay->amount;
$total = $payed-$willPay;
?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include __DIR__."/../side.php" ?>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-4">
                    <div class="alert alert-info">
                        <h4 class="text-center"><i class="fa fa-book fa-3x"></i></h4>
                        <h4 class="text-center">Kitap Sayısı</h4>
                        <p class="text-center" style="font-size: 36px;"><?php echo $totalBook; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-info">
                        <h4 class="text-center"><i class="fa fa-bars fa-3x"></i></h4>
                        <h4 class="text-center">Kategori Sayısı</h4>
                        <p class="text-center" style="font-size: 36px;"><?php echo $totalCategory; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-info">
                        <h4 class="text-center"><i class="fa fa-graduation-cap fa-3x"></i></h4>
                        <h4 class="text-center">Öğrenci Sayısı</h4>
                        <p class="text-center" style="font-size: 36px;"><?php echo $totalStudent; ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="alert alert-danger">
                        <h4 class="text-center"><i class="fa fa-try fa-3x"></i></h4>
                        <h4 class="text-center">Toplam Alınacak</h4>
                        <p class="text-center" style="font-size: 36px;"><?php echo number_format($willPay, 2); ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-success">
                        <h4 class="text-center"><i class="fa fa-try fa-3x"></i></h4>
                        <h4 class="text-center">Toplam Alınan</h4>
                        <p class="text-center" style="font-size: 36px;"><?php echo number_format($payed, 2); ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-info <?php if($total > 0): ?> alert-success <?php else: ?> alert-danger <?php endif; ?>">
                        <h4 class="text-center"><i class="fa fa-try fa-3x"></i></h4>
                        <h4 class="text-center">Genel Toplam</h4>
                        <p class="text-center" style="font-size: 36px;"><?php echo number_format($total, 2); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>