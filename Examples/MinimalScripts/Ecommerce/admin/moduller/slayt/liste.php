<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Slaytlar</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <p class="text-right">
            <a href="index.php?modul=slayt&sayfa=ekle" class="btn btn-success">Yeni Slayt Ekle</a>
        </p>
        <table class="table table-hovered table-striped table-bordered">
            <thead>
            <tr>
                <th width="5%">#</th>
                <th>Başlık</th>
                <th>Link</th>
                <th width="10%">Durum</th>
                <th width="20%">İşlem</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($db->query("SELECT * FROM slaytlar ORDER BY id ASC")->fetchAll(PDO::FETCH_OBJ) as $slayt): ?>
            <tr>
                <td><?php echo $slayt->id; ?></td>
                <td><?php echo $slayt->baslik; ?></td>
                <td><?php echo $slayt->link; ?></td>
                <td>
                    <?php if($slayt->durum): ?>
                        <span class="label label-success">Aktif</span>
                    <?php else: ?>
                        <span class="label label-danger">Pasif</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="index.php?modul=slayt&sayfa=duzenle&slayt_id=<?php echo $slayt->id; ?>" class="btn btn-xs btn-warning">Düzenle</a>
                    <a href="index.php?modul=slayt&sayfa=sil&slayt_id=<?php echo $slayt->id; ?>" class="btn btn-xs btn-danger">Sil</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->