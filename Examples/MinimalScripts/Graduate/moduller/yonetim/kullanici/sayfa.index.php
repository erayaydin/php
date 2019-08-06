<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-top">
                    Kullanıcılar
                </h3>
                <?php
                $query = "SELECT * FROM kullanicilar ORDER BY id DESC";
                $kullanicilar = $db->query($query)->fetchAll(PDO::FETCH_OBJ);

                if(count($kullanicilar) > 0):
                ?>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Kullanıcı Adı</th>
                        <th>E-Posta</th>
                        <th>Ad Soyad</th>
                        <th>Yetki Düzeyi</th>
                        <th>Durum</th>
                        <th width="22%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($kullanicilar as $kullanici): ?>
                        <tr>
                            <td><?php echo $kullanici->kullaniciadi; ?></td>
                            <td><?php echo $kullanici->eposta; ?></td>
                            <td><?php echo $kullanici->adsoyad; ?></td>
                            <td>
                                <?php if($kullanici->admin == 1): ?>
                                    <span class="label label-success">Yönetici</span>
                                <?php else: ?>
                                    <span class="label label-default">Kullanıcı</span>
                                <?php endif; ?>
                            </td>
                            <td><?php if($kullanici->durum == 1): ?>
                                    <span class="label label-success">Aktif</span>
                                <?php else: ?>
                                    <span class="label label-danger">Pasif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($kullanici->durum == 0): ?>
                                    <a href="index.php?modul=yonetim/kullanici&sayfa=aktif&kullanici_id=<?php echo $kullanici->id; ?>" class="btn btn-success btn-xs">Aktif Yap</a>
                                <?php else: ?>
                                    <a href="index.php?modul=yonetim/kullanici&sayfa=pasif&kullanici_id=<?php echo $kullanici->id; ?>" class="btn btn-info btn-xs">Pasif Yap</a>
                                <?php endif; ?>
                                <a href="index.php?modul=yonetim/kullanici&sayfa=duzenle&kullanici_id=<?php echo $kullanici->id; ?>" class="btn btn-warning btn-xs">Düzenle</a>
                                <a href="index.php?modul=yonetim/kullanici&sayfa=sil&kullanici_id=<?php echo $kullanici->id; ?>" class="btn btn-danger btn-xs">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="alert alert-danger">
                    <p>Henüz eklenen bir kullanıcı yok.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>