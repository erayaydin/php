<section class="home">
    <div class="container">
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
            <?php foreach($db->query("SELECT * FROM karikaturler WHERE durum = 1 ORDER BY begenme,goruntulenme DESC")->fetchAll(PDO::FETCH_OBJ) as $yeni): ?>
            <div class="col-md-4">
                <?php karikaturGoster($yeni); ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>