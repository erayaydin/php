<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include "ogretmen/yan.php" ?>
        </div>
        <div class="col-md-10">
            <form method="post">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Öğrenci Ekle</h3>
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
                                "password" => "Parola",
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
                                $kulEkle = $db->prepare("INSERT INTO kullanicilar(numara, sifre, tur) VALUES(:numara, :sifre, 'ogrenci')");
                                $kulEkle->execute([
                                    "numara" => $number,
                                    "sifre"  => md5($password)
                                ]);

                                $ogrEkle = $db->prepare("INSERT INTO ogrenciler(kullanici_id, ad, soyad, tckimlik, universite, fakulte, bolum, telefon) VALUES(:kullanici, :ad, :soyad, :tckimlik, :universite, :fakulte, :bolum, :telefon)");
                                $ogrEkle->execute([
                                    "kullanici" => $db->lastInsertId(),
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
                                        <input type="text" class="form-control" name="number" value="<?php echo post('number'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Parola</span>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">T.C. Kimlik</span>
                                        <input type="text" class="form-control" name="identity" value="<?php echo post('identity'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">İsim</span>
                                        <input type="text" class="form-control" name="name" value="<?php echo post('name'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Soyisim</span>
                                        <input type="text" class="form-control" name="surname" value="<?php echo post('surname'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Telefon</span>
                                        <input type="text" class="form-control" name="phone" value="<?php echo post('phone'); ?>">
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
                                                <option <?php if(post("university") == $uni->adi): ?> selected <?php endif; ?> value="<?php echo $uni->adi; ?>"><?php echo $uni->adi; ?></option>
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
                                                <option <?php if(post("faculty") == $fak->adi): ?> selected <?php endif; ?> value="<?php echo $fak->adi; ?>"><?php echo $fak->adi; ?></option>
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
                                                <option <?php if(post("department") == $bol->adi): ?> selected <?php endif; ?> value="<?php echo $bol->adi; ?>"><?php echo $bol->adi; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <button type="submit" name="go" class="btn btn-success">Ekle <i class="fa fa-plus-circle"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>