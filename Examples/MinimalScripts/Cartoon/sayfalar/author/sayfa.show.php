<?php
$cizer = $db->query("SELECT * FROM cizerler WHERE id = ".$_GET['cizer'])->fetch(PDO::FETCH_OBJ);
?>
<section class="home">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> <i class="fa fa-user-circle-o"></i> <?php echo $cizer->name; ?> ÇİZERİNE AİT KARİKATÜRLER</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach($db->query("SELECT * FROM karikaturler WHERE durum = 1 AND cizer_id = '".$cizer->id."' ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ) as $yeni): ?>
                <div class="col-md-4">
                    <?php karikaturGoster($yeni); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>