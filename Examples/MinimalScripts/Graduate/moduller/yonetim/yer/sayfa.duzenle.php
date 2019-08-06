<?php
if(isset($_GET["yer_id"])) {
    $yerId = $_GET["yer_id"];
    $yer = $db->query("SELECT * FROM yerler WHERE id = " . $yerId)->fetch(PDO::FETCH_OBJ);
    if (!$yer)
        hata("YER", "Yer bulunamadı!");
} else {
    hata("YER", "YerID Belirtilmedi!");
}

if(isset($_POST["isim"])){
    $isim = $_POST["isim"];
    $gonder = $db->prepare("UPDATE yerler SET isim = :isim WHERE id = ".$yer->id);
    $gonder->execute([
        "isim" => $isim,
    ]);

    yonlendir("index.php?modul=yonetim/yer&sayfa=index");
}
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-top">Şehir Düzenle</h3>
                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Şehir İsmi..." name="isim" value="<?php echo $yer->isim; ?>">
                    </div>
                    <p class="text-right">
                        <button type="submit" class="btn btn-primary">Güncelle <i class="fa fa-cloud-upload"></i></button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>