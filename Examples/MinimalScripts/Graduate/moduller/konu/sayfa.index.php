<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3 class="m-top">Konular <?php if(isset($_GET["q"])): ?>('<?php echo $_GET['q']; ?>' başlığında)<?php endif; ?></h3>

                <?php if(isset($_GET["filtre"]) && $_GET["filtre"] == "meslek"): ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Mesleğe Göre Filtrele</h3>
                    </div>
                    <div class="panel-body">
                        <form method="get" action="index.php">
                            <input type="hidden" name="modul" value="konu">
                            <input type="hidden" name="sayfa" value="index">
                            <input type="hidden" name="filtre" value="meslek">
                            <div class="form-group">
                                <div class="input-group">
                                    <select name="meslek_id" id="meslek_id" class="form-control">
                                        <option value="0">Seçiniz</option>
                                        <?php foreach($db->query("SELECT * FROM meslekler ORDER BY isim ASC")->fetchAll(PDO::FETCH_OBJ) as $meslek): ?>
                                            <option value="<?php echo $meslek->id; ?>" <?php if(isset($_GET["meslek_id"]) && $_GET["meslek_id"] == $meslek->id): ?> selected <?php endif; ?>><?php echo $meslek->isim; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary" type="button">Filtrele <i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(isset($_GET["filtre"]) && $_GET["filtre"] == "yerlesim"): ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Yerleşime Göre Filtrele</h3>
                        </div>
                        <div class="panel-body">
                            <form method="get" action="index.php">
                                <input type="hidden" name="modul" value="konu">
                                <input type="hidden" name="sayfa" value="index">
                                <input type="hidden" name="filtre" value="yerlesim">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select name="yer_id" id="yer_id" class="form-control">
                                            <option value="0">Seçiniz</option>
                                            <?php foreach($db->query("SELECT * FROM yerler ORDER BY isim ASC")->fetchAll(PDO::FETCH_OBJ) as $yer): ?>
                                                <option value="<?php echo $yer->id; ?>" <?php if(isset($_GET["yer_id"]) && $_GET["yer_id"] == $yer->id): ?> selected <?php endif; ?>><?php echo $yer->isim; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary" type="button">Filtrele <i class="fa fa-search"></i></button>
                                    </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                $query = "SELECT * FROM konular WHERE durum = 1 ";

                if(isset($_GET["meslek_id"]) && !empty($_GET["meslek_id"]) && $_GET["meslek_id"] != "0")
                    $query .= "AND meslek_id = ".$_GET["meslek_id"];

                if(isset($_GET["yer_id"]) && !empty($_GET["yer_id"]) && $_GET["yer_id"] != "0")
                    $query .= "AND yer_id = ".$_GET["yer_id"];

                if(isset($_GET["q"]) && !empty($_GET["q"])){
                    $query .= "AND baslik LIKE '%".$_GET['q']."%'";
                }

                $query .= " ORDER BY tarih DESC";
                $konular = $db->query($query)->fetchAll(PDO::FETCH_OBJ);

                if(count($konular) > 0):
                ?>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Konu Başlığı</th>
                        <th width="25%">Yazan</th>
                        <th width="20%">Tarih</th>
                        <th width="22%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($konular as $konu): ?>
                        <?php $kKul = $db->query("SELECT * FROM kullanicilar WHERE id = ".$konu->kullanici_id)->fetch(PDO::FETCH_OBJ); ?>
                        <?php $yorumSay = $db->query("SELECT * FROM yorumlar WHERE konu_id = ".$konu->id)->rowCount(); ?>
                        <tr>
                            <td>
                                <?php echo $konu->baslik; ?>
                            </td>
                            <td>
                                <?php echo $kKul->adsoyad; ?>
                            </td>
                            <td>
                                <?php echo date("d.m.Y H:i", strtotime($konu->tarih)); ?>
                            </td>
                            <td>
                                <a href="index.php?modul=konu&sayfa=detay&konu_id=<?php echo $konu->id; ?>" class="btn btn-primary btn-xs">Detaylar</a>
                                <a href="index.php?modul=konu&sayfa=detay&konu_id=<?php echo $konu->id; ?>#yorumlar" class="btn btn-info btn-xs">Yorumlar (<?php echo $yorumSay; ?>)</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="alert alert-danger">
                    <p>Henüz konu açılmadı.</p>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <?php include "moduller/parca/yan.php"; ?>
            </div>
        </div>
    </div>
</section>