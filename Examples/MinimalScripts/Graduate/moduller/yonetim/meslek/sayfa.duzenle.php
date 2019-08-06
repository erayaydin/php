<?php
if(isset($_GET["meslek_id"])) {
    $meslekId = $_GET["meslek_id"];
    $meslek = $db->query("SELECT * FROM meslekler WHERE id = " . $meslekId)->fetch(PDO::FETCH_OBJ);
    if (!$meslek)
        hata("MESLEK", "Meslek bulunamadı!");
} else {
    hata("MESLEK", "MeslekID Belirtilmedi!");
}

if(isset($_POST["isim"])){
    $isim = $_POST["isim"];
    $gonder = $db->prepare("UPDATE meslekler SET isim = :isim WHERE id = ".$meslek->id);
    $gonder->execute([
        "isim" => $isim,
    ]);

    yonlendir("index.php?modul=yonetim/meslek&sayfa=index");
}
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-top">Meslek Düzenle</h3>
                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Meslek İsmi..." name="isim" value="<?php echo $meslek->isim; ?>">
                    </div>
                    <p class="text-right">
                        <button type="submit" class="btn btn-primary">Güncelle <i class="fa fa-cloud-upload"></i></button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>