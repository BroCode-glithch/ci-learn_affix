<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $this->renderSection('title') ?> - App Landing</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="manifest" href="<?= base_url('site.webmanifest') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/assets/img/favicon.ico') ?>">

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/slicknav.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/flaticon.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/progressbar_barfiller.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/gijgo.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/animate.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/animated-headline.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/magnific-popup.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/fontawesome-all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/slick.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/nice-select.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">

    <style>
        .login-form {
            width: 90%; /* Adjust to fit screen */
            max-width: 400px; /* Keeps it readable */
            margin: auto;
            transform: scale(0.9); /* Scale down slightly */
        }

        @media (max-width: 768px) {
            .login-form {
                transform: scale(0.85); /* Scale down further on small screens */
            }
        }
    </style>

    <?= $this->renderSection('styles') ?>
</head>
<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="<?= base_url('public/assets/img/logo/loder.png') ?>" alt="Loader">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Page Content -->
    <main>
        <?= $this->renderSection('main') ?>
    </main>

    <!-- JavaScript -->
    <script src="<?= base_url('public/assets/js/vendor/modernizr-3.5.0.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/vendor/jquery-1.12.4.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.slicknav.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.vide.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/owl.carousel.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/slick.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/wow.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/animated.headline.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.magnific-popup.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/gijgo.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.nice-select.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.sticky.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.barfiller.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.counterup.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/waypoints.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.countdown.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/hover-direction-snake.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/contact.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.form.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/mail-script.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.ajaxchimp.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/plugins.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/main.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>
</body>
</html>
