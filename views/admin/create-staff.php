<?php

require __DIR__ . '/header.php';
require __DIR__ . '/../db.php';
require __DIR__ . '/../../csrf.php';

if(isset($_POST['submit']) && CSRF::validateToken($_POST['token'])) {
    $name = filter_input(INPUT_POST, 'name'); 
    $position = filter_input(INPUT_POST, 'position');
    $phone = filter_input(INPUT_POST, 'phone');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $address = filter_input(INPUT_POST, 'address');
  
    $statement = $pdo->prepare("INSERT INTO staff (name, position, phone, email, address) VALUES (?, ?, ?, ?, ?)");
    $statement->execute(array($name, $position, $phone, $email, $address));
    header('Location: /admin/staff');
}

?>
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Tambah Staff</div>
            <div class="card-body">
                <form class="needs-validation" novalidate accept-charset="utf-8" method="post" action="/admin/staff/create">
                    <?php CSRF::csrfInputField() ?>
                    <div class="row g-2">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Nama" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <input type="text" name="position" class="form-control" placeholder="Jabatan" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <input type="tel" name="phone" class="form-control" placeholder="Telepon" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="address" placeholder="Alamat" required>
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>