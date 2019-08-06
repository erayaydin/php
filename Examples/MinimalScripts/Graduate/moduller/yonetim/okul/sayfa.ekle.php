<?php
if(isset($_POST["isim"])){
    $isim = $_POST["isim"];
    $gonder = $db->prepare("INSERT INTO okullar(isim) VALUES(:isim)");
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
                <h3 class="m-top">Yeni Okul Ekle</h3>
                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Okul İsmi..." name="isim">
                    </div>
                    <p class="text-right">
                        <button type="submit" class="btn btn-primary">Ekle <i class="fa fa-plus"></i></button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>