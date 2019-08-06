<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php include __DIR__."/../side.php" ?>
        </div>
        <div class="col-md-10">
            <p class="text-right">
                <a href="index.php?panel=admin&module=category&action=create" class="btn btn-success">Yeni Kategori Ekle <i class="fa fa-plus-circle"></i></a>
            </p>

            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Kategoriler</h3>
                </div>
                <div class="panel-body" style="padding: 0;">
                    <table class="table table-bordered table-striped table-hovered table-hover" style="margin: 0;">
                        <thead>
                        <tr>
                            <th>Kategori Adı</th>
                            <th class="text-right">İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach(Application::$db->db->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll(PDO::FETCH_OBJ) as $category): ?>
                            <tr>
                                <td><?php echo $category->name; ?></td>
                                <td class="text-right">
                                    <a href="index.php?panel=admin&module=category&action=edit&book=<?php echo $category->id; ?>" class="btn btn-xs btn-warning">Düzenle <i class="fa fa-pencil"></i></a>
                                    <a href="index.php?panel=admin&module=category&action=delete&book=<?php echo $category->id; ?>" class="btn btn-xs btn-danger">Sil <i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>