<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include "ogretmen/yan.php" ?>
        </div>
        <div class="col-md-9">
            <form method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Öğrenci Arama</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="number"><i class="fa fa-graduation-cap"></i></span>
                                        <input type="text" name="number" class="form-control" value="<?php echo post('number'); ?>" placeholder="Öğrenci Numarası" aria-describedby="number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="identity"><i class="fa fa-user"></i></span>
                                        <input type="text" name="tckimlik" class="form-control" value="<?php echo post('tckimlik'); ?>" placeholder="T.C. Kimlik Numarası" aria-describedby="identity">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="name"><i class="fa fa-user-circle-o"></i></span>
                                        <input type="text" name="isim" class="form-control" value="<?php echo post('isim'); ?>" placeholder="İsim" aria-describedby="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="surname"><i class="fa fa-user-circle-o"></i></span>
                                        <input type="text" name="soyisim" class="form-control" value="<?php echo post('soyisim'); ?>" placeholder="Soyisim" aria-describedby="surname">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <button type="submit" name="go" class="btn btn-primary">Ara <i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>

            <?php if(isset($_POST['go'])): ?>
                <?php

                $number = $_POST['number'];
                $tckimlik = $_POST['tckimlik'];
                $isim = $_POST['isim'];
                $soyisim = $_POST['soyisim'];

                $ogrenciler = [];

                if($number) {
                    $ara = $db->prepare('SELECT * FROM kullanicilar WHERE numara = :numara AND tur = "ogrenci"');
                    $ara->execute([
                        "numara" => $number
                    ]);
                    foreach($ara->fetchAll(PDO::FETCH_OBJ) as $sonuc){
                        $ogr = $db->query("SELECT * FROM ogrenciler WHERE kullanici_id = '".$sonuc->id."'")->fetch(PDO::FETCH_OBJ);
                        $staj = $db->query("SELECT * FROM stajlar WHERE ogrenci_id = '".$ogr->id."'")->fetch(PDO::FETCH_OBJ);
                        $ogrenciler[] = [
                            "id" => $sonuc->id,
                            "numara" => $sonuc->numara,
                            "adsoyad" => $ogr->ad." ".$ogr->soyad,
                            "tc" => $ogr->tckimlik,
                            "stajid" => $staj ? $staj->id : null,
                            "staj" => $staj ? true : false,
                            "stajgun" => $staj ? $staj->gun : null,
                        ];
                    }
                } else if($tckimlik) {
                    $ara = $db->prepare('SELECT * FROM ogrenciler WHERE tckimlik = :kimlik');
                    $ara->execute([
                        "kimlik" => $tckimlik
                    ]);
                    foreach($ara->fetchAll(PDO::FETCH_OBJ) as $sonuc){
                        $kul = $db->query("SELECT * FROM kullanicilar WHERE id = '".$sonuc->kullanici_id."'")->fetch(PDO::FETCH_OBJ);
                        $staj = $db->query("SELECT * FROM stajlar WHERE ogrenci_id = '".$sonuc->id."'")->fetch(PDO::FETCH_OBJ);
                        $ogrenciler[] = [
                            "id" => $kul->id,
                            "numara" => $kul->numara,
                            "adsoyad" => $sonuc->ad." ".$sonuc->soyad,
                            "tc" => $sonuc->tckimlik,
                            "stajid" => $staj ? $staj->id : null,
                            "staj" => $staj ? true : false,
                            "stajgun" => $staj ? $staj->gun : null,
                        ];
                    }
                } else if($isim || $soyisim) {
                    $ara = $db->prepare('SELECT * FROM ogrenciler WHERE ad LIKE :ad AND soyad LIKE :soyad');
                    $ara->execute([
                        "ad" => "%".$isim."%",
                        "soyad" => "%".$soyisim."%"
                    ]);
                    foreach($ara->fetchAll(PDO::FETCH_OBJ) as $sonuc){
                        $kul = $db->query("SELECT * FROM kullanicilar WHERE id = '".$sonuc->kullanici_id."'")->fetch(PDO::FETCH_OBJ);
                        $staj = $db->query("SELECT * FROM stajlar WHERE ogrenci_id = '".$sonuc->id."'")->fetch(PDO::FETCH_OBJ);
                        $ogrenciler[] = [
                            "id" => $kul->id,
                            "numara" => $kul->numara,
                            "adsoyad" => $sonuc->ad." ".$sonuc->soyad,
                            "tc" => $sonuc->tckimlik,
                            "stajid" => $staj ? $staj->id : null,
                            "staj" => $staj ? true : false,
                            "stajgun" => $staj ? $staj->gun : null,
                        ];
                    }
                }
                ?>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Arama Sonucu</h3>
                </div>
                <div class="panel-body" style="padding: 0;">
                    <?php if(count($ogrenciler) > 0): ?>
                    <table class="table table-striped table-bordered table-hover" style="margin: 0;">
                        <thead>
                        <tr>
                            <th>Öğrenci Numarası</th>
                            <th>Ad Soyad</th>
                            <th>T.C. Kimlik Numarası</th>
                            <th>Staj Durumu</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($ogrenciler as $ogrenci): ?>
                            <tr>
                                <td><?php echo $ogrenci['numara']; ?></td>
                                <td><?php echo $ogrenci['adsoyad']; ?></td>
                                <td><?php echo $ogrenci['tc']; ?></td>
                                <td>
                                    <?php if($ogrenci['staj']): ?>
                                        <span class="label label-success">Stajda (<?php echo $ogrenci['stajgun']; ?>)</span>
                                    <?php else: ?>
                                        <span class="label label-danger">Staj Eklenmedi</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($ogrenci['staj']): ?>
                                    <a href="index.php?modul=staj&dosya=goruntule&staj=<?php echo $ogrenci['stajid']; ?>" class="btn btn-primary btn-xs">Staj Görüntüle</a>
                                    <?php endif; ?>
                                    <a href="index.php?modul=ogrenci&dosya=duzenle&ogrenci=<?php echo $ogrenci['id']; ?>" class="btn btn-warning btn-xs">Düzenle</a>
                                    <a href="index.php?modul=ogrenci&dosya=sil&ogrenci=<?php echo $ogrenci['id']; ?>" class="btn btn-danger btn-xs">Sil</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <div class="alert alert-danger" style="margin: 0;">
                            <p>Sonuç bulunamadı.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>