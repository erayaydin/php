<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-top">
                    Okullar
                    <a href="index.php?modul=yonetim/okul&sayfa=ekle" class="btn btn-primary pull-right">Yeni Okul Ekle <i class="fa fa-plus"></i></a>
                </h3>
                <br>
                <?php
                $query = "SELECT * FROM okullar ORDER BY isim ASC";
                $okullar = $db->query($query)->fetchAll(PDO::FETCH_OBJ);

                if(count($okullar) > 0):
                ?>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>İsim</th>
                        <th width="22%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($okullar as $okul): ?>
                        <tr>
                            <td><?php echo $okul->isim; ?></td>
                            <td>
                                <a href="index.php?modul=yonetim/okul&sayfa=duzenle&okul_id=<?php echo $okul->id; ?>" class="btn btn-warning btn-xs">Düzenle</a>
                                <a href="index.php?modul=yonetim/okul&sayfa=sil&okul_id=<?php echo $okul->id; ?>" class="btn btn-danger btn-xs">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="alert alert-danger">
                    <p>Henüz eklenen bir okul yok.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>