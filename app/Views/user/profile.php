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
                                    <li class="breadcrumb-item active text-white" style="font-weight: bold;">Profile</li>
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

<!-- Profile Section -->
<section class="profile-section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="font-weight-bold">User Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <!-- Profile Image -->
                                <img src="https://via.placeholder.com/150" alt="Profile Image" class="rounded-circle img-fluid mb-3">
                                <h4 class="font-weight-bold"><?= esc($user->username) ?></h4>
                            </div>
                            <div class="col-md-8">
                                <h5 class="mb-4">Profile Information</h5>

                                <!-- Full Name -->
                                <div class="mb-3">
                                    <strong class="text-dark">Full Name:</strong>
                                    <p class="lead"><?= esc($user->username) ?></p>
                                </div>

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <strong class="text-dark">Email Address:</strong>
                                    <p class="lead"><?= esc($user->email) ?></p>
                                </div>

                                <!-- You can add more fields based on your user model -->
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center bg-light">
                        <a href="<?= base_url('user/edit') ?>" class="btn btn-primary btn-lg">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->endSection(); ?>
