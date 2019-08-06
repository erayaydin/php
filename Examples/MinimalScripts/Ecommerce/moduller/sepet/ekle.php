<section class="sayfa">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4 style="margin-top: 0;">Ürünler</h4>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Ürün</th>
                        <th>Fiyat</th>
                        <th width="10%">Adet</th>
                        <th width="10%">Toplam</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($_SESSION["sepet"] as $sepet): ?>
                        <?php $urun = $db->query("SELECT * FROM urunler WHERE id = ".$sepet['urun_id'])->fetch(PDO::FETCH_OBJ); ?>
                        <tr>
                            <td><img src="upload/urun/<?php echo $urun->id; ?>.png" width="60" /></td>
                            <td><?php echo $urun->baslik; ?></td>
                            <td><?php echo number_format($urun->fiyat, 2); ?> <i class="fa fa-try"></i></td>
                            <td><?php echo $sepet["adet"]; ?></td>
                            <td><?php echo number_format($urun->fiyat*$sepet["adet"]); ?> <i class="fa fa-try"></i></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-8">
                <form method="post" action="index.php?modul=sepet&sayfa=gonder">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Sipariş Onayı</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="adsoyad">İsim Soyisim</label>
                                <input type="text" required name="adsoyad" class="form-control" <?php if($giris): ?> readonly value="<?php echo $giris->adsoyad; ?>" <?php endif; ?>>
                            </div>
                            <div class="form-group">
                                <label for="email">E-Posta Adresi</label>
                                <input type="email" required name="email" class="form-control" <?php if($giris): ?> readonly value="<?php echo $giris->eposta; ?>" <?php endif; ?>>
                            </div>
                            <div class="form-group">
                                <label for="telefon">Telefon</label>
                                <input type="tel" required name="telefon" class="form-control" <?php if($giris && $giris->telefon): ?> readonly value="<?php echo $giris->telefon; ?>" <?php endif; ?>>
                            </div>
                            <div class="form-group">
                                <label for="adres">Adres</label>
                                <textarea name="adres" required id="adres" class="form-control" <?php if($giris && $giris->adres): ?> readonly <?php endif; ?>><?php if($giris && $giris->adres) echo $giris->adres; ?></textarea>
                            </div>
                            <p class="text-center">
                                <button type="submit" class="btn btn-success">SİPARİŞİ GÖNDER</button>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>