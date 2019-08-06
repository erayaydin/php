<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Sayfalar</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <p class="text-right">
            <a href="index.php?modul=sayfa&sayfa=ekle" class="btn btn-success">Yeni Sayfa Ekle</a>
        </p>
        <table class="table table-hovered table-striped table-bordered">
            <thead>
            <tr>
                <th width="5%">#</th>
                <th>Sayfa Adı</th>
                <th width="10%">Durum</th>
                <th width="20%">İşlem</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($db->query("SELECT * FROM sayfalar ORDER BY id ASC")->fetchAll(PDO::FETCH_OBJ) as $sayfa): ?>
            <tr>
                <td><?php echo $sayfa->id; ?></td>
                <td><?php echo $sayfa->baslik; ?></td>
                <td>
                    <?php if($sayfa->durum): ?>
                        <span class="label label-success">Aktif</span>
                    <?php else: ?>
                        <span class="label label-danger">Pasif</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="index.php?modul=sayfa&sayfa=duzenle&sayfa_id=<?php echo $sayfa->id; ?>" class="btn btn-xs btn-warning">Düzenle</a>
                    <a href="index.php?modul=sayfa&sayfa=sil&sayfa_id=<?php echo $sayfa->id; ?>" class="btn btn-xs btn-danger">Sil</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->