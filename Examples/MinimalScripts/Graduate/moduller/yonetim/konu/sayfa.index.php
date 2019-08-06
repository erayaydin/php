<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-top">
                    Konular
                </h3>
                <?php
                $query = "SELECT * FROM konular ORDER BY id DESC";
                $konular = $db->query($query)->fetchAll(PDO::FETCH_OBJ);

                if(count($konular) > 0):
                ?>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Kullanıcı</th>
                        <th>Başlık</th>
                        <th>Tarih</th>
                        <th>Durum</th>
                        <th width="22%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($konular as $konu): ?>
                        <?php $konuKul = $db->query("SELECT * FROM kullanicilar WHERE id = ".$konu->kullanici_id)->fetch(PDO::FETCH_OBJ); ?>
                        <tr>
                            <td><?php echo $konuKul->kullaniciadi; ?></td>
                            <td><?php echo $konu->baslik; ?></td>
                            <td><?php echo date("d.m.Y H:i", strtotime($konu->tarih)); ?></td>
                            <td><?php if($konu->durum == 1): ?>
                                    <span class="label label-success">Aktif</span>
                                <?php else: ?>
                                    <span class="label label-danger">Pasif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($konu->durum == 0): ?>
                                    <a href="index.php?modul=yonetim/konu&sayfa=aktif&konu_id=<?php echo $konu->id; ?>" class="btn btn-success btn-xs">Aktif Yap</a>
                                <?php else: ?>
                                    <a href="index.php?modul=yonetim/konu&sayfa=pasif&konu_id=<?php echo $konu->id; ?>" class="btn btn-info btn-xs">Pasif Yap</a>
                                <?php endif; ?>
                                <a href="index.php?modul=yonetim/konu&sayfa=duzenle&konu_id=<?php echo $konu->id; ?>" class="btn btn-warning btn-xs">Düzenle</a>
                                <a href="index.php?modul=yonetim/konu&sayfa=sil&konu_id=<?php echo $konu->id; ?>" class="btn btn-danger btn-xs">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="alert alert-danger">
                    <p>Henüz eklenen bir konu yok.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>