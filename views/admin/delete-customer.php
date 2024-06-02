<?php 

require __DIR__ . '/header.php'; 
require __DIR__ . '/../db.php';
require __DIR__ . '/../../csrf.php';
require __DIR__ . '/util.php';

if(isset($_GET['id'])) {
        $statement = $pdo->prepare("DELETE FROM users WHERE id=" . $_GET['id']);
        $statement->execute();
    }
    header('Location: /admin/customers');
?>