<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Menü</h3>
    </div>
    <div class="panel-body" style="padding: 0;">
        <div class="list-group" style="margin: 0;">
            <?php
            $arr = [
                [
                    "module" => "home",
                    "action" => "index",
                    "text"   => "Kitap Arama"
                ],
                [
                    "module" => "book",
                    "action" => "index",
                    "text"   => "Rezervasyonlarım"
                ],
                [
                    "module" => "auth",
                    "action" => "logout",
                    "text"   => "Çıkış Yap"
                ],
            ];
            ?>
            <?php foreach($arr as $item): ?>
            <a href="index.php?panel=student&module=<?php echo $item['module']; ?>&action=<?php echo $item["action"]; ?>" class="list-group-item <?php if($module == $item["module"]): ?> active <?php endif; ?>" style="border-radius: 0;">
                <?php echo $item["text"]; ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>