<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<!-- app/Views/payment_failed.php -->

<h1>Payment Failed!</h1>
<p>There was an issue with your payment. Please try again later. Reference: <?= esc($reference); ?></p>


<?= $this->endSection(); ?>