<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include "ogretmen/yan.php" ?>
        </div>
        <div class="col-md-10">
            <form method="post">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Staj Ekle</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        if($_POST){
                            $ogrenciId = $_POST['ogrenci_id'];
                            $tur = $_POST['tur'];
                            $durum = $_POST['durum'];
                            $baslangic = $_POST['baslangic'];
                            $bitis = $_POST['bitis'];
                            $gun = $_POST['gun'];
                            $kabul = $_POST['kabul'];
                            $il = $_POST['il'];
                            $firma = $_POST['firma'];

                            $arr = [
                                "ogrenci_id" => "Öğrenci",
                                "tur" => "Staj Türü",
                                "durum" => "Staj Durumu",
                                "baslangic" => "Başlangıç tarihi",
                                "bitis" => "Bitiş tarihi",
                                "gun" => "Gün sayısı",
                                "kabul" => "Kabul gün",
                                "il" => "İl",
                                "firma" => "Firma"
                            ];

                            $hatalar = [];
                            foreach($arr as $key => $value) {
                                if(!isset($_POST[$key]) || $_POST[$key] == "" || $_POST[$key] == "Seçiniz"){
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

                                $exp = explode(".", $baslangic);
                                $baslangic = $exp[2]."-".$exp[1]."-".$exp[0];
                                $exp = explode(".", $bitis);
                                $bitis = $exp[2]."-".$exp[1]."-".$exp[0];

                                $stajEkle = $db->prepare("INSERT INTO stajlar(ogrenci_id,tur,gun,baslangic,bitis,kabul,durum,il,firma) VALUES(:ogrenci,:tur,:gun,:baslangic,:bitis,:kabul,:durum,:il,:firma)");
                                $stajEkle->execute([
                                    "ogrenci" => $ogrenciId,
                                    "tur" => $tur,
                                    "gun" => $gun,
                                    "baslangic" => $baslangic,
                                    "bitis" => $bitis,
                                    "kabul" => $kabul,
                                    "durum" => $durum == "onaysiz" ? false : true,
                                    "il" => $il,
                                    "firma" => $firma
                                ]);

                                yonlendir("index.php?modul=staj&dosya=liste");
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Öğrenci</span>
                                        <select name="ogrenci_id" class="form-control">
                                            <option value="Seçiniz">Seçiniz</option>
                                            <?php foreach($db->query("SELECT * FROM ogrenciler ORDER BY ad,soyad ASC")->fetchAll(PDO::FETCH_OBJ) as $ogrenci): ?>
                                                <option <?php if(post('ogrenci_id') == $ogrenci->id): ?> selected <?php endif; ?> value="<?php echo $ogrenci->id; ?>"><?php echo $ogrenci->ad." ".$ogrenci->soyad." (".$ogrenci->tckimlik.")"; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Staj Türü</span>
                                        <select name="tur" class="form-control">
                                            <option value="Seçiniz">Seçiniz</option>
                                            <?php $turler = ["oryantasyon" => "Oryantasyon Stajı", "staj1" => "Staj 1", "staj2" => "Staj 2", "isyeri" => "İş Yeri Eğitimi"]; foreach($turler as $turKey => $turVal): ?>
                                            <option <?php if(post('tur') == $turKey): ?> selected <?php endif; ?> value="<?php echo $turKey ?>"><?php echo $turVal; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Staj Durumu</span>
                                        <select name="durum" class="form-control">
                                            <option value="Seçiniz">Seçiniz</option>
                                            <option <?php if(post('durum') == "onaysiz"): ?> selected <?php endif; ?> value="onaysiz">Onaylanmadı</option>
                                            <option <?php if(post('durum') == "onayli"): ?> selected <?php endif; ?> value="onayli">Onaylandı</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Başlangıç</span>
                                        <input type="text" class="form-control datepicker" placeholder="gün.ay.yıl" value="<?php echo post('baslangic'); ?>" name="baslangic">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Bitiş</span>
                                        <input type="text" class="form-control datepicker" placeholder="gün.ay.yıl" value="<?php echo post('bitis'); ?>" name="bitis">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Gün Sayısı</span>
                                        <input type="text" class="form-control" value="<?php echo post('gun'); ?>" name="gun">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Kabul Gün</span>
                                        <input type="text" class="form-control" value="<?php echo post('kabul'); ?>" name="kabul">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">İl</span>
                                        <select name="il" class="form-control">
                                            <option value="Seçiniz">Seçiniz</option>
                                            <?php foreach($db->query("SELECT * FROM iller ORDER BY isim ASC")->fetchAll(PDO::FETCH_OBJ) as $il): ?>
                                                <option <?php if(post('il') == $il->isim): ?> selected <?php endif; ?> value="<?php echo $il->isim; ?>"><?php echo $il->isim; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Firma İsmi</span>
                                        <input type="text" value="<?php echo post('firma'); ?>" class="form-control" name="firma">
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