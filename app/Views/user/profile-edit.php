<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>

<!-- Slider Section -->
<section class="slider-area slider-area2 bg-dark text-white">
    <div class="slider-active">
        <div class="single-slider slider-height2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-11 col-md-12">
                        <div class="hero__caption hero__caption2">
                            <h1 class="display-4 font-weight-bold" data-animation="bounceIn" data-delay="0.2s">My Profile</h1>
                            <!-- Breadcrumb Section -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb bg-transparent">
                                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>" class="text-white">Home</a></li>
                                    <li class="breadcrumb-item active text-white" style="font-weight: bold;">Edit Profile</li>
                                </ol>
                            </nav>
                            <!-- End Breadcrumb -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Profile Edit Section -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Edit Your Profile</h3>
                </div>
                <div class="card-body">
                    <!-- Displaying Error Messages -->
                    <?php if (session('error')) : ?>
                        <div class="alert alert-danger"><?= esc(session('error')) ?></div>
                    <?php elseif (session('errors')) : ?>
                        <div class="alert alert-danger">
                            <?php foreach (session('errors') as $error) : ?>
                                <?= esc($error) ?><br>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>

                    <!-- Profile Edit Form -->
                    <form method="post" action="<?= base_url('user/edit') ?>">
                        <?= csrf_field() ?>

                        <!-- Username Input -->
                        <div class="form-input mb-3">
                            <label for="username" class="font-weight-bold">Username</label>
                            <input type="text" name="username" placeholder="Username" 
                                value="<?= old('username', $user->username ?? '') ?>" 
                                required class="form-control">
                        </div>

                        <!-- Email Input -->
                        <div class="form-input mb-3">
                            <label for="email" class="font-weight-bold">Email Address</label>
                            <input type="email" name="email" placeholder="Email" 
                                   value="<?= old('email', $user->email ?? '') ?>" 
                                   required class="form-control">
                        </div>

                        <!-- Submit Button -->
                        <div class="form-input pt-30">
                            <input type="submit" name="submit" value="Update Profile" class="btn btn-primary btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
