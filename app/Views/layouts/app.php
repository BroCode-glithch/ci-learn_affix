<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Learn Affix | Courses | Education</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/assets/img/favicon.ico') ?>">

    <!-- CSS here -->
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

    <!-- Bootstrap JavaScript (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- STRIPE -->
    <!-- <script src="https://js.stripe.com/v3/"></script> -->


   
</head>

<body>
    <!-- Flash Message Container -->
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
    </div>

    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="<?= base_url('public/assets/img/logo/loder.png'); ?>" alt="Loader...">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="<?php echo base_url('/') ?>"><img src="<?php echo base_url('public/assets/img/logo/logo.png') ?>" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">                                                                                          
                                                <li class="active" ><a href="<?php echo base_url('/'); ?>">Home</a></li>
                                                <li><a href="<?= base_url('courses') ?>">Courses</a></li>
                                                <li><a href="<?= base_url('about') ?>">About</a></li>
                                                <li><a href="#">Blog</a>
                                                    <ul class="submenu">
                                                        <li><a href="blog.html">Blog</a></li>
                                                        <li><a href="blog_details.html">Blog Details</a></li>
                                                        <li><a href="elements.html">Element</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="contact.html">Contact</a></li>
                                                <!-- Button -->
                                            <?php if (!isset(auth()->user()->username)): ?>
                                                <li class="button-header margin-left "><a href="<?php echo base_url('register') ?>" class="btn">Join</a></li>
                                                <li class="button-header"><a href="<?php echo base_url('login') ?>" class="btn btn3">Log in</a></li>
                                            <?php else: ?>
                                                <li><a href="#">
                                                    <?php echo auth()->user()->username; ?>
                                                </a>
                                                    <ul class="submenu">
                                                        <!-- <li><a href="blog.html">Profile</a></li>
                                                        <li><a href="blog_details.html">Account</a></li> -->
                                                        <li><a href="<?php echo base_url('logout') ?>">Logout</a></li>
                                                    </ul>
                                                </li>
                                            <?php endif; ?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div> 
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>

        <div class="app">
            <?= $this->renderSection('content'); ?>
        </div>

        <footer>
     <div class="footer-wrappper footer-bg">
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-4 col-lg-5 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <!-- logo -->
                                <div class="footer-logo mb-25">
                                    <a href="index.html"><img src="<?= base_url('public/assets/img/logo/logo2_footer.png'); ?>" alt=""></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p>The automated process starts as soon as your clothes go into the machine.</p>
                                    </div>
                                </div>
                                <!-- social -->
                                <div class="footer-social">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="https://bit.ly/sai4ull"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Our solutions</h4>
                                <ul>
                                    <li><a href="#">Design & creatives</a></li>
                                    <li><a href="#">Telecommunication</a></li>
                                    <li><a href="#">Restaurant</a></li>
                                    <li><a href="#">Programing</a></li>
                                    <li><a href="#">Architecture</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Support</h4>
                                <ul>
                                    <li><a href="#">Design & creatives</a></li>
                                    <li><a href="#">Telecommunication</a></li>
                                    <li><a href="#">Restaurant</a></li>
                                    <li><a href="#">Programing</a></li>
                                    <li><a href="#">Architecture</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Company</h4>
                                <ul>
                                    <li><a href="#">Design & creatives</a></li>
                                    <li><a href="#">Telecommunication</a></li>
                                    <li><a href="#">Restaurant</a></li>
                                    <li><a href="#">Programing</a></li>
                                    <li><a href="#">Architecture</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-12 ">
                            <div class="footer-copy-right text-center">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Footer End-->
    </div>
        </footer> 
        <!-- Scroll Up -->
        <div id="back-top" >
            <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
        </div>

        <!-- JS here -->
        <script src="<?= base_url('public/assets/js/vendor/modernizr-3.5.0.min.js'); ?>"></script>
        <!-- Jquery, Popper, Bootstrap -->
        <script src="<?= base_url('public/assets/js/vendor/jquery-1.12.4.min.js'); ?>"></script>
        <script src="<?= base_url('public/assets/js/popper.min.js'); ?>"></script>
        <script src="<?= base_url('public/assets/js/bootstrap.min.js'); ?>"></script>
        <!-- Jquery Mobile Menu -->
        <script src="<?= base_url('public/assets/js/jquery.slicknav.min.js'); ?>"></script>

        <!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="<?= base_url('public/assets/js/owl.carousel.min.js'); ?>"></script>
        <script src="<?= base_url('public/assets/js/slick.min.js'); ?>"></script>
        <!-- One Page, Animated-HeadLin -->
        <script src="<?= base_url('public/assets/js/wow.min.js'); ?>"></script>
        <script src="<?= base_url('public/assets/js/animated.headline.js'); ?>"></script>
        <script src="<?= base_url('public/assets/js/jquery.magnific-popup.js'); ?>"></script>

        <!-- Date Picker -->
        <script src="<?= base_url('public/assets/js/gijgo.min.js'); ?>"></script>
        <!-- Nice-select, sticky -->
        <script src="<?= base_url('public/assets/js/jquery.nice-select.min.js'); ?>"></script>
        <script src="<?= base_url('public/assets/js/jquery.sticky.js'); ?>"></script>
        <!-- Progress -->
        <script src="<?= base_url('public/assets/js/jquery.barfiller.js'); ?>"></script>

        <!-- counter , waypoint,Hover Direction -->
        <script src="<?= base_url('public/assets/js/jquery.counterup.min.js'); ?>"></script>
        <script src="<?= base_url('public/assets/js/waypoints.min.js'); ?>"></script>
        <script src="<?= base_url('public/assets/js/jquery.countdown.min.js'); ?>"></script>
        <script src="<?= base_url('public/assets/js/hover-direction-snake.min.js'); ?>"></script>

        <!-- contact js -->
        <script src="<?= base_url('public/assets/js/contact.js'); ?>"></script>
        <script src="<?= base_url('public/assets/js/jquery.form.js'); ?>"></script>
        <script src="<?= base_url('public/assets/js/jquery.validate.min.js'); ?>"></script>
        <script src="<?= base_url('public/assets/js/mail-script.js'); ?>"></script>
        <script src="<?= base_url('public/assets/js/jquery.ajaxchimp.min.js'); ?>"></script>

        <!-- Jquery Plugins, main Jquery -->	
        <script src="<?= base_url('public/assets/js/plugins.js'); ?>"></script>
        <script src="<?= base_url('public/assets/js/main.js'); ?>"></script>
        
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


<!-- <script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    var paystackButton = document.getElementById('paystack-button');

    paystackButton.addEventListener('click', function() {
        var handler = PaystackPop.setup({
            key: '<?= getenv('PAYSTACK_PUBLIC_KEY') ?>', // Replace with your public key from Paystack dashboard
            email: '<?= isset(auth()->user()->email); ?>', // Replace with user's email
            amount: <?= isset($course['price']) ? $course['price'] * 100 : 0; ?>, // Amount in kobo (Paystack uses kobo, 100 kobo = 1 Naira)
            currency: 'NGN', // Currency (in this case, Naira)
            ref: '<?= uniqid('course_', true); ?>', // Generate a unique reference for the transaction
            callback: function(response) {
                // Handle the response when payment is successful
                alert('Payment successful! Reference: ' + response.reference);
                window.location.href = '<?= base_url('payment/payment-success'); ?>'; // Redirect to success page
            },
            onClose: function() {
                alert('Transaction was not completed. Please try again.');
            }
        });

        handler.openIframe(); // Open the Paystack iframe for payment
    });
</script> -->

<!-- Include Paystack JS -->
<script src="https://js.paystack.co/v1/inline.js"></script>

<!-- Payment Button -->
// <button id="paystack-button">Proceed to Payment</button>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paystackButton = document.getElementById('paystack-button');
        
        if (!paystackButton) {
            console.error('Paystack button not found.');
            return;
        }

        paystackButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Ensure the courseId input exists and has a value
            const courseIdInput = document.querySelector('input[name="course_id"]');
            if (!courseIdInput || !courseIdInput.value) {
                alert('Course ID is missing or invalid.');
                return;
            }

            const courseId = courseIdInput.value;

            fetch('<?= base_url('/payment/paystack') ?>', {
                method: 'POST',
                body: new URLSearchParams({
                    course_id: courseId
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to initiate payment, server responded with an error.');
                }
                return response.json();
            })
            .then(data => {
                if (data.status) {
                    // Redirect to Paystack for payment
                    window.location.href = data.authorization_url; 
                } else {
                    // If there was an issue, show an alert with the error message
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing your payment. Please try again.');
            });
        });
    });
</script>


    </body>
</html>