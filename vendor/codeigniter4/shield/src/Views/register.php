<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?><?= lang('Auth.register') ?><?= $this->endSection() ?>

<?= $this->section('main') ?>

<main class="login-body" data-vide-bg="<?= base_url('public/assets/img/login-bg.mp4') ?>">
    <!-- Registration Form -->
    <form class="form-default" action="<?= url_to('register') ?>" method="post">
        <?= csrf_field() ?> <!-- CSRF Protection -->

        <div class="login-form">
            <!-- Logo -->
            <div class="logo-login">
                <a href="<?= base_url() ?>">
                    <img src="<?= base_url('public/assets/img/logo/loder.png') ?>" alt="Logo">
                </a>
            </div>
            
            <h2>Registration Here</h2>

            <!-- Error Messages -->
            <?php if (session('error')) : ?>
                <div class="alert alert-danger"><?= esc(session('error')) ?></div>
            <?php elseif (session('errors')) : ?>
                <div class="alert alert-danger">
                    <?php foreach (session('errors') as $error) : ?>
                        <?= esc($error) ?><br>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <!-- Full Name -->
            <div class="form-input">
                <label for="name">Full Name</label>
                <input type="text" name="name" placeholder="Full Name" value="<?= old('name') ?>" required>
            </div>

            <!-- Email -->
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" value="<?= old('email') ?>" required>
            </div>

            <!-- Password -->
            <div class="form-input">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <!-- Confirm Password -->
            <div class="form-input">
                <label for="password_confirm">Confirm Password</label>
                <input type="password" name="password_confirm" placeholder="Confirm Password" required>
            </div>

            <!-- Submit Button -->
            <div class="form-input pt-30">
                <input type="submit" name="submit" value="Register">
            </div>

            <!-- Login Link -->
            <a href="<?= url_to('login') ?>" class="registration">Login</a>
        </div>
    </form>
    <!-- /End Registration Form -->
</main>

<?= $this->endSection() ?>
