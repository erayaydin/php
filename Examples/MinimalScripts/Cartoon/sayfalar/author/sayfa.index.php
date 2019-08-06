<section class="home">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Karikatüristler</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach($db->query("SELECT * FROM cizerler ORDER BY name ASC")->fetchAll(PDO::FETCH_OBJ) as $author): ?>
            <div class="col-md-4">
                <p>
                    <a href="index.php?modul=author&sayfa=show&cizer=<?php echo $author->id; ?>" class="btn btn-block btn-default"><i class="fa fa-user-circle-o"></i> <?php echo $author->name; ?></a>
                </p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>