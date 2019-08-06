<footer>
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-3 col-sm-4 col-xs-6">
                    <h3> <?php echo $siteayar->siteadi; ?> </h3>
                    <ul>
                        <?php foreach($db->query("SELECT * FROM sayfalar WHERE durum = 1 ORDER BY id ASC")->fetchAll(PDO::FETCH_OBJ) as $sayfa): ?>
                        <li> <a href="index.php?modul=sayfa&sayfa=goster&sayfa_id=<?php echo $sayfa->id; ?>"> <?php echo $sayfa->baslik; ?> </a> </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-lg-3  col-md-3 col-sm-4 col-xs-6">
                    <h3> Kategoriler </h3>
                    <ul>
                        <?php foreach($db->query("SELECT * FROM kategoriler WHERE durum = 1 LIMIT 0,4")->fetchAll(PDO::FETCH_OBJ) as $kategori): ?>
                        <li> <a href="index.php?modul=kategori&sayfa=goster&kategori_id=<?php echo $kategori->id; ?>"> <?php echo $kategori->baslik; ?> </a> </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-lg-3  col-md-3 col-sm-4 col-xs-6">
                    <h3> Son Ürünler </h3>
                    <ul>
                        <?php foreach($db->query("SELECT * FROM urunler WHERE durum = 1 ORDER BY id DESC LIMIT 0,4")->fetchAll(PDO::FETCH_OBJ) as $urun): ?>
                        <li> <a href="index.php?modul=urun&sayfa=detay&urun_id=<?php echo $urun->id; ?>"> <?php echo $urun->baslik; ?> </a> </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-lg-3  col-md-3 col-sm-12 col-xs-6">
                    <h3> Sosyal Ağ </h3>
                    <ul class="social">
                        <li> <a href="<?php echo $siteayar->facebook; ?>"> <i class=" fa fa-facebook">   </i> </a> </li>
                        <li> <a href="<?php echo $siteayar->twitter; ?>"> <i class="fa fa-twitter">   </i> </a> </li>
                        <li> <a href="<?php echo $siteayar->google; ?>"> <i class="fa fa-google-plus">  </i> </a> </li>
                        <li> <a href="<?php echo $siteayar->pinterest; ?>"> <i class="fa fa-pinterest">   </i> </a> </li>
                        <li> <a href="<?php echo $siteayar->youtube; ?>"> <i class="fa fa-youtube">   </i> </a> </li>
                    </ul>
                </div>
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
    </div>
    <!--/.footer-->

    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left"> Copyright © <?php echo $siteayar->siteadi; ?> <?php echo date("Y"); ?>. Tüm hakkı saklıdır. </p>
            <div class="pull-right">
                <ul class="nav nav-pills payments">
                    <li><i class="fa fa-cc-visa"></i></li>
                    <li><i class="fa fa-cc-mastercard"></i></li>
                    <li><i class="fa fa-cc-amex"></i></li>
                    <li><i class="fa fa-cc-paypal"></i></li>
                </ul>
            </div>
        </div>
    </div>
    <!--/.footer-bottom-->
</footer>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Swiper -->
<script src="assets/vendor/swiper/js/swiper.jquery.min.js"></script>
<!-- JS -->
<script>
    var slayt = new Swiper('.swiper-container', {
        loop: true,
        autoplay: 3000,
        pagination: '.swiper-pagination',
        paginationClickable: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev'
    });
</script>
<script>
    function sepetGuncelle(msg) {
        var sayac = $(".sepetsay");
        sayac.show(); // sepetteki ürün sayısını göster(gizli ise)

        var adet = 0;
        var urunler = $(".sepeturunler");
        urunler.html(""); // Sayfada gözüken sepetteki ürünleri sil.
        $.each(msg, function(i, val){ // Her sepetteki ürün için html kısmını oluşturup bunu açılır menüye ekle
            var yeniUrun = "<li>";
            yeniUrun += "<span class='item'>";
            yeniUrun += "<span class='item-left'>";
            yeniUrun += "<img src='upload/urun/"+val.id+".png' alt='"+val.baslik+"'>";
            yeniUrun += "<span class='item-info'>";
            yeniUrun += "<span>"+val.baslik+" ("+val.adet+")</span>";
            yeniUrun += "<span>"+val.fiyat+" <i class='fa fa-try'></i></span>";
            yeniUrun += "</span>";
            yeniUrun += "</span>";
            yeniUrun += "<span class='item-right'>";
            yeniUrun += "<button class='btn btn-xs btn-danger pull-right remove-cart' data-id='"+val.id+"'><i class='fa fa-trash'></i></button>";
            yeniUrun += "</span>";
            yeniUrun += "</span>";
            yeniUrun += "</li>";
            urunler.append(yeniUrun);
            adet++;
        });

        sayac.html(adet);

        urunler.append('<li class="divider"></li>');
        urunler.append('<li><a class="text-center" href="index.php?modul=sepet&sayfa=goster">Sepeti Görüntüle</a></li>');
    }

    $(".add-to-cart").bind('click', function(){ // Eğer sepete ekle butonuna basılırsa...
        var urunId = $(this).data('id'); // Butonun data-id='' kısmından ID'yi al
        $.ajax({ // Arkada AJAX ile sepete ekleme isteğini gönder
            method: 'POST', // Gönderme metodu (GET, POST)
            url: 'sepet.php?islem=ekle', // Gönderilecek adres
            dataType: 'JSON', // Gelen sonuç JSON olsun
            data: 'urun_id='+urunId // Gidecek veri (hangi ürünün sepete ekleneceğini söylüyoruz)
        }).done(function(msg){ // Sonuç..
            sepetGuncelle(msg);
            alert("Ürün başarıyla sepete eklendi.");
        });
    });

    $(document).on('click', '.remove-cart', function(){
        var urunId = $(this).data('id');
        $.ajax({ // Arkada AJAX ile sepete ekleme isteğini gönder
            method: 'POST', // Gönderme metodu (GET, POST)
            url: 'sepet.php?islem=sil', // Gönderilecek adres
            dataType: 'JSON', // Gelen sonuç JSON olsun
            data: 'urun_id='+urunId // Gidecek veri (hangi ürünün sepete ekleneceğini söylüyoruz)
        }).done(function(msg){ // Sonuç..
            sepetGuncelle(msg);
        });
    });

    $(".sepet-ekle-arttir").bind('click', function(){
        var adet = parseInt($(".sepet-ekle-adet").val());
        adet++;
        $(".sepet-ekle-adet").val(adet);
    });

    $(".sepet-ekle-azalt").bind('click', function(){
        var adet = parseInt($(".sepet-ekle-adet").val());
        adet--;
        if(adet < 0)
            adet = 0;
        $(".sepet-ekle-adet").val(adet);
    });

    $(".sepet-coklu-ekle").bind('click', function(){ // Eğer sepete ekle butonuna basılırsa...
        var urunId = $(this).data('id'); // Butonun data-id='' kısmından ID'yi al
        var adet = $(".sepet-ekle-adet").val();
        $.ajax({ // Arkada AJAX ile sepete ekleme isteğini gönder
            method: 'POST', // Gönderme metodu (GET, POST)
            url: 'sepet.php?islem=ekle', // Gönderilecek adres
            dataType: 'JSON', // Gelen sonuç JSON olsun
            data: 'urun_id='+urunId+"&adet="+adet // Gidecek veri (hangi ürünün sepete ekleneceğini söylüyoruz)
        }).done(function(msg){ // Sonuç..
            sepetGuncelle(msg);
            alert("Ürün "+adet+" adet olarak başarıyla eklendi!");
        });
    });
</script>
<?php if(isset($_GET["sepet"])): ?>
<script>
    alert("Siparişiniz başarıyla oluşturuldu. En kısa sürede dönüş yapılacaktır. Siparişinizin durumunu giriş yaptıysanız kullanıcı panelinizden görebilirsiniz. Giriş yapmadan sipariş gönderdiyseniz lütfen e-posta adrenizi takip edin.");
</script>
<?php endif; ?>
</body>
</html>