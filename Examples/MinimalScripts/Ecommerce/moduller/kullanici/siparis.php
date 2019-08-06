<?php
if(!isset($_GET['siparis_id']))
    die("Sipariş ID bulunamadı!");
$siparis = $db->query("SELECT * FROM siparisler WHERE id = ".$_GET["siparis_id"])->fetch(PDO::FETCH_OBJ);
if(!$siparis)
    die("Sipariş bulunamadı!");

if($siparis->kullanici_id != $giris->id) // Eğer gösterilmek istenen sipariş giriş yapan kullanıcıya ait değilse...
    die("Bu siparişi görüntüleme yetkiniz yok!");
?>
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
                        <th width="20%">Toplam</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $genelToplam = 0; ?>
                    <?php foreach($db->query("SELECT * FROM siparis_urunler WHERE siparis_id = ".$siparis->id)->fetchAll(PDO::FETCH_OBJ) as $sepet): ?>
                        <?php $urun = $db->query("SELECT * FROM urunler WHERE id = ".$sepet->urun_id)->fetch(PDO::FETCH_OBJ); ?>
                        <tr>
                            <td><img src="upload/urun/<?php echo $urun->id; ?>.png" width="60" /></td>
                            <td><?php echo $urun->baslik; ?></td>
                            <td><?php echo number_format($urun->fiyat, 2); ?> <i class="fa fa-try"></i></td>
                            <td><?php echo $sepet->adet; ?></td>
                            <td><?php echo number_format($urun->fiyat*$sepet->adet, 2); ?> <i class="fa fa-try"></i></td>
                            <?php $genelToplam += $urun->fiyat*$sepet->adet; ?>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4">Genel Toplam</td>
                        <td><?php echo number_format($genelToplam, 2); ?> <i class="fa fa-try"></i></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Sipariş Bilgileri</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                                <tbody>
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
    </div>
</section>