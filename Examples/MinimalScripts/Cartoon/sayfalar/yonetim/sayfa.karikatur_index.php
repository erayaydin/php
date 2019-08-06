<section class="home">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Yönetim Paneli &middot; Karikatür Yönetimi</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Kullanıcı</th>
                        <th>Çizer</th>
                        <th>Başlık</th>
                        <th>Beğenme Sayısı</th>
                        <th>Görüntülenme Sayısı</th>
                        <th>Durum</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($db->query("SELECT * FROM karikaturler ORDER BY durum ASC, id DESC")->fetchAll(PDO::FETCH_OBJ) as $karikatur): ?>
                        <?php $kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = ".$karikatur->kullanici_id)->fetch(PDO::FETCH_OBJ); ?>
                        <?php $cizer = $db->query("SELECT * FROM cizerler WHERE id = ".$karikatur->cizer_id)->fetch(PDO::FETCH_OBJ); ?>
                        <tr>
                            <td style="width: 60px;">
                                <a target="_blank" href="upload/karikatur/<?php echo $karikatur->id; ?>.png">
                                    <img src="upload/karikatur/<?php echo $karikatur->id; ?>.png" class="img-responsive" />
                                </a>
                            </td>
                            <td><?php echo $kullanici->kullaniciadi; ?></td>
                            <td><?php echo $cizer->name; ?></td>
                            <td><?php echo $karikatur->baslik; ?></td>
                            <td>
                                <span class="label label-default"><?php echo $karikatur->begenme; ?></span>
                            </td>
                            <td>
                                <span class="label label-default"><?php echo $karikatur->goruntulenme; ?></span>
                            </td>
                            <td>
                                <?php if($karikatur->durum): ?>
                                    <span class="label label-success">Aktif</span>
                                <?php else: ?>
                                    <span class="label label-danger">Onay Bekliyor</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($karikatur->durum): ?>
                                    <a href="index.php?modul=yonetim&sayfa=karikatur_pasif&karikatur=<?php echo $karikatur->id; ?>" class="btn btn-sm btn-warning">Pasif Yap</a>
                                <?php else: ?>
                                    <a href="index.php?modul=yonetim&sayfa=karikatur_aktif&karikatur=<?php echo $karikatur->id; ?>" class="btn btn-sm btn-success">Aktif Yap</a>
                                <?php endif; ?>
                                <a target="_blank" href="upload/karikatur/<?php echo $karikatur->id; ?>.png" class="btn btn-sm btn-primary">Resmi Göster</a>
                                <a href="index.php?modul=yonetim&sayfa=karikatur_sil&karikatur=<?php echo $karikatur->id; ?>" class="btn btn-sm btn-danger">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>