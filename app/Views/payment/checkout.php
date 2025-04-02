<?= $this->extend("layouts/master") ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?><?= $this->endSection() ?>

<?= $this->section('main') ?>

<main class="checkout-body" data-vide-bg="<?php echo base_url('public/assets/img/login-bg.mp4') ?>">
    <form class="form-default" id="payment-form" action="<?= base_url('payment/paystack') ?>" method="POST">
        <input type="hidden" name="course_id" value="<?= $course['id'] ?>">

        <div class="checkout-form">
            <!-- Logo -->
            <div class="logo-login">
                <a href="index.html"><img src="<?php echo base_url('public/assets/img/logo/loder.png') ?>" alt="Logo"></a>
            </div>

            <h2>Checkout</h2>

            <div class="form-input">
                <label for="name">Full Name</label>
                <input type="text" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="form-input">
                <label for="email">Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-input">
                <label for="billing_address">Billing Address</label>
                <textarea name="billing_address" placeholder="Enter your billing address" required></textarea>
            </div>

            <div class="form-input">
                <label for="payment_method">Select Payment Method</label>
                <select name="payment_method" required>
                    <option value="paystack">Paystack</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>

            <div class="form-input pt-30">
                <!-- Paystack Button -->
                <button id="paystack-button" type="submit" class="btn btn-primary w-100">Proceed to Payment</button>
            </div>

            <!-- Back to Courses -->
            <a href="<?= base_url('courses') ?>" class="registration">Back to Courses</a>
        </div>
    </form>
</main>

<style>
    /* Checkout Page Styles */
    .checkout-body {
        position: relative;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover;
        background-position: center;
        z-index: 1;
    }

    .checkout-body::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 2;
    }

    .checkout-form {
        position: relative;
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 10px;
        width: 400px;
        text-align: center;
        z-index: 3;
    }

    .checkout-form h2 {
        margin-bottom: 20px;
    }

    .form-input {
        margin-bottom: 15px;
        text-align: left;
    }

    .form-input input,
    .form-input textarea,
    .form-input select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-input textarea {
        resize: none;
        height: 80px;
    }

    .logo-login img {
        width: 80px;
        margin-bottom: 10px;
    }

    .registration {
        display: block;
        margin-top: 15px;
        color: #007bff;
        text-decoration: none;
    }
</style>

<?= $this->endSection() ?>
