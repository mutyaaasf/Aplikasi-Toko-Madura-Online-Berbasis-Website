<?php 

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

unset($_SESSION['cart']); 

require __DIR__ . '/header.php';
?>
<!-- Page Wrapper -->
<section class="page-wrapper success-msg">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
        	<i class="tf-ion-android-checkmark-circle"></i>
          <h2 class="text-center">Terimakasih sudah berbelanja dengan kami</h2>
          <a href="/products" class="btn btn-main mt-20">Lanjut Belanja</a>
        </div>
      </div>
    </div>
  </div>
</section><!-- /.page-warpper -->

<?php require __DIR__ . '/footer.php'; ?>