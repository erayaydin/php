<?php
$kul = $db->query("SELECT * FROM kullanicilar WHERE id = '".$_GET['ogrenci']."'")->fetch(PDO::FETCH_OBJ);
$ogr = $db->query("SELECT * FROM ogrenciler WHERE kullanici_id = '".$kul->id."'")->fetch(PDO::FETCH_OBJ);
?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include "ogretmen/yan.php" ?>
        </div>
        <div class="col-md-10">
            <form method="post">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Öğrenci Düzenle</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        if($_POST){
                            $number = $_POST['number'];
                            $password = $_POST['password'];
                            $identity = $_POST['identity'];
                            $name = $_POST['name'];
                            $surname = $_POST['surname'];
                            $phone = $_POST['phone'];
                            $uni = $_POST['university'];
                            $faculty = $_POST['faculty'];
                            $department = $_POST['department'];

                            $arr = [
                                "number" => "Öğrenci No",
                                "identity" => "T.C. Kimlik No",
                                "name" => "Ad",
                                "surname" => "Soyad",
                                "phone" => "Telefon",
                                "university" => "Üniversite",
                                "faculty" => "Fakülte",
                                "department" => "Bölüm"
                            ];

                            $hatalar = [];
                            foreach($arr as $key => $value) {
                                if(!isset($_POST[$key]) || empty($_POST[$key]) || $_POST[$key] == "Seçiniz"){
                                    $hatalar[] = "Lütfen ".$value." alanını boş bırakmayınız.";
                                }
                            }

                            if(count($hatalar) > 0){
                                ?>
                                <div class="alert alert-danger">
                                    <?php foreach($hatalar as $hata): ?>
                                        <p><?php echo $hata; ?></p>
                                    <?php endforeach; ?>
                                </div>
                                <?php
                            } else {
                                $kulDuzenle = $db->prepare("UPDATE kullanicilar SET numara = :numara, sifre = :sifre");
                                $kulDuzenle->execute([
                                    "numara" => $number,
                                    "sifre"  => $password ? md5($password) : $kul->sifre
                                ]);

                                $ogrDuzenle = $db->prepare("UPDATE ogrenciler SET ad = :ad, soyad = :soyad, tckimlik = :tckimlik, universite = :universite, fakulte = :fakulte, bolum = :bolum, telefon = :telefon");
                                $ogrDuzenle->execute([
                                    "ad" => $name,
                                    "soyad" => $surname,
                                    "tckimlik" => $identity,
                                    "universite" => $uni,
                                    "fakulte" => $faculty,
                                    "bolum" => $department,
                                    "telefon" => $phone
                                ]);

                                yonlendir("index.php?modul=ogrenci&dosya=liste");
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Öğrenci No</span>
                                        <input type="text" class="form-control" name="number" value="<?php echo post('number') ? post('number') : $kul->numara; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Parola</span>
                                        <input type="password" class="form-control" name="password" placeholder="Değiştirmek İstemiyorsanız Boş Bırakın">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">T.C. Kimlik</span>
                                        <input type="text" class="form-control" name="identity" value="<?php echo post('identity') ? post('identity') : $ogr->tckimlik; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">İsim</span>
                                        <input type="text" class="form-control" name="name" value="<?php echo post('name') ? post('name') : $ogr->ad; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Soyisim</span>
                                        <input type="text" class="form-control" name="surname" value="<?php echo post('surname') ? post('surname') : $ogr->soyad; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Telefon</span>
                                        <input type="text" class="form-control" name="phone" value="<?php echo post('phone') ? post('phone') : $ogr->telefon; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Üniversite</span>
                                        <select name="university" class="form-control">
                                            <option>Seçiniz</option>
                                            <?php foreach($db->query("SELECT * FROM universiteler ORDER BY adi ASC")->fetchAll(PDO::FETCH_OBJ) as $uni): ?>
                                                <option <?php if(post("university") == $uni->adi || (!post('university') && $ogr->universite == $uni->adi)): ?> selected <?php endif; ?> value="<?php echo $uni->adi; ?>"><?php echo $uni->adi; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Fakülte</span>
                                        <select name="faculty" class="form-control">
                                            <option>Seçiniz</option>
                                            <?php foreach($db->query("SELECT * FROM fakulteler ORDER BY adi ASC")->fetchAll(PDO::FETCH_OBJ) as $fak): ?>
                                                <option <?php if(post("faculty") == $fak->adi || (!post('faculty') && $ogr->fakulte == $fak->adi)): ?> selected <?php endif; ?> value="<?php echo $fak->adi; ?>"><?php echo $fak->adi; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Bölüm</span>
                                        <select name="department" class="form-control">
                                            <option>Seçiniz</option>
                                            <?php foreach($db->query("SELECT * FROM bolumler ORDER BY adi ASC")->fetchAll(PDO::FETCH_OBJ) as $bol): ?>
                                                <option <?php if(post("department") == $bol->adi || (!post('department') && $ogr->bolum == $bol->adi)): ?> selected <?php endif; ?> value="<?php echo $bol->adi; ?>"><?php echo $bol->adi; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <button type="submit" name="go" class="btn btn-warning">Güncelle <i class="fa fa-cloud-upload"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>