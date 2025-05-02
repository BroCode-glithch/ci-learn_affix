
text/x-generic under_development.php ( HTML document, UTF-8 Unicode text, with CRLF line terminators )
<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Development Page<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Slider Area Start -->
    <section class="slider-area slider-area2">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s">Page Under Development</h1>
                                <!-- Breadcrumb Start -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Development</li>
                                    </ol>
                                </nav>
                                <!-- Breadcrumb End -->
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
        </div>
    </section>

    <!-- Development Page Content -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="under-development-box">
                    <h2 class="display-4">This Page is Under Development</h2>
                    <p class="lead">We are currently working on this page to bring you something amazing. Please check back later!</p>
                    <div class="mt-4">
                        <a href="<?= base_url(); ?>" class="btn btn-primary">Go to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional Footer/Section -->
    <section class="footer-area">
        <div class="container text-center">
            <p class="mt-3">Thank you for your patience. We’re working hard to launch new content. Stay tuned!</p>
        </div>
    </section>

<?= $this->endSection() ?>