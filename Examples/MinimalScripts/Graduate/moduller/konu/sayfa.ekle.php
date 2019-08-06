<?php
if(isset($_POST["icerik"])){
    $icerik = $_POST["icerik"];
    $baslik = $_POST["baslik"];

        $gonder = $db->prepare("INSERT INTO konular(kullanici_id,baslik,mesaj,durum,tarih,meslek_id,yer_id) VALUES(:kullanici,:baslik,:mesaj,0,:tarih,:meslek,:yer)");
        $gonder->execute([
            "kullanici" => $giris->id,
            "baslik" => $baslik,
            "mesaj" => $icerik,
            "meslek" => $giris->meslek_id,
            "yer" => $giris->yer_id,
            "tarih" => date("Y-m-d H:i:s")
        ]);

        yonlendir("index.php?modul=konu&sayfa=index&mesaj=konu");
}
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3 class="m-top">Yeni Konu Aç</h3>
                <form method="post">
                    <div class="form-group">
                        <label for="baslik">Başlık</label>
                        <input type="text" class="form-control" name="baslik" placeholder="Konu Başlığı">
                    </div>
                    <div class="form-group">
                        <label for="icerik">İçerik</label>
                        <textarea class="form-control" placeholder="Konu içeriği..." rows="4" name="icerik"></textarea>
                    </div>
                    <p class="text-right">
                        <button type="submit" class="btn btn-primary">Gönder <i class="fa fa-send"></i></button>
                    </p>
                </form>
            </div>
            <div class="col-md-4">
                <?php include "moduller/parca/yan.php"; ?>
            </div>
        </div>
    </div>
</section>