<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-top">
                    Mesajlar
                </h3>
                <?php
                $query = "SELECT * FROM mesajlar ORDER BY id DESC";
                $mesajlar = $db->query($query)->fetchAll(PDO::FETCH_OBJ);

                if(count($mesajlar) > 0):
                ?>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Gönderen</th>
                        <th>Alan</th>
                        <th>Mesaj İçeriği</th>
                        <th>Tarih</th>
                        <th width="22%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($mesajlar as $mesaj): ?>
                        <?php
                        $gonderen = $db->query("SELECT * FROM kullanicilar WHERE id = ".$mesaj->gonderen_id)->fetch(PDO::FETCH_OBJ);
                        $alan = $db->query("SELECT * FROM kullanicilar WHERE id = ".$mesaj->alan_id)->fetch(PDO::FETCH_OBJ);
                        ?>
                        <tr>
                            <td>
                                <?php if($gonderen): ?>
                                    <?php echo $gonderen->kullaniciadi; ?>
                                <?php else: ?>
                                    <span class="label label-danger">Kullanıcı Silinmiş</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($alan): ?>
                                    <?php echo $alan->kullaniciadi; ?>
                                <?php else: ?>
                                    <span class="label label-danger">Kullanıcı Silinmiş</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $mesaj->mesaj; ?></td>
                            <td><?php echo date("d.m.Y H:i", strtotime($mesaj->tarih)); ?></td>
                            <td>
                                <a href="index.php?modul=yonetim/mesaj&sayfa=sil&mesaj_id=<?php echo $mesaj->id; ?>" class="btn btn-danger btn-xs">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="alert alert-danger">
                    <p>Henüz gönderilen mesaj yok.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>