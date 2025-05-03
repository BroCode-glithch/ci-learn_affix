<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Learn Affix | Courses | Education</title>
    <meta name="description" content="Explore online courses and grow your skills.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/assets/img/favicon.ico') ?>">
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/slicknav.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/flaticon.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/progressbar_barfiller.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/gijgo.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/animate.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/animated-headline.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/magnific-popup.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/fontawesome-all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/slick.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/nice-select.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css'); ?>">

    <style>
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
        /* .toast[role="alert"] {
            aria-live: assertive;
        } */
        .toast-success {
            background-color: #28a745;
        }
        .toast-error {
            background-color: #dc3545;
        }
        .close-toast {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            margin-left: 10px;
        }

        .hero-btn-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: stretch; /* makes buttons full width */
            margin-top: 20px;
        }

        .hero-btn {
            text-align: center;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 6px;
        }

        .original-price {
            text-decoration: line-through;
            color: #888;
            margin-right: 8px;
            font-size: 16px;
        }

        .free-text {
            color: green;
            font-weight: bold;
            font-size: 18px;
        }

        a {
            text-decoration: none !important;
        }

        li {
            color: #fff !important;
        }
    </style>

    <!-- JS: jQuery + Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Toast Messages -->
    <div class="toast-container">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="toast toast-success" role="alert">
                <span><?= session()->getFlashdata('success'); ?></span>
                <button class="close-toast">&times;</button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="toast toast-error" role="alert">
                <span><?= session()->getFlashdata('error'); ?></span>
                <button class="close-toast">&times;</button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Preloader -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="<?= base_url('public/assets/img/logo/loder.png'); ?>" alt="Loading...">
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header>
        <div class="header-area header-transparent">
            <div class="main-header">
                <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="<?= base_url('/') ?>"><img src="<?= base_url('public/assets/img/logo/logo.png') ?>" alt="Logo"></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">
                                                <li class="active"><a href="<?= base_url('/') ?>">Home</a></li>
                                                <li><a href="<?= base_url('courses') ?>">Courses</a></li>
                                                <li><a href="<?= base_url('about') ?>">About</a></li>
                                                <li><a href="#">Blog</a>
                                                    <ul class="submenu">
                                                        <li><a href="<?= base_url('blog') ?>">Blog</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="<?= base_url('contact') ?>">Contact</a></li>
                                                <?php if (!auth()->user()) : ?>
                                                    <li class="button-header margin-left"><a href="<?= base_url('register') ?>" class="btn">Join</a></li>
                                                    <li class="button-header"><a href="<?= base_url('login') ?>" class="btn btn3">Log in</a></li>
                                                    <li class="button-header"><a href="<?= base_url('admin/login') ?>" class="btn btn3">Admin Log in</a></li>
                                                <?php else : ?>
                                                    <li><a href="#"><?= auth()->user()->username; ?></a>
                                                        <ul class="submenu">
                                                            <li><a href="<?= base_url('user/profile') ?>">Profile</a></li>
                                                            <li><a href="<?= base_url('logout') ?>">Logout</a></li>
                                                        </ul>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="app" data-aos="zoom-out">
        <?= $this->renderSection('content'); ?>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-wrappper footer-bg">
            <div class="footer-area footer-padding">
                <div class="container">
                    <div class="row justify-content-between">
                        <!-- About / Brand Area -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-8">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-logo">
                                    <a href="<?= base_url('/') ?>">
                                        <img src="<?= base_url('public/assets/img/logo/logo2_footer.png') ?>" alt="">
                                    </a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p>Start your learning journey with our curated online courses for all levels and interests.</p>
                                    </div>
                                </div>
                                <div class="footer-social">
                                    <a href="https://twitter.com/dailydewcode"><i class="fab fa-twitter"></i></a>
                                    <a href="https://github.com/BroCode-glithch"><i class="fab fa-github"></i></a>
                                    <a href="https://linkedin.com/in/dailydewcode"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://dailydewcode.dev"><i class="fas fa-globe"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Quick Links</h4>
                                    <ul>
                                        <li><a href="<?= base_url('/') ?>">Home</a></li>
                                        <li><a href="<?= base_url('courses') ?>">Courses</a></li>
                                        <li><a href="<?= base_url('about') ?>">About</a></li>
                                        <!-- <li><a href="<?= base_url('contact') ?>">Contact</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Newsletter -->
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                <h4>Newsletter</h4>
                                    <p>Subscribe to our newsletter to get the latest updates.</p>
                                    <form action="<?= base_url('subscribe') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <div class="footer-form d-flex">
                                            <input type="email" name="email" placeholder="Email Address" required class="form-control me-2">
                                            <button class="btn btn-primary"><i class="fas fa-arrow-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom-area">
                <div class="container">
                    <div class="footer-border">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-12">
                                <div class="footer-copy-right text-center">
                                    <p>
                                        &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved |
                                        <span class="footer-dev-info">
                                            Developed by <a href="<?= esc($developer['portfolio_url']) ?>" target="_blank"><?= esc($developer['brand_name']) ?></a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <div id="back-top">
        <a title="Go to Top" href="#"><i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url('public/assets/js/vendor/modernizr-3.5.0.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/vendor/jquery-1.12.4.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/popper.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.slicknav.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/owl.carousel.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/slick.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/wow.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/animated.headline.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.magnific-popup.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/gijgo.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.nice-select.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.sticky.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.barfiller.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.counterup.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/waypoints.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.countdown.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/hover-direction-snake.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/contact.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.form.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.validate.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/mail-script.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.ajaxchimp.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/plugins.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/main.js'); ?>"></script>

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,  // Animation duration in milliseconds
            easing: 'ease',  // Easing function
            once: true,      // Animation will only happen once
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function () {
                document.querySelectorAll(".toast").forEach(function (toast) {
                    toast.style.opacity = "0";
                    setTimeout(() => toast.remove(), 500);
                });
            }, 5000);

            document.querySelectorAll(".close-toast").forEach(function (btn) {
                btn.addEventListener("click", function () {
                    let toast = this.parentElement;
                    toast.style.opacity = "0";
                    setTimeout(() => toast.remove(), 500);
                });
            });
        });
    </script>

    <!-- Example Paystack Button (Add this where needed) -->
    <!-- <button id="paystack-button" class="btn btn-primary">Pay Now</button> -->

    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        const paystackButton = document.getElementById('paystack-button');
        if (paystackButton) {
            paystackButton.addEventListener('click', function () {
                const handler = PaystackPop.setup({
                    key: '<?= getenv('PAYSTACK_PUBLIC_KEY') ?>',
                    email: '<?= auth()->user()->email ?? '' ?>',
                    amount: <?= isset($course['price']) ? $course['price'] * 100 : 0; ?>,
                    currency: 'NGN',
                    ref: '<?= uniqid('course_', true); ?>',
                    callback: function (response) {
                        alert('Payment successful! Reference: ' + response.reference);
                        window.location.href = '<?= base_url('payment/payment-success'); ?>';
                    },
                    onClose: function () {
                        alert('Transaction was not completed. Please try again.');
                    }
                });
                handler.openIframe();
            });
        }
    </script>
</body>
</html>
