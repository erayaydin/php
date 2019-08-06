<?php
if(isset($_GET["konu_id"])) {
    $konuId = $_GET["konu_id"];
    $konu = $db->query("SELECT * FROM konular WHERE id = " . $konuId)->fetch(PDO::FETCH_OBJ);
    if (!$konu)
        hata("KONU", "Konu bulunamadı!");
} else {
    hata("KONU", "KonuID Belirtilmedi!");
}

if(isset($_POST["islem"])){
    $baslik = $_POST["baslik"];
    $mesaj = $_POST["mesaj"];

    $query = $db->prepare("UPDATE konular SET baslik = :baslik, mesaj = :mesaj WHERE id = ".$konu->id);
    $query->execute([
        "baslik" => $baslik,
        "mesaj" => $mesaj,
    ]);

    yonlendir("index.php?modul=yonetim/konu&sayfa=index");
}
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-top">Konu Düzenle</h3>
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="baslik">Başlık</label>
                                <input type="text" class="form-control" id="baslik" name="baslik" placeholder="Başlık" value="<?php echo $konu->baslik; ?>">
                            </div> <!-- /.form-group -->
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mesaj">İçerik</label>
                                <textarea name="mesaj" class="form-control" id="mesaj" placeholder="Mesaj" rows="10"><?php echo $konu->mesaj; ?></textarea>
                            </div> <!-- /.form-group -->
                        </div>
                    </div>
                    <p class="text-right">
                        <button type="submit" name="islem" value="guncelle" class="btn btn-primary">Güncelle <i class="fa fa-cloud-upload"></i></button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>