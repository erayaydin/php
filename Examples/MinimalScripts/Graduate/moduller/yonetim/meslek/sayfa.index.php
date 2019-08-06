<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-top">
                    Meslekler
                    <a href="index.php?modul=yonetim/meslek&sayfa=ekle" class="btn btn-primary pull-right">Yeni Meslek Ekle <i class="fa fa-plus"></i></a>
                </h3>
                <br>
                <?php
                $query = "SELECT * FROM meslekler ORDER BY isim ASC";
                $meslekler = $db->query($query)->fetchAll(PDO::FETCH_OBJ);

                if(count($meslekler) > 0):
                ?>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>İsim</th>
                        <th width="22%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($meslekler as $meslek): ?>
                        <tr>
                            <td><?php echo $meslek->isim; ?></td>
                            <td>
                                <a href="index.php?modul=yonetim/meslek&sayfa=duzenle&meslek_id=<?php echo $meslek->id; ?>" class="btn btn-warning btn-xs">Düzenle</a>
                                <a href="index.php?modul=yonetim/meslek&sayfa=sil&meslek_id=<?php echo $meslek->id; ?>" class="btn btn-danger btn-xs">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="alert alert-danger">
                    <p>Henüz eklenen bir meslek yok.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>