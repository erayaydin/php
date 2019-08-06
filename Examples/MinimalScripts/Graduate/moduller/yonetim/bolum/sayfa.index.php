<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-top">
                    Bölümler
                    <a href="index.php?modul=yonetim/bolum&sayfa=ekle" class="btn btn-primary pull-right">Yeni Bölüm Ekle <i class="fa fa-plus"></i></a>
                </h3>
                <br>
                <?php
                $query = "SELECT * FROM bolumler ORDER BY isim ASC";
                $bolumler = $db->query($query)->fetchAll(PDO::FETCH_OBJ);

                if(count($bolumler) > 0):
                ?>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>İsim</th>
                        <th width="22%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($bolumler as $bolum): ?>
                        <tr>
                            <td><?php echo $bolum->isim; ?></td>
                            <td>
                                <a href="index.php?modul=yonetim/bolum&sayfa=duzenle&bolum_id=<?php echo $bolum->id; ?>" class="btn btn-warning btn-xs">Düzenle</a>
                                <a href="index.php?modul=yonetim/bolum&sayfa=sil&bolum_id=<?php echo $bolum->id; ?>" class="btn btn-danger btn-xs">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="alert alert-danger">
                    <p>Henüz eklenen bir bölüm yok.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>