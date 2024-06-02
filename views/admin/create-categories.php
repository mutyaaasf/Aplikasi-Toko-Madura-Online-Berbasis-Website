<?php

require __DIR__ . '/header.php';
require __DIR__ . '/../db.php';
require __DIR__ . '/../../csrf.php';

if(isset($_POST['submit']) && CSRF::validateToken($_POST['token'])) {
    $title = filter_input(INPUT_POST, 'title'); 
  
    $statement = $pdo->prepare("INSERT INTO categories (title) VALUES (?)");
    $statement->execute(array($title));
    header('Location: /admin/categories');
}

?>
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Tambah Kategori</div>
            <div class="card-body">
                <form class="needs-validation" novalidate accept-charset="utf-8" method="post" action="/admin/categories/create">
                    <?php CSRF::csrfInputField() ?>
                    <div class="row g-2">
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" placeholder="Kategori" required>
                        </div>
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>