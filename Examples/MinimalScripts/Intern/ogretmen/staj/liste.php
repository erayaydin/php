<?php $stajlar = $db->query("SELECT * FROM stajlar ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ); ?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include "ogretmen/yan.php" ?>
        </div>
        <div class="col-md-10">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Stajyer Listesi</h3>
                    </div>
                    <div class="panel-body" style="padding: 0;">
                        <?php if(count($stajlar) > 0): ?>
                        <table class="table table-striped table-bordered table-hover" style="margin: 0;">
                            <thead>
                            <tr>
                                <th>Öğrenci No</th>
                                <th>Ad Soyad</th>
                                <th>Firma</th>
                                <th>İl</th>
                                <th>Staj Türü</th>
                                <th>Başlangıç</th>
                                <th>Bitiş</th>
                                <th>Kabul</th>
                                <th>Durum</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($stajlar as $staj): ?>
                                    <?php
                                    $ogrenci = $db->query("SELECT * FROM ogrenciler WHERE id = '".$staj->ogrenci_id."'")->fetch(PDO::FETCH_OBJ);
                                    $kul = $db->query("SELECT * FROM kullanicilar WHERE id = '".$ogrenci->kullanici_id."'")->fetch(PDO::FETCH_OBJ);
                                    ?>
                                <tr>
                                    <td><?php echo $kul->numara; ?></td>
                                    <td><?php echo $ogrenci->ad." ".$ogrenci->soyad; ?></td>
                                    <td><?php echo $staj->firma; ?></td>
                                    <td><?php echo $staj->il; ?></td>
                                    <td>
                                        <?php
                                        $turler = ["oryantasyon" => "Oryantasyon Stajı", "staj1" => "Staj 1", "staj2" => "Staj 2", "isyeri" => "İş Yeri Eğitimi"];
                                        echo $turler[$staj->tur];
                                        ?>
                                    </td>
                                    <td><?php echo date("d.m.Y", strtotime($staj->baslangic)); ?></td>
                                    <td><?php echo date("d.m.Y", strtotime($staj->bitis)); ?></td>
                                    <td><?php echo $staj->kabul."/".$staj->gun; ?></td>
                                    <td>
                                        <?php if($staj->durum == 0): ?>
                                            <span class="label label-danger">Onaysız</span>
                                        <?php else: ?>
                                            <span class="label label-success">Onaylı</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="index.php?modul=staj&dosya=goruntule&staj=<?php echo $staj->id; ?>" class="btn btn-primary btn-xs">Görüntüle</a>
                                        <a href="index.php?modul=staj&dosya=duzenle&staj=<?php echo $staj->id; ?>" class="btn btn-warning btn-xs">Düzenle</a>
                                        <a href="index.php?modul=staj&dosya=sil&staj=<?php echo $staj->id; ?>" class="btn btn-danger btn-xs">Sil</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <div class="alert alert-danger" style="margin: 0;">
                            <p>Henüz staj oluşturulmadı.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
        </div>
    </div>
</div>