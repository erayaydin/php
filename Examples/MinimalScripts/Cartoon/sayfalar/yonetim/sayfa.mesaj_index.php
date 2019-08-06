<section class="home">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Yönetim Paneli &middot; Mesajlar</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Ad Soyad</th>
                        <th>E-Posta Adresi</th>
                        <th>Telefon</th>
                        <th>Mesaj</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($db->query("SELECT * FROM mesajlar ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ) as $mesaj): ?>
                        <tr>
                            <td><?php echo $mesaj->adsoyad; ?></td>
                            <td><?php echo $mesaj->eposta; ?></td>
                            <td><?php echo $mesaj->telefon; ?></td>
                            <td><?php echo $mesaj->mesaj; ?></td>
                            <td>
                                <a href="index.php?modul=yonetim&sayfa=mesaj_sil&mesaj=<?php echo $mesaj->id; ?>" class="btn btn-sm btn-danger">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>