<section class="home">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">En Yeni Karikatürler</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach($db->query("SELECT * FROM karikaturler WHERE durum = 1 ORDER BY id DESC LIMIT 0,3")->fetchAll(PDO::FETCH_OBJ) as $yeni): ?>
            <div class="col-md-4">
                <?php karikaturGoster($yeni); ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-center">
                    <a href="index.php?modul=cartoon&sayfa=index" class="btn btn-primary">Tüm Karikatürler <i class="fa fa-arrow-right"></i></a>
                </p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Popüler Karikatürler</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach($db->query("SELECT * FROM karikaturler WHERE durum = 1 ORDER BY begenme,goruntulenme DESC LIMIT 0,3")->fetchAll(PDO::FETCH_OBJ) as $populer): ?>
            <div class="col-md-4">
                <?php karikaturGoster($populer); ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-center">
                    <a href="index.php?modul=cartoon&sayfa=popular" class="btn btn-danger">Tüm Popüler Karikatürler <i class="fa fa-arrow-right"></i></a>
                </p>
            </div>
        </div>
        <br>
    </div>
</section>