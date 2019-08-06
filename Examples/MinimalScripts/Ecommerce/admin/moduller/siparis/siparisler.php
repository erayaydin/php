<?php
if(isset($_GET["durum"])){ // Eğer durum filtresi varsa...

    // Durum filtresine göre bir başlık seç
    $header = [
        0 => "Onay Bekleyen Siparişler",
        1 => "Tamamlanmış Siparişler",
        2 => "Kargodaki Siparişler"
    ];
    $header = $header[$_GET["durum"]];

    $siparisler = $db->query("SELECT * FROM siparisler WHERE durum = '".$_GET['durum']."' ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ);
} else { // Eğer durum filtresi yoksa...
    $header = "Tüm Siparişler"; // başlık "Tüm Siparişler" olsun.
    $siparisler = $db->query("SELECT * FROM siparisler ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ);
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $header; ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <?php if(count($siparisler) > 0): ?>
        <table class="table table-hovered table-striped table-bordered">
            <thead>
            <tr>
                <th width="5%">#</th>
                <th>Kullanıcı</th>
                <th>Ad Soyad</th>
                <th>Telefon</th>
                <th>Sipariş Tarihi</th>
                <?php if(!isset($_GET['durum'])): // Durum sütununu filtre yoksa göster ?>
                <th width="10%">Durum</th>
                <?php endif; ?>
                <th width="20%">İşlem</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($siparisler as $siparis): ?>
            <tr>
                <td><?php echo $siparis->id; ?></td>
                <td>
                    <?php if($siparis->kullanici_id): // Eğer siparişi veren bir kullanıcı ise... (ziyaretçi değilse) ?>
                        <?php $sipKul = $db->query('SELECT * FROM kullanicilar WHERE id = '.$siparis->kullanici_id)->fetch(PDO::FETCH_OBJ); ?>
                        <span class="label label-primary"><?php echo $sipKul->kullaniciadi; ?></span>
                    <?php else: // Ziyaretçi ise... ?>
                        <span class="label label-default">Ziyaretçi</span>
                    <?php endif; ?>
                </td>
                <td><?php echo $siparis->adsoyad; ?></td>
                <td><?php echo $siparis->telefon; ?></td>
                <td><?php echo strftime("%d.%m.%Y %H:%M", strtotime($siparis->tarih)); ?></td>
                <?php if(!isset($_GET['durum'])): // Eğer durum filtresi yoksa göster ?>
                <td>
                    <?php if($siparis->durum == 0): ?>
                        <span class="label label-default">Onay Bekliyor</span>
                    <?php elseif($siparis->durum == 1): ?>
                        <span class="label label-success">Tamamlandı</span>
                    <?php elseif($siparis->durum == 2): ?>
                        <span class="label label-warning">Kargoda</span>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
                <td>
                    <a href="index.php?modul=siparis&sayfa=detay&siparis_id=<?php echo $siparis->id; ?>" class="btn btn-xs btn-primary">Detaylar</a>
                    <a href="index.php?modul=siparis&sayfa=sil&siparis_id=<?php echo $siparis->id; ?>" class="btn btn-xs btn-danger">Sil</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="alert alert-danger">
            Henüz yapılan bir sipariş bulunamadı!
        </div>
        <?php endif; ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->