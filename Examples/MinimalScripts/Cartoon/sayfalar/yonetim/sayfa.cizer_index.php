<section class="home">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Yönetim Paneli &middot; Çizerler</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-right">
                    <a href="index.php?modul=yonetim&sayfa=cizer_ekle" class="btn btn-success">Çizer Ekle</a>
                </p>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Ad Soyad</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($db->query("SELECT * FROM cizerler ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ) as $cizer): ?>
                        <tr>
                            <td><?php echo $cizer->name; ?></td>
                            <td>
                                <a href="index.php?modul=yonetim&sayfa=cizer_duzenle&cizer=<?php echo $cizer->id; ?>" class="btn btn-sm btn-warning">Düzenle</a>
                                <a href="index.php?modul=yonetim&sayfa=cizer_sil&cizer=<?php echo $cizer->id; ?>" class="btn btn-sm btn-danger">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>