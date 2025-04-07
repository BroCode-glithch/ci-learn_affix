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
            width: 90%; /* Adjust width */
            max-width: 380px; /* Smaller max width */
            margin: auto;
            padding: 20px; /* Add padding for spacing */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); /* Keep it centered */
        }

        .logo-login {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px; /* Space between logo and heading */
        }

        .logo-login img {
            max-width: 100px; /* Adjust size as needed */
            height: auto;
        }

        @media (max-width: 768px) {
            .login-form {
                max-width: 320px; /* Slightly smaller on small screens */
            }
        }

        .toast-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
    }

    .toast {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 20px;
        min-width: 250px;
        max-width: 350px;
        background-color: #333;
        color: white;
        border-radius: 5px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        margin-bottom: 10px;
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
    }

    .toast-success {
        background-color: #28a745; /* Green */
    }

    .toast-error {
        background-color: #dc3545; /* Red */
    }

    .close-toast {
        background: none;
        border: none;
        color: white;
        font-size: 18px;
        cursor: pointer;
        margin-left: 10px;
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Auto-hide after 5 seconds
            setTimeout(function () {
                document.querySelectorAll(".toast").forEach(function (toast) {
                    toast.style.opacity = "0";
                    setTimeout(() => toast.remove(), 500);
                });
            }, 5000);

            // Close toast when clicking the button
            document.querySelectorAll(".close-toast").forEach(function (btn) {
                btn.addEventListener("click", function () {
                    let toast = this.parentElement;
                    toast.style.opacity = "0";
                    setTimeout(() => toast.remove(), 500);
                });
            });
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>
</html>
