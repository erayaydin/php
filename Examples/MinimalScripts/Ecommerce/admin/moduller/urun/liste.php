<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Ürünler</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <p class="text-right">
            <a href="index.php?modul=urun&sayfa=ekle" class="btn btn-success">Yeni Ürün Ekle</a>
        </p>
        <table class="table table-hovered table-striped table-bordered">
            <thead>
            <tr>
                <th width="5%">#</th>
                <th>Ürün Adı</th>
                <th>Kategori</th>
                <th>Fiyat</th>
                <th width="15%">Görüntülenme</th>
                <th width="10%">Durum</th>
                <th width="20%">İşlem</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($db->query("SELECT * FROM urunler ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ) as $urun): ?>
                <?php $kategori = $db->query("SELECt * FROM kategoriler WHERE id = ".$urun->kategori_id)->fetch(PDO::FETCH_OBJ); ?>
            <tr>
                <td><?php echo $urun->id; ?></td>
                <td><?php echo $urun->baslik; ?></td>
                <td><?php echo $kategori->baslik; ?></td>
                <td><?php echo number_format($urun->fiyat, 2); ?> <i class="fa fa-try"></i></td>
                <td><?php echo $urun->goruntulenme; ?></td>
                <td>
                    <?php if($urun->durum): ?>
                        <span class="label label-success">Aktif</span>
                    <?php else: ?>
                        <span class="label label-danger">Pasif</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="index.php?modul=urun&sayfa=duzenle&urun_id=<?php echo $urun->id; ?>" class="btn btn-xs btn-warning">Düzenle</a>
                    <a href="index.php?modul=urun&sayfa=sil&urun_id=<?php echo $urun->id; ?>" class="btn btn-xs btn-danger">Sil</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->