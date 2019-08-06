<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $siteayar->siteadi; ?></title>

    <!-- Bootstrap -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap-lumen.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Swiper -->
    <link href="assets/vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <!-- Stil -->
    <link href="assets/css/stil.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="index.php" title="<?php echo $siteayar->siteadi; ?>">
                    <img src="assets/images/logo.png" />
                </a>
            </div>
            <div class="col-md-6 text-right">
                <div class="contact-info">
                    <a href="tel:<?php echo $siteayar->telefon; ?>"><i class="fa fa-phone"></i> <span><?php echo $siteayar->telefon; ?></span></a>
                </div>
                <div class="contact-info">
                    <a href="mail:<?php echo $siteayar->eposta; ?>"><i class="fa fa-envelope"></i> <span><?php echo $siteayar->eposta; ?></span></a>
                </div>
                <div class="contact-info">
                    <a href="fax:<?php echo $siteayar->fax; ?>"><i class="fa fa-fax"></i> <span><?php echo $siteayar->fax; ?></span></a>
                </div>
            </div>
        </div>
    </div>
</header>
<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#birincil-menu" aria-expanded="false">
                <span class="sr-only">Menüyü Aç</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><?php echo $ayar["site"]["baslik"]; ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="birincil-menu">
            <ul class="nav navbar-nav">
                <li <?php if($modul == "anasayfa" && $sayfa == "listeleme"): ?> class="active" <?php endif; ?>><a href="index.php">Anasayfa</a></li>
                <?php foreach($db->query("SELECT * FROM kategoriler WHERE durum = 1")->fetchAll(PDO::FETCH_OBJ) as $kategori): ?>
                    <li <?php if($modul == "kategori" && $sayfa == "goster" && $_GET["kategori_id"] == $kategori->id): ?> class="active" <?php endif; ?>><a href="index.php?modul=kategori&sayfa=goster&kategori_id=<?php echo $kategori->id; ?>"><?php echo $kategori->baslik; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if(isset($_SESSION["giris"])): ?>
                    <li class="dropdown <?php if($modul == "kullanici" && $sayfa == "ayar"): ?> active <?php endif; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $giris->kullaniciadi; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?modul=kullanici&sayfa=ayar">Hesap Bilgilerim</a></li>
                            <li><a href="index.php?modul=kullanici&sayfa=siparislerim">Siparişlerim</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="index.php?modul=kullanici&sayfa=cikis">Çıkış Yap</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li <?php if($modul == "kullanici" && $sayfa == "giris"): ?> class="active" <?php endif; ?>><a href="index.php?modul=kullanici&sayfa=giris"><i class="fa fa-sign-in"></i> Giriş Yap</a></li>
                    <li <?php if($modul == "kullanici" && $sayfa == "kayit"): ?> class="active" <?php endif; ?>><a href="index.php?modul=kullanici&sayfa=kayit"><i class="fa fa-user-plus"></i> Kayıt Ol</a></li>
                <?php endif; ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        <?php
                        $sepettekiUrun = 0;
                        if(isset($_SESSION["sepet"])){ // Sepet varsa...
                            $sepettekiUrun = count($_SESSION["sepet"]); // Sepetteki ürünü çek
                        }
                        ?>
                        Sepet
                        <span class="label label-primary sepetsay" <?php if($sepettekiUrun == 0): ?> style="display: none;" <?php endif; ?>><?php echo $sepettekiUrun; ?></span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-cart sepeturunler" role="menu">
                        <?php if(isset($_SESSION["sepet"])): // Sepette ürün varsa... ?>
                        <?php foreach($_SESSION["sepet"] as $key => $sepet): // Her ürünü göster ?>
                            <?php $urun = $db->query("SELECT * FROM urunler WHERE id = ".$sepet['urun_id'])->fetch(PDO::FETCH_OBJ); ?>
                        <li>
                            <span class="item">
                                <span class="item-left">
                                    <img src="upload/urun/<?php echo $urun->id; ?>.png" alt="<?php echo $urun->baslik; ?>" />
                                    <span class="item-info">
                                        <span><?php echo $urun->baslik; ?> (<?php echo $sepet['adet']; ?>)</span>
                                        <span><?php echo number_format($urun->fiyat, 2); ?> <i class="fa fa-try"></i></span>
                                    </span>
                                </span>
                                <span class="item-right">
                                    <button class="btn btn-xs btn-danger pull-right remove-cart" data-id="<?php echo $urun->id; ?>"><i class="fa fa-trash"></i></button>
                                </span>
                            </span>
                        </li>
                        <?php endforeach; ?>
                        <li class="divider"></li>
                        <?php endif; ?>
                        <li><a class="text-center" href="index.php?modul=sepet&sayfa=goster">Sepeti Görüntüle</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-right" method="get">
                <input type="hidden" name="modul" value="urun">
                <input type="hidden" name="sayfa" value="arama">
                <div class="form-group">
                    <input type="text" required name="q" class="form-control" placeholder="Arama...">
                </div>
                <button type="submit" class="btn btn-default">Ara</button>
            </form>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>