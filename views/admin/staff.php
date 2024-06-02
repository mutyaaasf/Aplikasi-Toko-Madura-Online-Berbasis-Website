<?php 

require __DIR__ . '/header.php';
require __DIR__ . '/../db.php';
require __DIR__ . '/../../csrf.php';

$staff;
$edit = false;

if(isset($_POST['submit']) && CSRF::validateToken($_POST['token'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    if(isset($_POST['name'])) {
        $statement = $pdo->prepare("UPDATE staff SET name=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'name'), $id));
    }
    if(isset($_POST['position'])) {
        $statement = $pdo->prepare("UPDATE staff SET position=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'position'), $id));
    }
    if(isset($_POST['phone'])) {
        $statement = $pdo->prepare("UPDATE staff SET phone=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'phone'), $id));
    }
    if(isset($_POST['email'])) {
        $statement = $pdo->prepare("UPDATE staff SET email=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL), $id));
    }
    if(isset($_POST['address'])) {
        $statement = $pdo->prepare("UPDATE staff SET address=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'address'), $id));
    }
}

if(isset($_GET['id'])) {
    $edit = true;
    $statement = $pdo->prepare("SELECT * FROM staff WHERE id=?");
    $statement->execute(array(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
    if($statement->rowCount() > 0) {
        $staff = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}else{
    $statement = $pdo->prepare("SELECT * FROM staff");
    $statement->execute();
    if($statement->rowCount() > 0) {
        $staff = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>
<div class="container">
    <div class="page-title">
        <h3>Staff
        <a href="/admin/staff/create" class="btn btn-sm btn-outline-primary float-end"><i class="fas fa-plus"></i> Tambah</a>
        </h3>
    </div>
    <?php if($edit): ?>
        <div class="card">
            <div class="card-header">Edit staff</div>
            <div class="card-body">
                <form accept-charset="utf-8" method="post" action="/admin/staff">
                    <?php CSRF::csrfInputField() ?>
                    <div class="row g-2">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Nama" value="<?= $staff[0]['name'] ?>">
                        </div>
                        <div class="mb-3 col-md-4">
                            <input type="text" name="position" class="form-control" placeholder="Jabatan" value="<?= $staff[0]['position'] ?>">
                        </div>
                        <div class="mb-3 col-md-4">
                            <input type="text" name="phone" class="form-control" placeholder="Telepon" value="<?= $staff[0]['phone'] ?>">
                        </div>
                        <div class="mb-3 col-md-4">
                            <input type="text" class="form-control" name="email" placeholder="Email" value="<?= $staff[0]['email'] ?>">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="address" placeholder="Alamat" value="<?= $staff[0]['address'] ?>">
                        </div>
                    </div>
                    <input type="text" name="id" value="<?= $staff[0]['id'] ?>" hidden>
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
                            <th>Jabatan</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($staff)): ?>
                            <?php foreach ($staff as $staffs): ?>
                                <tr>
                                    <td><?= $staffs['name'] ?></td>
                                    <td><?= $staffs['position'] ?></td>
                                    <td><?= $staffs['phone'] ?></td>
                                    <td><?= $staffs['email'] ?></td>
                                    <td><?= $staffs['address'] ?></td>
                                    <td class="text-end">
                                        <form action="/admin/staff" method="post">
                                            <?php CSRF::csrfInputField() ?>
                                            <input type="text" name="id" value="<?= $staffs['id'] ?>" hidden>
                                            <a href="/admin/staff?id=<?= $staffs['id']; ?>" class="btn btn-outline-info btn-rounded"><i class="fas fa-pen"></i></a>
                                            <a href="/admin/delete-staff?id=<?= $staffs['id']; ?>" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></a>
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