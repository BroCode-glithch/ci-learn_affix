<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>


<!-- app/Views/payment_success.php -->

<h1>Payment Successful!</h1>
<p>Your payment was successful. Your reference number is: <?= esc($reference); ?></p>


<?= $this->endSection(); ?>