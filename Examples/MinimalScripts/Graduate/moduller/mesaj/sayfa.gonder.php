<?php
if(isset($_POST["cevap"])){
    $cevap = $_POST["cevap"];
    $alan = $_POST["alan_id"];

    if($alan != "0"){
        $gonder = $db->prepare("INSERT INTO mesajlar(gonderen_id,alan_id,mesaj,tarih) VALUES(:gonderen, :alan, :mesaj, :tarih)");
        $gonder->execute([
            "gonderen" => $giris->id,
            "alan" => $alan,
            "mesaj" => $cevap,
            "tarih" => date("Y-m-d H:i:s")
        ]);

        yonlendir("index.php?modul=mesaj&sayfa=detay&mesaj_id=".$db->lastInsertId());
    }
}
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3 class="m-top">Mesaj Gönder</h3>
                <form method="post">
                    <div class="form-group">
                        <select class="form-control" name="alan_id">
                            <option value="0">Seçiniz</option>
                            <?php foreach($db->query("SELECT * FROM kullanicilar WHERE id != ".$giris->id." ORDER BY adsoyad ASC")->fetchAll(PDO::FETCH_OBJ) as $kisi): ?>
                                <option value="<?php echo $kisi->id ?>" <?php if(isset($_GET["kullanici_id"]) && $_GET["kullanici_id"] == $kisi->id): ?> selected <?php endif; ?>><?php echo $kisi->adsoyad; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Mesajınız..." rows="4" name="cevap"></textarea>
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