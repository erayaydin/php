<section class="home">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Yönetim Paneli &middot; Kullanıcılar</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Kullanıcı Adı</th>
                        <th>Üye Türü</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($db->query("SELECT * FROM kullanicilar ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ) as $uye): ?>
                        <tr>
                            <td><?php echo $uye->kullaniciadi; ?></td>
                            <td>
                                <?php if($uye->admin): ?>
                                    <span class="label label-danger">Yönetici</span>
                                <?php else: ?>
                                    <span class="label label-primary">Üye</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="index.php?modul=yonetim&sayfa=kullanici_sil&kullanici=<?php echo $uye->id; ?>" class="btn btn-sm btn-danger">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>