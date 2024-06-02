<?php

require __DIR__ . '/header.php'; 
require __DIR__ . '/db.php';
require __DIR__ . '/../csrf.php';
require __DIR__ . '/admin/util.php';

if(isset($_POST['checkout']) && CSRF::validateToken($_POST['token'])) {
  if(!isset($_SESSION['name'])) {
    header('Location: /login');
  } else {
    date_default_timezone_set('Asia/Jakarta');

    // Dapatkan timestamp dalam zona waktu lokal
    $timestamp = date('Y-m-d H:i:s');

    // Serialisasi rincian
    $details = serialize($_SESSION['cart']);

    // Persiapkan dan jalankan pernyataan SQL
    $statement = $pdo->prepare("INSERT INTO transactions (name, email, address, details, timestamp) VALUES (?, ?, ?, ?, ?)");
    $statement->execute(array($_SESSION['name'], $_SESSION['email'], $_SESSION['address'], $details, $timestamp));
    
    $_SESSION['dates'] = $timestamp;

    header('Location: /invoice');
    exit();
  }
}

?>
<?php if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0): ?>
<section class="empty-cart page-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
        	<i class="tf-ion-ios-cart-outline"></i>
          	<h2 class="text-center">Keranjangmu masih kosong.</h2>
          	<a href="/products" class="btn btn-main mt-20">Kembali ke toko</a>
      </div>
    </div>
  </div>
</section>
<?php else: ?>
<div class="page-wrapper">
  <div class="cart shopping">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="block">
            <div class="product-list">
              <form method="post">
                <?php CSRF::csrfInputField() ?>
                <table class="table">
                  <thead>
                    <tr>
                      <th class="">Nama Barang</th>
                      <th class="">Harga Barang</th>
                      <th class="">Jumlah Barang</th>
                      <th class="">Aksi</th>
                      <th class="">Sub Total</th>
                    </tr>
                  </thead>
                  <tbody>

                      <?php foreach($_SESSION['cart'] as $item): ?>
                        <tr class="">
                          <td class="">
                            <div class="product-info">
                              <img width="80" src="<?= htmlspecialchars($item['image']) ?>" alt="" />
                              <a href="#!"><?= htmlspecialchars($item['title']) ?></a>
                            </div>
                          </td>
                          <td class="">Rp<?= number_format($item['price'], 2) ?></td>
                          <!-- <td class="">   <input id="product-quantity" type="number" value=<?= htmlspecialchars($item['quantity']) ?> max="<?= $item[0]['stock'] ?>" name="quantity"></td> -->
                          <td class="">   <?= htmlspecialchars($item['quantity']) ?></td>
                          <td class="">
                            <a href="/cart-remove-item?id=<?= $item['id'] ?>" class="product-remove">Hapus</a>
                          </td>
                          <td class="total-price">Rp<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                        </tr>
                      <?php endforeach; ?>

                      <!-- <?php foreach($_SESSION['cart'] as $item): ?>
                        <tr class="">
                            <td class="">
                                <div class="product-info">
                                    <img width="80" src="<?= htmlspecialchars($item['image']) ?>" alt="" />
                                    <a href="#!"><?= htmlspecialchars($item['title']) ?></a>
                                </div>
                            </td>
                            <td class="">Rp<?= number_format($item['price'], 2) ?></td>
                            <td class="">  <input class="product-quantity" type="number" value=<?= htmlspecialchars($item['quantity']) ?> min = "1" max="<?= $item[0]['stock'] ?>" name="quantity">
                            </td>
                            <td class="">
                                <a href="/cart-remove-item?id=<?= $item['id'] ?>" class="product-remove">Hapus</a>
                            </td>
                            <td class="total-price">Rp<?= number_format($item['price'] * $item['quantity'], 2) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                         
                    <script>
                        // Mendapatkan semua elemen input jumlah produk
                        var quantityInputs = document.querySelectorAll('.product-quantity');

                        // Mendengarkan perubahan pada setiap input jumlah produk
                        quantityInputs.forEach(function(input) {
                            input.addEventListener('change', function() {
                                var quantity = parseInt(input.value);
                                var price = parseFloat(input.parentNode.previousElementSibling.textContent.replace('Rp', '').replace(',', ''));
                                var totalPriceElement = input.parentNode.nextElementSibling.nextElementSibling;
                                var totalPrice = price * quantity;
                                totalPriceElement.textContent = 'Rp' + totalPrice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                            });
                        });
                    </script> -->

                    <tr class="">
                      <td class="">
                        <div class="product-info">
                          <a href="#!">Total</a>
                        </div>
                      </td>
                      <td class=""></td>
                      <td class=""></td>
                      <td class=""></td>
                      <td class="">Rp<?php
                          if(!isset($_SESSION['cart'])) {
                            echo '0.00';
                          } else {
                            $total = 0;
                            foreach($_SESSION['cart'] as $item) {
                              $total += $item['price'] * $item['quantity'];
                            }
                            echo number_format($total, 2);
                          }
                        ?>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <form action="/cart" method="post">
                  <?php CSRF::csrfInputField() ?>
                  <button name="checkout" type="submit" class="btn btn-main pull-right">Pesan</button>
                </form>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif ?>
<?php require __DIR__ . '/footer.php'; ?>