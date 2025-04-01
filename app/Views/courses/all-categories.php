<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<!-- Slider Section -->
<section class="slider-area slider-area2">
    <div class="slider-active">
        <div class="single-slider slider-height2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-11 col-md-12">
                        <div class="hero__caption hero__caption2 text-center">
                            <h1 data-animation="bounceIn" data-delay="0.2s" class="display-4 text-white">All Categories</h1>
                            <!-- Breadcrumb Section -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>" class="text-white">Home</a></li>
                                    <li class="breadcrumb-item active text-white">Categories</li>
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
<!-- Slider Section End -->

<!-- All Categories Section -->
<div class="container mt-5">
    <h1 class="text-center mb-5">Explore Our Course Categories</h1>
    
    <div class="row">
        <?php foreach ($categories as $category) : ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-lg border-light rounded overflow-hidden">
                    <img src="<?= base_url('public/assets/img/gallery/'.$category['image']); ?>" alt="<?= esc($category['category']); ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-center text-primary"><?= esc($category['category']); ?></h5>
                        <p class="card-text text-center">Explore a variety of courses in the <?= esc($category['category']); ?> category, designed to help you enhance your skills and knowledge.</p>
                        <div class="d-flex justify-content-center">
                            <a href="<?= base_url('course/' . $category['id']); ?>" class="btn btn-primary">Browse Courses</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- View More Button -->
    <!-- <div class="row justify-content-center mt-4">
        <div class="col-auto">
            <a href="<?= base_url('courses/all-categories'); ?>" class="btn btn-outline-primary btn-lg">View All Categories</a>
        </div>
    </div> -->
</div>
<!-- All Categories Section End -->

<!-- Custom Scripts for Enhanced Slider -->
<script>
    var swiper = new Swiper('.slider-active', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        effect: 'fade',
        speed: 800,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>

<?= $this->endSection(); ?>
