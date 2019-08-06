<?php
if(!isset($_GET['siparis_id']))
    die("Sipariş ID bulunamadı!");
$siparis = $db->query("SELECT * FROM siparisler WHERE id = ".$_GET["siparis_id"])->fetch(PDO::FETCH_OBJ);
if(!$siparis)
    die("Sipariş bulunamadı!");
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $siparis->id; ?> Nolu Sipariş</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">Ürünler</h3>
            </div>
            <div class="panel-body" style="padding: 0;">
                <table class="table table-bordered table-hover table-striped table-responsive" style="width: 100%; margin: 0;">
                    <thead>
                    <tr>
                        <th>Ürün</th>
                        <th>Fiyat</th>
                        <th width="10%">Adet</th>
                        <th width="20%">Toplam</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $genelToplam = 0; ?>
                    <?php foreach($db->query("SELECT * FROM siparis_urunler WHERE siparis_id = ".$siparis->id)->fetchAll(PDO::FETCH_OBJ) as $sepet): ?>
                        <?php $urun = $db->query("SELECT * FROM urunler WHERE id = ".$sepet->urun_id)->fetch(PDO::FETCH_OBJ); ?>
                        <tr>
                            <td><?php echo $urun->baslik; ?></td>
                            <td><?php echo number_format($urun->fiyat, 2); ?> <i class="fa fa-try"></i></td>
                            <td><?php echo $sepet->adet; ?></td>
                            <td><?php echo number_format($urun->fiyat*$sepet->adet, 2); ?> <i class="fa fa-try"></i></td>
                            <?php $genelToplam += $urun->fiyat*$sepet->adet; ?>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3">Genel Toplam</td>
                        <td><?php echo number_format($genelToplam, 2); ?> <i class="fa fa-try"></i></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <p>
            <?php if($siparis->durum != 0): // Eğer sipariş onay beklemede değilse bu butonu göster. ?>
            <a href="index.php?modul=siparis&sayfa=durum&siparis_id=<?php echo $siparis->id; ?>&durum=0" class="btn btn-block btn-default">Siparişi Beklemeye Al</a>
            <?php endif; ?>
            <?php if($siparis->durum != 2): // Eğer sipariş kargoda değilse bu butonu göster. ?>
            <a href="index.php?modul=siparis&sayfa=durum&siparis_id=<?php echo $siparis->id; ?>&durum=2" class="btn btn-block btn-warning">Siparişi Kargoda Yap</a>
            <?php endif; ?>
            <?php if($siparis->durum != 1): // Eğer sipariş tamamlandı değilse bu butonu göster. ?>
            <a href="index.php?modul=siparis&sayfa=durum&siparis_id=<?php echo $siparis->id; ?>&durum=1" class="btn btn-block btn-success">Siparişi Tamamlandı Yap</a>
            <?php endif; ?>
        </p>
    </div>
    <div class="col-lg-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Sipariş Bilgileri</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                    <?php if($siparis->kullanici_id): // Eğer siparişi yapan bir kullanıcı ise... ?>
                        <?php $sipKul = $db->query("SELECT * FROM kullanicilar WHERE id = ".$siparis->kullanici_id)->fetch(PDO::FETCH_OBJ); ?>
                    <tr>
                        <td><b>Kullanıcı</b></td>
                        <td><a href="index.php?modul=kullanici&sayfa=duzenle&kullanici_id=<?php echo $sipKul->id; ?>" class="btn btn-xs btn-primary"><?php echo $sipKul->kullaniciadi; ?> (Detaylar)</a></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td><b>İsim Soyisim</b></td>
                        <td><?php echo $siparis->adsoyad; ?></td>
                    </tr>
                    <tr>
                        <td><b>E-Posta Adresi</b></td>
                        <td><?php echo $siparis->eposta; ?></td>
                    </tr>
                    <tr>
                        <td><b>Telefon</b></td>
                        <td><?php echo $siparis->telefon; ?></td>
                    </tr>
                    <tr>
                        <td><b>Adres</b></td>
                        <td><?php echo $siparis->adres; ?></td>
                    </tr>
                    <tr>
                        <td><b>Sipariş Tarihi</b></td>
                        <td><?php echo strftime("%d.%m.%Y %H:%M", strtotime($siparis->tarih)); ?></td>
                    </tr>
                    <tr>
                        <td><b>Sipariş Durumu</b></td>
                        <td>
                            <?php if($siparis->durum == "0"): ?>
                                <span class="label label-default">Onay Bekliyor</span>
                            <?php elseif($siparis->durum == "1"): ?>
                                <span class="label label-success">Tamamlandı</span>
                            <?php elseif($siparis->durum == "2"): ?>
                                <span class="label label-warning">Kargo Gönderildi</span>
                            <?php else: ?>
                                <span class="label label-danger">İptal Edildi</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->