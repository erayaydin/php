<?php
if(isset($_GET["okul_id"])) {
    $okulId = $_GET["okul_id"];
    $okul = $db->query("SELECT * FROM okullar WHERE id = " . $okulId)->fetch(PDO::FETCH_OBJ);
    if (!$okul)
        hata("OKUL", "Okul bulunamadı!");
} else {
    hata("OKUL", "OkulID Belirtilmedi!");
}

if(isset($_POST["isim"])){
    $isim = $_POST["isim"];
    $gonder = $db->prepare("UPDATE okullar SET isim = :isim WHERE id = ".$okul->id);
    $gonder->execute([
        "isim" => $isim,
    ]);

    yonlendir("index.php?modul=yonetim/okul&sayfa=index");
}
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-top">Okul Düzenle</h3>
                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Okul İsmi..." name="isim" value="<?php echo $okul->isim; ?>">
                    </div>
                    <p class="text-right">
                        <button type="submit" class="btn btn-primary">Güncelle <i class="fa fa-cloud-upload"></i></button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>