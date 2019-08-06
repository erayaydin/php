<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="text-right">
                    <a href="index.php?modul=mesaj&sayfa=gonder" class="btn btn-primary">Mesaj Gönder <i class="fa fa-send"></i></a>
                </div>
                <h3 class="m-top">Gelen Mesajlarım</h3>

                <?php
                $query = "SELECT * FROM mesajlar WHERE alan_id = '".$giris->id."' ORDER BY tarih DESC";
                $mesajlar = $db->query($query)->fetchAll(PDO::FETCH_OBJ);

                if(count($mesajlar) > 0):
                ?>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Gönderen</th>
                        <th width="20%">Tarih</th>
                        <th width="22%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($mesajlar as $mesaj): ?>
                        <?php $gonderenKul = $db->query("SELECT * FROM kullanicilar WHERE id = ".$mesaj->gonderen_id)->fetch(PDO::FETCH_OBJ); ?>
                        <tr>
                            <td>
                                <?php echo $gonderenKul->kullaniciadi; ?> (<?php echo $gonderenKul->adsoyad; ?>)
                            </td>
                            <td>
                                <?php echo date("d.m.Y H:i", strtotime($mesaj->tarih)); ?>
                            </td>
                            <td>
                                <a href="index.php?modul=mesaj&sayfa=detay&mesaj_id=<?php echo $mesaj->id; ?>" class="btn btn-primary btn-xs">Detaylar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="alert alert-danger">
                    <p>Henüz gelen bir mesaj yok.</p>
                </div>
                <?php endif; ?>

                <h3 class="m-top">Gönderdiğim Mesajlar</h3>

                <?php
                $query = "SELECT * FROM mesajlar WHERE gonderen_id = '".$giris->id."' ORDER BY tarih DESC";
                $mesajlar = $db->query($query)->fetchAll(PDO::FETCH_OBJ);

                if(count($mesajlar) > 0):
                    ?>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Alıcı</th>
                            <th width="20%">Tarih</th>
                            <th width="22%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($mesajlar as $mesaj): ?>
                            <?php $aliciKul = $db->query("SELECT * FROM kullanicilar WHERE id = ".$mesaj->alan_id)->fetch(PDO::FETCH_OBJ); ?>
                            <tr>
                                <td>
                                    <?php echo $aliciKul->kullaniciadi; ?> (<?php echo $aliciKul->adsoyad; ?>)
                                </td>
                                <td>
                                    <?php echo date("d.m.Y H:i", strtotime($mesaj->tarih)); ?>
                                </td>
                                <td>
                                    <a href="index.php?modul=mesaj&sayfa=detay&mesaj_id=<?php echo $mesaj->id; ?>" class="btn btn-primary btn-xs">Detaylar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert alert-danger">
                        <p>Henüz gelen bir mesaj yok.</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <?php include "moduller/parca/yan.php"; ?>
            </div>
        </div>
    </div>
</section>