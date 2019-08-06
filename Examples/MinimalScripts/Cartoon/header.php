<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $ayar["site"]["name"]; ?></title>

    <!-- Bootstrap -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap-sandstone.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Stil -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="index.php">
                    <img src="assets/img/logo.png" alt="<?php echo $ayar["site"]["name"]; ?>">
                </a>
            </div>
        </div>
    </div>
</header>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-menu" aria-expanded="false">
                <span class="sr-only">Menüyü Aç</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><i class="fa fa-home"></i></a>
        </div>

        <div class="collapse navbar-collapse" id="primary-menu">
            <ul class="nav navbar-nav">
                <li <?php if($modul == "cartoon" && $sayfa == "index"): ?> class="active" <?php endif; ?>><a href="index.php?modul=cartoon&sayfa=index"><i class="fa fa-photo"></i> &nbsp; KARİKATÜRLER</a></li>
                <li <?php if($modul == "author" && $sayfa == "index"): ?> class="active" <?php endif; ?>><a href="index.php?modul=author&sayfa=index"><i class="fa fa-user-circle-o"></i> &nbsp; KARİKATÜRİSTLER</a></li>
                <li <?php if($modul == "cartoon" && $sayfa == "popular"): ?> class="active" <?php endif; ?>><a href="index.php?modul=cartoon&sayfa=popular"><i class="fa fa-fire"></i> &nbsp; POPÜLER KARİKATÜRLER</a></li>
                <li <?php if($modul == "contact" && $sayfa == "show"): ?> class="active" <?php endif; ?>><a href="index.php?modul=contact&sayfa=show"><i class="fa fa-map-marker"></i> &nbsp; İLETİŞİM</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if($giris): ?>
                    <li <?php if($modul == "cartoon" && $sayfa == "create"): ?> class="active" <?php endif; ?>><a href="index.php?modul=cartoon&sayfa=create"><i class="fa fa-send"></i> &nbsp; Karikatür Gönder</a></li>
                    <?php if($giris->admin): ?>
                        <li <?php if($modul == "yonetim"): ?> class="active" <?php endif; ?>><a href="index.php?modul=yonetim&sayfa=index"><i class="fa fa-wrench"></i> &nbsp; Yönetim Paneli</a></li>
                    <?php endif; ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i> &nbsp;
                            <?php echo $giris->kullaniciadi; ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?modul=uye&sayfa=ayar">Hesap Ayarlarım</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="index.php?modul=uye&sayfa=cikis">Çıkış Yap</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li <?php if($modul == "uye" && $sayfa == "giris"): ?> class="active" <?php endif; ?>><a href="index.php?modul=uye&sayfa=giris"><i class="fa fa-sign-in"></i> &nbsp; GİRİŞ YAP</a></li>
                    <li <?php if($modul == "uye" && $sayfa == "kayit"): ?> class="active" <?php endif; ?>><a href="index.php?modul=uye&sayfa=kayit"><i class="fa fa-user-plus"></i> &nbsp; KAYIT OL</a></li>
                <?php endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
