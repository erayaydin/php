<?php

?>
<section class="sayfa">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Sepetteki Ürünler</h3>
                <br>
                <?php if(isset($_SESSION["sepet"]) && count($_SESSION["sepet"]) > 0): ?>
                <div class="well">
                    <form method="post" action="index.php?modul=sepet&sayfa=guncelle">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Ürün Adı</th>
                            <th>Fiyatı</th>
                            <th width="10%">Adet</th>
                            <th width="5%">Kaldır</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($_SESSION["sepet"] as $sepet): ?>
                            <?php $urun = $db->query("SELECT * FROM urunler WHERE id = ".$sepet['urun_id'])->fetch(PDO::FETCH_OBJ); ?>
                        <tr>
                            <td><img src="upload/urun/<?php echo $urun->id; ?>.png" width="60" /></td>
                            <td><?php echo $urun->baslik; ?></td>
                            <td><?php echo number_format($urun->fiyat, 2); ?> <i class="fa fa-try"></i></td>
                            <td><input class="form-control input-sm" type="text" name="urun[<?php echo $urun->id; ?>]" value="<?php echo $sepet["adet"]; ?>"></td>
                            <td><a href="index.php?modul=sepet&sayfa=sil&urun_id=<?php echo $urun->id; ?>" class="btn btn-xs btn-danger pull-right"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                        <input type="submit" class="btn btn-warning" value="Ürünleri Güncelle">
                        <a href="index.php?modul=sepet&sayfa=bosalt" class="btn btn-danger">Sepeti Boşalt</a>
                        <a href="index.php?modul=sepet&sayfa=ekle" class="pull-right btn btn-success">Onayla</a>
                    </form>
                </div>
                <?php else: ?>
                <div class="alert alert-danger">
                    <p>Sepetinizde hiç ürün bulunmuyor.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>