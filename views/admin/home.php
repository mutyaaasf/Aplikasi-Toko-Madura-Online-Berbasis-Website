<?php 

require __DIR__ . '/header.php'; 
require __DIR__ . '/../db.php';
require __DIR__ . '/../../csrf.php';
require __DIR__ . '/util.php';

if(isset($_POST['export']) && CSRF::validateToken($_POST['token'])) {
    exportDB($host, $name, $user, $password);
}

if(isset($_POST['import']) && CSRF::validateToken($_POST['token'])) {
    importDB($pdo);
}

if(isset($_POST['send-email']) && CSRF::validateToken($_POST['token'])) {
    $title = filter_input(INPUT_POST, 'title');
    $message = filter_input(INPUT_POST, 'message');
    if($_POST['flexRadioDefault'] == 'all') {
        $emails = array();
        $statement = $pdo->prepare("SELECT * FROM users");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($results as $data) {
            $emails[] = $data['email'];
        }
        sendEmail($emails, $title, $message, $key);
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        sendEmail(array($email), $title, $message, $key);
    }
}

$dateRange = array(
    gmdate('Y-m-d') . ' 00:00:00 GMT',
    gmdate('Y-m-d') . ' 22:59:59 GMT'
);
$statement = $pdo->query("SELECT count(*) FROM transactions WHERE timestamp >= '$dateRange[0]' AND timestamp <= '$dateRange[1]'");
$orderCount = $statement->fetchColumn();
$revenue = 0;
$statement = $pdo->prepare("SELECT * FROM transactions WHERE timestamp >= ? AND timestamp <= ?");
$statement->execute($dateRange);
$transactions = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($transactions as $transaction) {
    $details = unserialize($transaction['details']);
    foreach($details as $detail) {
        $revenue += $detail['price'] * $detail['quantity'];
    }
}

$userCount = $pdo->query("SELECT count(*) FROM users")->fetchColumn();

?>
<div class="container">
    <div class="row">
        <div class="col-md-12 page-header">
            <div class="page-pretitle">Ringkasan</div>
            <h2 class="page-title">Home</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-4 mt-3">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="icon-big text-center">
                                <i class="teal fas fa-shopping-cart"></i>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="detail">
                                <p class="detail-subtitle">Pesanan</p>
                                <span class="number"><?= $orderCount ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="fas fa-calendar"></i> Hari Ini
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-4 mt-3">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="icon-big text-center">
                                <i class="olive fas fa-money-bill-alt"></i>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="detail">
                                <p class="detail-subtitle">Pendapatan</p>
                                <span class="number">Rp <?= number_format($revenue, 2) ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="fas fa-calendar"></i> Hari Ini
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-4 mt-3">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="icon-big text-center">
                                <i class="grey fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="detail">
                                <p class="detail-subtitle">Pengguna</p>
                                <span class="number"><?= $userCount ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="fas fa-calendar"></i> Semua
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="content">
                            <div class="head">
                                <h5 class="mb-0">Ringkasan Pesanan</h5>
                                <p class="text-muted">Pesanan 7 hari terakhir</p>
                            </div>
                            <div class="canvas-wrapper">
                                <canvas class="chart" id="orders"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="content">
                            <div class="head">
                                <h5 class="mb-0">Ringkasan Pendapatan</h5>
                                <p class="text-muted">Pendapatan 7 hari terakhir</p>
                            </div>
                            <div class="canvas-wrapper">
                                <canvas class="chart" id="revenue"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>