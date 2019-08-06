<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($_POST["send"])){
                    $name   = $_POST["name"];
                    $author = $_POST["author"];
                    $file   = $_FILES["file"];

                    $hatalar = [];
                    if(!$name)
                        $hatalar[] = "Lütfen bir başlık belirtin.";
                    if(!$author || $author == 0)
                        $hatalar[] = "Lütfen bir çizer seçiniz.";
                    if($file["error"])
                        $hatalar[] = "Karikatür resmi yüklemediniz.";

                        if(!empty($file["tmp_name"])){
                            if($file["size"] <= 500000) {
                                if(getimagesize($file['tmp_name']) == false){
                                    $hatalar[] = "Yüklediğiniz fotoğraf dosyası yanlış formatta.";
                                }
                            } else {
                                $hatalar[] = "Fotoğrafınız 500KB'dan fazla olamaz.";
                            }
                        }

                    if(count($hatalar) > 0){
                        ?>
                        <div class="alert alert-danger">
                            <?php foreach($hatalar as $hata): ?>
                                <p><?php echo $hata; ?></p>
                            <?php endforeach; ?>
                        </div>
                        <?php
                    } else {
                        $query = $db->prepare("INSERT INTO karikaturler(kullanici_id,cizer_id,baslik,begenme,goruntulenme,durum) VALUES(:kullanici,:cizer,:baslik,0,0,0)");
                        $query->execute([
                            "kullanici" => $giris->id,
                            "cizer" => $author,
                            "baslik" => $name,
                        ]);

                        if($query){
                            move_uploaded_file($file["tmp_name"], "upload/karikatur/".$db->lastInsertId().".png");
                            yonlendir("index.php?mesaj=karikatur");
                        } else {
                            ?>
                            <div class="alert alert-danger">
                                <p>Yüklenirken bir sorun oluştu.</p>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form method="POST" enctype="multipart/form-data">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">Karikatür Gönder</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="name"><i class="fa fa-align-justify"></i></span>
                                    <input type="text" value="<?php echo post('name'); ?>" name="name" class="form-control" placeholder="Başlık" aria-describedby="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="author"><i class="fa fa-user-circle-o"></i></span>
                                    <select name="author" id="author" class="form-control">
                                        <option value="0">Seçiniz</option>
                                        <?php foreach($db->query("SELECT * FROM cizerler ORDER BY name ASC")->fetchAll(PDO::FETCH_OBJ) as $author): ?>
                                            <option <?php if(post("author") == $author->id): ?> selected <?php endif; ?> value="<?php echo $author->id; ?>"><?php echo $author->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="file"><i class="fa fa-file-image-o"></i></span>
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <button type="submit" class="btn btn-warning" name="send" value="send">Gönder <i class="fa fa-send"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>