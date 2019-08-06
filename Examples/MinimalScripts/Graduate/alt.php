<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>Tüm Hakkı Saklıdır &copy; <?php echo date("Y"); ?></p>
            </div>
        </div>
    </div>
</footer>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="kaynaklar/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- JS -->
<?php if(isset($_GET["mesaj"])): ?>
<script>
    <?php if($_GET["mesaj"] == "kayit"): ?>
    alert("Üyeliğiniz başarıyla oluşturuldu. Giriş yapabilirsiniz.");
    <?php endif; ?>
    <?php if($_GET["mesaj"] == "konu"): ?>
    alert("Konunuz başarıyla oluşturuldu. Yönetici onaylandıktan sonra konuyu diğer kullanıcılar da görebilecek.");
    <?php endif; ?>
</script>
<?php endif; ?>
</body>
</html>