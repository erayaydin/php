<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted">Copyright &copy; 2017 &middot; Tüm Hakkı Saklıdır!</p>
            </div>
        </div>
    </div>
</footer>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script>
    $(document).on('click', '.like', function () {
        var like = $(this);
        var id = like.data("id");
        $.ajax({
            method: "POST",
            url: "like.php",
            data: "id="+id,
            dataType: "JSON"
        }).done(function(msg){
            var boxes = $("[data-id='"+id+"']");
            boxes.html(msg.like+" <i class='fa fa-heart'></i>");
            boxes.removeClass("like").addClass("unlike");
        });
    });
    $(document).on('click', '.unlike', function () {
        var like = $(this);
        var id = like.data("id");
        $.ajax({
            method: "POST",
            url: "unlike.php",
            data: "id="+id,
            dataType: "JSON"
        }).done(function(msg){
            var boxes = $("[data-id='"+id+"']");
            boxes.html(msg.like+" <i class='fa fa-heart-o'></i>");
            boxes.removeClass("unlike").addClass("like");
        });
    });
</script>
<script>
    <?php
        $mesajBox = [
             "kayit" => "Başarıyla kayıt oldunuz. Artık giriş yapabilirsiniz.",
             "guncel" => "Hesap bilgileriniz güncellendi!",
             "karikatur" => "Yeni karikatür gönderildi. Yönetici onayladıktan sonra sitede diğer kullanıcılar tarafından gözükecektir.",
             "mesaj" => "iletişim mesajınız başarılı bir şekilde gönderildi. En kısa sürede geri dönüş yapılacaktır.",
        ];
    ?>
    <?php if(isset($_GET['mesaj'])): ?>
        alert("<?php echo $mesajBox[$_GET["mesaj"]]; ?>");
    <?php endif; ?>
</script>
</body>
</html>