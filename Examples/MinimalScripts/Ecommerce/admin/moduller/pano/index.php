<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pano</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $db->query("SELECT * FROM siparisler WHERE durum = 0")->rowCount(); ?></div>
                        <div>Yeni Sipariş!</div>
                    </div>
                </div>
            </div>
            <a href="index.php?modul=siparis&sayfa=siparisler&durum=0">
                <div class="panel-footer">
                    <span class="pull-left">Yeni Siparişler</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $db->query("SELECT * FROM siparisler WHERE durum = 2")->rowCount(); ?></div>
                        <div>Kargodaki Sipariş!</div>
                    </div>
                </div>
            </div>
            <a href="index.php?modul=siparis&sayfa=siparisler&durum=2">
                <div class="panel-footer">
                    <span class="pull-left">Kargodaki Siparişler</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $db->query("SELECT * FROM siparisler")->rowCount(); ?></div>
                        <div>Toplam Sipariş!</div>
                    </div>
                </div>
            </div>
            <a href="index.php?modul=siparis&sayfa=siparisler">
                <div class="panel-footer">
                    <span class="pull-left">Tüm Siparişler</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->