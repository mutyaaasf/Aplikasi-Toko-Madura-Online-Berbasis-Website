<?php 

require __DIR__ . '/header.php';
require __DIR__ . '/../db.php';
require __DIR__ . '/../../csrf.php';

$suppliers;
$edit = false;

if(isset($_POST['submit']) && CSRF::validateToken($_POST['token'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    if(isset($_POST['name'])) {
        $statement = $pdo->prepare("UPDATE suppliers SET name=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'name'), $id));
    }
    if(isset($_POST['lastname'])) {
        $statement = $pdo->prepare("UPDATE suppliers SET lastname=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'lastname'), $id));
    }
    if(isset($_POST['phone'])) {
        $statement = $pdo->prepare("UPDATE suppliers SET phone=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'phone'), $id));
    }
    if(isset($_POST['address'])) {
        $statement = $pdo->prepare("UPDATE suppliers SET address=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'address'), $id));
    }
    if(isset($_POST['email'])) {
        $statement = $pdo->prepare("UPDATE suppliers SET email=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL), $id));
    }
    if(isset($_POST['password'])) {
        $statement = $pdo->prepare("UPDATE suppliers SET password=? WHERE id=?");
        $statement->execute(array(password_hash(filter_input(INPUT_POST, 'password'), PASSWORD_DEFAULT), $id));
    }
}

if(isset($_GET['id'])) {
    $edit = true;
    $statement = $pdo->prepare("SELECT * FROM suppliers WHERE id=?");
    $statement->execute(array(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
    if($statement->rowCount() > 0) {
        $suppliers = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    if(isset($_POST['delete']) && CSRF::validateToken($_POST['token'])) {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $statement = $pdo->prepare("DELETE FROM suppliers WHERE id=?");
        $statement->execute(array($id));
    }
    
    $statement = $pdo->prepare("SELECT * FROM suppliers");
    $statement->execute();
    if($statement->rowCount() > 0) {
        $suppliers = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
<div class="container">
    <div class="page-title">
        <h3>Supplier
        <a href="/admin/supplier/create" class="btn btn-sm btn-outline-primary float-end"><i class="fas fa-plus"></i> Tambah</a>
        </h3>
    </div>
    <?php if($edit): ?>
        <div class="card">
            <div class="card-header">Edit Supplier</div>
            <div class="card-body">
                <form accept-charset="utf-8" method="post" action="/admin/suppliers">
                    <?php CSRF::csrfInputField() ?>
                    <div class="row g-2">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Nama" value="<?= $suppliers[0]['name'] ?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <input type="tel" name="phone" class="form-control" placeholder="Telepon" value="<?= $suppliers[0]['phone'] ?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <input type="email" class="form-control" name="email" placeholder="Email" value="<?= $suppliers[0]['email'] ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="address" placeholder="Alamat" value="<?= $suppliers[0]['address'] ?>">
                    </div>
                    <input type="text" name="id" value="<?= $suppliers[0]['id'] ?>" hidden>
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($suppliers)): ?>
                            <?php foreach($suppliers as $supplier): ?>
                                <tr>
                                    <td><?= $supplier['name'] ?></td>
                                    <td><?= $supplier['email'] ?></td>
                                    <td><?= $supplier['phone'] ?></td>
                                    <td><?= $supplier['address'] ?></td>
                                    <td class="text-end">
                                        <form action="/admin/suppliers" method="post">
                                            <?php CSRF::csrfInputField() ?>
                                            <input type="text" name="id" value="<?= $supplier['id'] ?>" hidden>
                                            <a href="/admin/suppliers?id=<?= $supplier['id']; ?>" class="btn btn-outline-info btn-rounded"><i class="fas fa-pen"></i></a>
                                            <a href="/admin/delete-supplier?id=<?= $supplier['id']; ?>" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></a>
                                            <!-- <button name="delete" type="submit" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></button> -->
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif ?>
</div>
<?php require __DIR__ . '/footer.php'; ?>