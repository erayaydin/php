<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include "ogretmen/yan.php" ?>
        </div>
        <div class="col-md-10">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Öğrenci Listesi</h3>
                    </div>
                    <div class="panel-body" style="padding: 0;">
                        <table class="table table-striped table-bordered table-hover" style="margin: 0;">
                            <thead>
                            <tr>
                                <th>Öğrenci No</th>
                                <th>Ad Soyad</th>
                                <th>T.C. Kimlik Numarası</th>
                                <th>Üniversite</th>
                                <th>Fakülte</th>
                                <th>Bölüm</th>
                                <th>Telefon</th>
                                <th>Staj</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($db->query("SELECT * FROM ogrenciler ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ) as $ogrenci): ?>
                                    <?php
                                    $kul = $db->query("SELECT * FROM kullanicilar WHERE id = '".$ogrenci->kullanici_id."'")->fetch(PDO::FETCH_OBJ);
                                    $staj = $db->query("SELECT * FROM stajlar WHERE ogrenci_id = '".$ogrenci->id."'")->fetch(PDO::FETCH_OBJ);
                                    ?>
                                <tr>
                                    <td><?php echo $kul->numara; ?></td>
                                    <td><?php echo $ogrenci->ad." ".$ogrenci->soyad; ?></td>
                                    <td><?php echo $ogrenci->tckimlik; ?></td>
                                    <td><?php echo $ogrenci->universite; ?></td>
                                    <td><?php echo $ogrenci->fakulte; ?></td>
                                    <td><?php echo $ogrenci->bolum; ?></td>
                                    <td><?php echo $ogrenci->telefon; ?></td>
                                    <td>
                                        <?php if($staj): ?>
                                            <span class="label label-success">Stajda (<?php echo $staj->gun; ?>)</span>
                                        <?php else: ?>
                                            <span class="label label-danger">Staj Eklenmedi</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($staj): ?>
                                            <a href="index.php?modul=staj&dosya=goruntule&staj=<?php echo $staj->id; ?>" class="btn btn-primary btn-xs">Staj Görüntüle</a>
                                        <?php endif; ?>
                                        <a href="index.php?modul=ogrenci&dosya=duzenle&ogrenci=<?php echo $kul->id; ?>" class="btn btn-warning btn-xs">Düzenle</a>
                                        <a href="index.php?modul=ogrenci&dosya=sil&ogrenci=<?php echo $kul->id; ?>" class="btn btn-danger btn-xs">Sil</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>