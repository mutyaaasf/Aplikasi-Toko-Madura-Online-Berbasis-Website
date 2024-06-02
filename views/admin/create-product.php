<?php

require __DIR__ . '/header.php';
require __DIR__ . '/../db.php';
require __DIR__ . '/../../csrf.php';
require __DIR__ . '/util.php';

if(isset($_POST['submit']) && CSRF::validateToken($_POST['token'])) {
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    $stock = filter_input(INPUT_POST, 'stock');
    $price = filter_input(INPUT_POST, 'price');
    $category = filter_input(INPUT_POST, 'category');
    $statement = $pdo->prepare("SELECT count(*) FROM categories WHERE title=?");
    $statement->execute(array($category));
    if(!$statement->fetchColumn() > 0) {
        $statement = $pdo->prepare("INSERT INTO categories(title) VALUES (?)");
        $statement->execute(array($category));
    }
    $paths = serialize(uploadImages());
    $statement = $pdo->prepare("INSERT INTO products(title, stock, price, description, category, images) VALUES (?, ?, ?, ?, ?, ?)");
    $statement->execute(array($title, $stock, $price, $description, $category, $paths));
    header('Location: /admin/products');
}

$statement = $pdo->prepare("SELECT * FROM categories");
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Tambah Produk</div>
            <div class="card-body">
                <div class="col-md-6">
                    <form action="/admin/products/create" method="post" enctype="multipart/form-data">
                        <?php CSRF::csrfInputField() ?>
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok Produk</label>
                            <input type="number" name="stock" class="form-control" min=0 step=0.01 required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="price" class="form-control" min=0 step=0.01 required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Produk</label>
                            <textarea class="form-control" name="description" style="resize:none" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="language" class="form-label">Kategori</label>
                             <div class="input-group mb3">
                        	    <div class="dropdown input-group-prepend">
                            	  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            		Pilih
                            	  </button>
                            	  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            		<?php foreach($categories as $category): ?>
                            		    <li><a class="dropdown-item"><?= $category['title'] ?></a></li>
                            		    <div role="separator" class="dropdown-divider"></div>
                            		<?php endforeach; ?>
                            	  </ul>
                        	    </div>
                                <input id="category" type="text" name="category" class="form-control" aria-label="Text input with dropdown button" value="<?= !empty($categories) ? $categories[0]['title'] : '' ?>">
                        	</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input class="form-control" name="files[]" type="file" id="formFile1" multiple required>
                            <small class="text-muted">Pilih gambar produk</small>
                        </div>
                        <div class="mb-3 text-end">
                            <button name="submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>
<script>
    $('.dropdown-item').click(function() {
        $('#category').val($(this).text())
    })
</script>