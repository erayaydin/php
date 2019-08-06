<?php
$cizer = $db->query("SELECT * FROM cizerler WHERE id = ".$_GET['cizer'])->fetch(PDO::FETCH_OBJ);
?>
<section class="home">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($_POST["send"])){
                    $name = $_POST["name"];

                    $hatalar = []; // Hatalar için boş bir dizi oluştur.
                    if(!$name)
                        $hatalar[] = "Lütfen bir isim belirtin.";

                    if(count($hatalar) > 0) {
                        ?>
                        <div class="alert alert-danger">
                            <?php foreach ($hatalar as $hata): ?>
                                <p><?php echo $hata; ?></p>
                            <?php endforeach; ?>
                        </div>
                        <?php
                    } else {
                        $query = $db->prepare("UPDATE cizerler SET `name` = :name WHERE id = :id");
                        $query->execute([
                            "name" => $name,
                            "id" => $cizer->id
                        ]);

                        if($query){
                            header("Location: index.php?modul=yonetim&sayfa=cizer_index");
                        }
                    }
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Yönetim Paneli &middot; Çizer Düzenle</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form method="POST">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Çizer Düzenle</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="name"><i class="fa fa-user"></i></span>
                                    <input type="text" value="<?php echo post('name') ? post('name') : $cizer->name; ?>" name="name" class="form-control" placeholder="Çizer Adı" aria-describedby="name">
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <button type="submit" class="btn btn-primary" name="send" value="send">Çizer Güncelle <i class="fa fa-cloud-upload"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>