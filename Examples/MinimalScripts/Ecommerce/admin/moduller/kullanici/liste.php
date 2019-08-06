<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Kullanıcılar</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <table class="table table-hovered table-striped table-bordered">
            <thead>
            <tr>
                <th width="5%">#</th>
                <th>Ad Soyad</th>
                <th>Kullanıcı Adı</th>
                <th>E-Posta</th>
                <th width="10%">Yönetici?</th>
                <th width="10%">Durum</th>
                <th width="20%">İşlem</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($db->query("SELECT * FROM kullanicilar ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ) as $kullanici): ?>
            <tr>
                <td><?php echo $kullanici->id; ?></td>
                <td><?php echo $kullanici->adsoyad; ?></td>
                <td><?php echo $kullanici->kullaniciadi; ?></td>
                <td><?php echo $kullanici->eposta; ?></td>
                <td>
                    <?php if($kullanici->yonetici): ?>
                        <span class="label label-success">Yönetici</span>
                    <?php else: ?>
                        <span class="label label-danger">Kullanıcı</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($kullanici->durum): ?>
                        <span class="label label-success">Aktif</span>
                    <?php else: ?>
                        <span class="label label-danger">Pasif</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="index.php?modul=kullanici&sayfa=duzenle&kullanici_id=<?php echo $kullanici->id; ?>" class="btn btn-xs btn-warning">Düzenle</a>
                    <a href="index.php?modul=kullanici&sayfa=sil&kullanici_id=<?php echo $kullanici->id; ?>" class="btn btn-xs btn-danger">Sil</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->