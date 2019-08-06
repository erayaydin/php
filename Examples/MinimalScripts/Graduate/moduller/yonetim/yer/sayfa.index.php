<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-top">
                    Şehirler
                    <a href="index.php?modul=yonetim/yer&sayfa=ekle" class="btn btn-primary pull-right">Yeni Şehir Ekle <i class="fa fa-plus"></i></a>
                </h3>
                <br>
                <?php
                $query = "SELECT * FROM yerler ORDER BY isim ASC";
                $yerler = $db->query($query)->fetchAll(PDO::FETCH_OBJ);

                if(count($yerler) > 0):
                ?>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>İsim</th>
                        <th width="22%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($yerler as $yer): ?>
                        <tr>
                            <td><?php echo $yer->isim; ?></td>
                            <td>
                                <a href="index.php?modul=yonetim/yer&sayfa=duzenle&yer_id=<?php echo $yer->id; ?>" class="btn btn-warning btn-xs">Düzenle</a>
                                <a href="index.php?modul=yonetim/yer&sayfa=sil&yer_id=<?php echo $yer->id; ?>" class="btn btn-danger btn-xs">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="alert alert-danger">
                    <p>Henüz eklenen bir şehir yok.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>