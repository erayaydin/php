<?php
if(!isset($_GET['sayfa_id']))
    die("Sayfa ID bulunamadı!");
$sayfa = $db->query("SELECT * FROM sayfalar WHERE id = ".$_GET["sayfa_id"])->fetch(PDO::FETCH_OBJ);
if(!$sayfa)
    die("Sayfa bulunamadı!");
?>
<section class="sayfa">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center"><?php echo $sayfa->baslik; ?></h3>
                <br>
                <div class="well">
                    <?php echo $sayfa->icerik; ?>
                </div>
            </div>
        </div>
    </div>
</section>