<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Kategoriler</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <p class="text-right">
            <a href="index.php?modul=kategori&sayfa=ekle" class="btn btn-success">Yeni Kategori Ekle</a>
        </p>
        <table class="table table-hovered table-striped table-bordered">
            <thead>
            <tr>
                <th width="5%">#</th>
                <th>Kategori Adı</th>
                <th>Açıklama</th>
                <th width="10%">Durum</th>
                <th width="20%">İşlem</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($db->query("SELECT * FROM kategoriler ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ) as $kategori): ?>
            <tr>
                <td><?php echo $kategori->id; ?></td>
                <td><?php echo $kategori->baslik; ?></td>
                <td><?php echo $kategori->aciklama; ?></td>
                <td>
                    <?php if($kategori->durum): ?>
                        <span class="label label-success">Aktif</span>
                    <?php else: ?>
                        <span class="label label-danger">Pasif</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="index.php?modul=kategori&sayfa=duzenle&kategori_id=<?php echo $kategori->id; ?>" class="btn btn-xs btn-warning">Düzenle</a>
                    <a href="index.php?modul=kategori&sayfa=sil&kategori_id=<?php echo $kategori->id; ?>" class="btn btn-xs btn-danger">Sil</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->