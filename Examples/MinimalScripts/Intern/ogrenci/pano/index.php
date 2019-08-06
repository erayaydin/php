<?php
$ogrenci = $db->query("SELECT * FROM ogrenciler WHERE kullanici_id = '".$giris->id."'")->fetch(PDO::FETCH_OBJ);
$staj = $db->query("SELECT * FROM stajlar WHERE ogrenci_id = '".$ogrenci->id."'")->fetch(PDO::FETCH_OBJ);
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Öğrenci Bilgileri</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="assets/img/foto.png" class="img-responsive img-circle" style="max-height: 100px;" />
                        </div>
                        <div class="col-md-8">
                            <h3 style="margin: 0;"><?php echo $ogrenci->ad." ".$ogrenci->soyad; ?></h3>
                            <p>
                                <?php echo $ogrenci->universite; ?><br>
                                <?php echo $ogrenci->fakulte; ?><br>
                                <?php echo $ogrenci->bolum; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <p>
                <a href="index.php?sistem=ogrenci&modul=kullanici&dosya=cikis" class="btn btn-danger btn-block">Çıkış Yap</a>
            </p>
        </div>
        <div class="col-md-8">
            <?php if($staj): ?>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Staj Durumu</h3>
                </div>
                <div class="panel-body" style="padding: 0;">
                    <table class="table table-bordered table-striped table-hover" style="margin: 0;">
                        <tbody>
                        <tr>
                            <th>Firma</th>
                            <td><?php echo $staj->firma; ?></td>
                        </tr>
                        <tr>
                            <th>Başlangıç Tarihi</th>
                            <td><?php echo duzgunTarih($staj->baslangic); ?></td>
                        </tr>
                        <tr>
                            <th>Bitiş Tarihi</th>
                            <td><?php echo duzgunTarih($staj->bitis); ?></td>
                        </tr>
                        <tr>
                            <th>Staj Süresi</th>
                            <td><?php echo $staj->gun; ?> iş günü</td>
                        </tr>
                        <tr>
                            <th>Kabul Edilen Staj Süresi</th>
                            <td><?php echo $staj->kabul; ?> iş günü</td>
                        </tr>
                        <tr>
                            <th>Staj Durumu</th>
                            <td>
                                <?php if($staj->durum): ?>
                                    <span class="label label-success">Onaylı</span>
                                <?php else: ?>
                                    <span class="label label-danger">Onaysız</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php else: ?>
            <div class="alert alert-danger">
                <p>Henüz staj eklenmedi.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>