<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo siteAyar("siteadi"); ?></title>

    <!-- Bootstrap -->
    <link href="kaynaklar/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="kaynaklar/vendor/bootstrap/css/bootstrap-simplex.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="kaynaklar/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Stil -->
    <link href="kaynaklar/css/stil.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="kaynaklar/resim/kapak.png" alt="<?php echo siteAyar("siteadi"); ?>" class="img-responsive">
            </div>
        </div>
    </div>
</header>
<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
                <span class="sr-only">Menüyü Aç</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <img alt="Brand" src="kaynaklar/resim/logo-kucuk.png" class="img-responsive">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="menu">
            <ul class="nav navbar-nav">
                <li <?php if($modul == "ana" && $sayfa == "index"): ?> class="active" <?php endif; ?>><a href="index.php">Anasayfa</a></li>
                <li class="dropdown <?php if($modul == "konu"): ?> active <?php endif; ?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Konu Listesi <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?modul=konu&sayfa=index">Tüm Konular</a></li>
                        <?php if($giris): ?>
                            <li><a href="index.php?modul=konu&sayfa=ekle">Yeni Konu Aç</a></li>
                        <?php endif; ?>
                        <li role="separator" class="divider"></li>
                        <li><a href="index.php?modul=konu&sayfa=index&filtre=meslek">Mesleğe Göre Ara</a></li>
                        <li><a href="index.php?modul=konu&sayfa=index&filtre=yerlesim">Yerleşime Göre Ara</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if($giris): // Eğer giriş yapmışsa burayı göster... ?>
                    <?php if($giris->admin == 1): ?>
                        <li <?php if($modul == "yonetim"): ?> class="active" <?php endif; ?>><a href="index.php?modul=yonetim&sayfa=index">Yönetim Paneli</a></li>
                    <?php endif; ?>
                    <li class="dropdown <?php if($modul == "kullanici"): ?> active <?php endif; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $giris->adsoyad; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?modul=mesaj&sayfa=index">Mesajlarım</a></li>
                            <li><a href="index.php?modul=kullanici&sayfa=hesap">Hesap Ayarlarım</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="index.php?modul=kullanici&sayfa=cikis">Çıkış Yap</a></li>
                        </ul>
                    </li>
                <?php else: // Giriş yapmamışsa şunları göster... ?>
                    <li><a href="index.php"><i class="fa fa-sign-in"></i> Giriş Yap</a></li>
                    <li><a href="index.php?modul=kullanici&sayfa=kayit"><i class="fa fa-user-plus"></i> Kayıt Ol</a></li>
                <?php endif; ?>
            </ul>
            <form class="navbar-form navbar-right" action="index.php" method="get">
                <input type="hidden" name="modul" value="konu">
                <input type="hidden" name="sayfa" value="index">
                <div class="form-group">
                    <input type="text" class="form-control" name="q" placeholder="Konu Ara...">
                </div>
                <button type="submit" class="btn btn-default">Ara</button>
            </form>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>