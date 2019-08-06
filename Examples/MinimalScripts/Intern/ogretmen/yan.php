<div class="list-group">
    <a href="index.php" class="list-group-item <?php if($modul == "pano"): ?> active <?php endif; ?>">
        Öğrenci Arama
    </a>
    <a href="index.php?modul=ogrenci&dosya=liste" class="list-group-item <?php if($modul == "ogrenci" && $dosya == "liste"): ?> active <?php endif; ?>">Öğrenciler</a>
    <a href="index.php?modul=ogrenci&dosya=ekle" class="list-group-item <?php if($modul == "ogrenci" && $dosya == "ekle"): ?> active <?php endif; ?>">Öğrenci Ekle</a>
    <a href="index.php?modul=staj&dosya=liste" class="list-group-item <?php if($modul == "staj" && $dosya == "liste"): ?> active <?php endif; ?>">Stajyer Listesi</a>
    <a href="index.php?modul=staj&dosya=ekle" class="list-group-item <?php if($modul == "staj" && $dosya == "ekle"): ?> active <?php endif; ?>">Staj Oluştur</a>
</div>