<?php

require __DIR__ . '/header.php';
require __DIR__ . '/../db.php';
require __DIR__ . '/../../csrf.php';

$categories = [];
$edit = false;

if(isset($_POST['submit']) && CSRF::validateToken($_POST['token'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    if(isset($_POST['title'])) {
        $statement = $pdo->prepare("UPDATE categories SET title=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'title'), $id));
    }
}

if(isset($_GET['id'])) {
    $edit = true;
    $statement = $pdo->prepare("SELECT * FROM categories WHERE id=?");
    $statement->execute(array(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
    if($statement->rowCount() > 0) {
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    $statement = $pdo->prepare("SELECT * FROM categories");
    $statement->execute();
    if($statement->rowCount() > 0) {
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
<div class="container">
    <div class="page-title">
        <h3>Kategori
            <a href="/admin/categories/create" class="btn btn-sm btn-outline-primary float-end"><i class="fas fa-plus"></i> Tambah</a>
        </h3>
    </div>
    <?php if($edit): ?>
        <div class="card">
            <div class="card-header">Edit Kategori</div>
            <div class="card-body">
                <form accept-charset="utf-8" method="post" action="/admin/categories">
                    <?php CSRF::csrfInputField() ?>
                    <div class="row g-2">
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" placeholder="Kategori" value="<?= $categories[0]['title'] ?>">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $categories[0]['id'] ?>">
                    <button name="submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="box box-primary">
            <div class="box-body">
                <table width="100%" class="table table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td><?= $category['title'] ?></td>
                                    <td class="text-end">
                                        <form action="/admin/categories" method="post">
                                            <?php CSRF::csrfInputField() ?>
                                            <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                            <a href="/admin/categories?id=<?= $category['id']; ?>" class="btn btn-outline-info btn-rounded"><i class="fas fa-pen"></i></a>
                                            <a href="/admin/delete-categories?id=<?= $category['id']; ?>" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></a>
                                            <!-- <button title="delete" type="submit" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></button> -->
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php require __DIR__ . '/footer.php'; ?>