<?= $this->extend('admin/layout/app'); ?>

<?php $this->section('title') ?>Register Admin Account<?php $this->endSection() ?>

<?php $this->section('content'); ?>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg rounded-4 p-4" style="width: 100%; max-width: 450px;">
        <div class="text-center mb-4">
            <img src="<?= base_url('public/assets/img/logo.png') ?>" alt="Logo" class="mb-3" style="max-width: 100px;">
            <h3 class="fw-bold">Admin Register</h3>
            <p class="text-muted small">Create your admin account</p>
        </div>

        <!-- Flash Messages -->
        <?php if (session('error')): ?>
            <div class="alert alert-danger"><?= session('error') ?></div>
        <?php endif; ?>
        <?php if (session('success')): ?>
            <div class="alert alert-success"><?= session('success') ?></div>
        <?php endif; ?>

        <form action="<?= site_url('admin/register') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" name="first_name" value="<?= old('first_name') ?>" class="form-control" placeholder="First Name" required>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" name="last_name" value="<?= old('last_name') ?>" class="form-control" placeholder="Last Name" required>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" value="<?= old('email') ?>" class="form-control" placeholder="Email Address" required>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password_confirm" class="form-control" placeholder="Confirm Password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <div class="text-center mt-3">
            <a href="<?= site_url('admin/login') ?>">Already have an account? Login</a>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
