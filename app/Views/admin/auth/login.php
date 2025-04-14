<?= $this->extend('admin/layout/app'); ?>

<?php $this->section('title') ?>Login Admin Account<?php $this->endSection() ?>

<?php $this->section('content'); ?>


<div class="container mt-5" style="max-width: 500px;">
    <h3 class="mb-4">Admin Login</h3>

        <!-- Display Flash Messages -->
    <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('admin/login') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" value="<?= old('email') ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>

<?php $this->endSection(); ?>
