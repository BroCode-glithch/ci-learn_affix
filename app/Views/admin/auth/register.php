<?php $this->extend('admin/layout/app') ?>

<?php $this->section('title') ?>Create Admin Account<?php $this->endSection() ?>

<?php $this->section('content') ?>

<div class="container mt-4">
    <h2>Create Admin Account</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger flash-message"><?= session()->getFlashdata('error') ?>
            <button type="button" class="close-toast" aria-label="Close">&times;</button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success flash-message"><?= session()->getFlashdata('success') ?>
            <button type="button" class="close-toast" aria-label="Close">&times;</button>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('admin/register') ?>">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirm" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirm" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Register Admin</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Auto-hide flash messages after 5 seconds
        setTimeout(function () {
            document.querySelectorAll(".flash-message").forEach(function (msg) {
                msg.style.opacity = "0";
                setTimeout(() => msg.remove(), 500);
            });
        }, 5000);

        // Close flash message when clicked on the close button
        document.querySelectorAll(".close-toast").forEach(function (btn) {
            btn.addEventListener("click", function () {
                let message = this.closest('.flash-message');
                message.style.opacity = "0";
                setTimeout(() => message.remove(), 500);
            });
        });
    });
</script>

<?php $this->endSection() ?>
