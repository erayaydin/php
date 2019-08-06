<?php
if(isset($_GET["bolum_id"])) {
    $bolumId = $_GET["bolum_id"];
    $bolum = $db->query("SELECT * FROM bolumler WHERE id = " . $bolumId)->fetch(PDO::FETCH_OBJ);
    if (!$bolum)
        hata("BOLUM", "Bölüm bulunamadı!");
} else {
    hata("BOLUM", "BolumID Belirtilmedi!");
}

if(isset($_POST["isim"])){
    $isim = $_POST["isim"];
    $gonder = $db->prepare("UPDATE bolumler SET isim = :isim WHERE id = ".$bolum->id);
    $gonder->execute([
        "isim" => $isim,
    ]);

    yonlendir("index.php?modul=yonetim/bolum&sayfa=index");
}
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-top">Bölüm Düzenle</h3>
                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Bölüm İsmi..." name="isim" value="<?php echo $bolum->isim; ?>">
                    </div>
                    <p class="text-right">
                        <button type="submit" class="btn btn-primary">Güncelle <i class="fa fa-cloud-upload"></i></button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>