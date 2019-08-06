<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($_POST["send"])){
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $phone = $_POST["phone"];
                    $message = $_POST["message"];

                    $hatalar = []; // Hatalar için boş bir dizi oluştur.
                    if(!$name)
                        $hatalar[] = "Lütfen bir isim belirtin.";
                    if(!$email)
                        $hatalar[] = "Lütfen bir e-posta adresi belirtin.";
                    if(!$phone)
                        $hatalar[] = "Lütfen bir telefon numarası belirtin.";
                    if(!$message)
                        $hatalar[] = "Lütfen bir mesaj belirtin.";

                    if(count($hatalar) > 0) {
                        ?>
                        <div class="alert alert-danger">
                            <?php foreach ($hatalar as $hata): ?>
                                <p><?php echo $hata; ?></p>
                            <?php endforeach; ?>
                        </div>
                        <?php
                    } else {
                        $query = $db->prepare("INSERT INTO mesajlar(adsoyad,eposta,telefon,mesaj) VALUES(:adsoyad,:eposta,:telefon,:mesaj)");
                        $query->execute([
                            "adsoyad" => $name,
                            "telefon" => $phone,
                            "eposta" => $email,
                            "mesaj" => $message,
                        ]);

                        if($query){
                            header("Location: index.php?mesaj=mesaj");
                        } else {
                            ?>
                            <div class="alert alert-danger">
                                <p>Yeni mesaj eklemede sorun oluştu.</p>
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
                <form method="POST">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">İletişim Mesajı</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="name"><i class="fa fa-user"></i></span>
                                    <input type="text" value="<?php echo post('name'); ?>" name="name" class="form-control" placeholder="Ad Soyad" aria-describedby="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="email"><i class="fa fa-envelope-o"></i></span>
                                    <input type="email" value="<?php echo post('email'); ?>" name="email" class="form-control" placeholder="E-Posta Adresi" aria-describedby="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="phone"><i class="fa fa-phone"></i></span>
                                    <input type="tel" value="<?php echo post('phone'); ?>" name="phone" class="form-control" placeholder="Telefon Numarası" aria-describedby="phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" cols="30" rows="10" placeholder="Mesajınız" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <button type="submit" class="btn btn-primary" name="send" value="send">Mesaj Gönder <i class="fa fa-send"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>