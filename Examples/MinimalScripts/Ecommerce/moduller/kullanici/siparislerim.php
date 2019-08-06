<?php
$siparisler = $db->query("SELECT * FROM siparisler WHERE kullanici_id = '".$giris->id."'")->fetchAll(PDO::FETCH_OBJ);
?>
<section class="giris">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Siparişlerim</h3>
                    </div>
                    <div class="panel-body">
                        <?php if($siparisler && count($siparisler) > 0): // Eğer sipariş varsa... ?>
                        <table class="table table-bordered table-striped table-hovered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Sipariş Tarihi</th>
                                <th>Sipariş Tutarı</th>
                                <th>Durum</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($siparisler as $siparis): ?>
                                <?php
                                $toplamTutar = 0; // Toplam tutar ilk başta 0

                                // Sepetteki tüm ürünleri ele alalım...
                                foreach($db->query("SELECT * FROM siparis_urunler WHERE siparis_id = ".$siparis->id)->fetchAll(PDO::FETCH_OBJ) as $sepettekiUrun){
                                    $urun = $db->query("SELECT * FROM urunler WHERE id = ".$sepettekiUrun->urun_id)->fetch(PDO::FETCH_OBJ); // siparis_urunler tablosundan urun_id'yi kullanarak ürünün bilgilerine ulaşalım.
                                    $toplamTutar += $urun->fiyat * $sepettekiUrun->adet; // Toplam tutarı ürünün fiyatı ve adeti kadar arttıralım.
                                }
                                ?>
                                <tr>
                                    <td><?php echo $siparis->id; ?></td>
                                    <td><?php echo strftime("%d.%m.%Y %H:%M", strtotime($siparis->tarih)); ?></td>
                                    <td><?php echo $toplamTutar; ?></td>
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
                                    <td><a href="index.php?modul=kullanici&sayfa=siparis&siparis_id=<?php echo $siparis->id; ?>" class="btn btn-xs btn-primary">Detaylar</a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: // Hiç siparişi yoksa... ?>
                        <div class="alert alert-danger">
                            <p>Henüz bir sipariş yapmadınız.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>