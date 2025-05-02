<?= $this->extend('layouts/email'); ?>

<?= $this->section('title'); ?>
    Subscription Confirmed

    <?= $this->endSection(); ?>

<?= $this->section('content'); ?>

    <div class="email-container">
        <h2>Thanks for subscribing to Learn Affix!</h2>
        <p>We’re excited to have you on board. You’ll start receiving updates from us soon.</p>
        <p>If you change your mind, you can <a href="<?= base_url('newsletter/unsubscribe?email=' . urlencode($email)) ?>">unsubscribe here</a>.</p>
    </div>

<?= $this->endSection(); ?>
