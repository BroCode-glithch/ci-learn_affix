<?= $this->extend("layouts/master") ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?><?= $this->endSection() ?>

<?= $this->section('main') ?>

<main class="login-body" data-vide-bg="<?= base_url('public/assets/img/login-bg.mp4') ?>">
    <!-- Login Admin -->
    <form class="form-default" action="<?= url_to('login') ?>" method="POST">
        <?= csrf_field() ?> <!-- CSRF Protection -->

        <div class="login-form">
            <!-- Logo -->
            <div class="logo-login">
                <a href="<?= base_url() ?>"><img src="<?= base_url('public/assets/img/logo/loder.png') ?>" alt="Logo"></a>
            </div>
            
            <h2>Login Here</h2>

            <!-- Session Messages -->
            <!-- Custom Flash Message Container using Toast -->
            <div class="toast-container">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="toast toast-success">
                        <span><?= session()->getFlashdata('success'); ?></span>
                        <button class="close-toast">&times;</button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="toast toast-error">
                        <span><?= session()->getFlashdata('error'); ?></span>
                        <button class="close-toast">&times;</button>
                    </div>
                <?php endif; ?>

                <?php if (session('message')) : ?>
                    <div class="alert alert-success"><?= esc(session('message')) ?></div>
                <?php endif ?>
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

            <!-- Remember Me -->
            <?php if (setting('Auth.sessionConfig')['allowRemembering']) : ?>
                <div class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input" <?= old('remember') ? 'checked' : '' ?>>
                    <label class="form-check-label" style="color: white !important;"><?= lang('Auth.rememberMe') ?></label>
                </div>
            <?php endif; ?>

            <!-- Submit Button -->
            <div class="form-input pt-30">
                <input type="submit" name="submit" value="Login">
            </div>

            <!-- Forgot Password -->
            <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                <a href="<?= url_to('magic-link') ?>" class="forget"><?= lang('Auth.forgotPassword') ?></a>
            <?php endif ?>

            <!-- Registration Link -->
            <?php if (setting('Auth.allowRegistration')) : ?>
                <a href="<?= url_to('register') ?>" class="registration">Registration</a>
            <?php endif ?>
        </div>
    </form>
    <!-- /End Login Form -->
</main>

<?= $this->endSection() ?>
