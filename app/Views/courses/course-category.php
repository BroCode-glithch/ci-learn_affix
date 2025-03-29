<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?><?= esc($category_name) ?> Courses<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!--? Slider Area Start -->
<section class="slider-area slider-area2">
    <div class="slider-active">
        <?php if (!empty($courses)) : ?>
            <?php foreach ($courses as $course) : ?>
                <!-- Single Slider -->
                <div class="single-slider slider-height2 d-flex align-items-center"
                     style="background-image: url('<?= base_url('public/assets/img/gallery/' . $course['image']); ?>'); 
                            background-size: cover; background-position: center;">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="bounceIn" data-delay="0.2s">
                                        <?= esc($course['category']); ?>
                                    </h1>
                                    <p data-animation="fadeInUp" data-delay="0.4s">
                                        <?= esc($course['title']); ?>
                                    </p>
                                    <!-- Breadcrumb Start -->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                <?= esc($course['category']); ?>
                                            </li>
                                        </ol>
                                    </nav>
                                    <!-- Breadcrumb End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <!-- Fallback Slider If No Courses Exist -->
            <div class="single-slider slider-height2 d-flex align-items-center"
                 style="background-image: url('<?= base_url('public/assets/img/default-banner.jpg'); ?>'); 
                        background-size: cover; background-position: center;">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1>No Courses Found</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Courses</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- Slider Area End -->

<!-- Courses Area Start -->
<div class="courses-area section-padding40 fix">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8">
                <div class="section-tittle text-center mb-55">
                    <h2>Courses in <?= esc($category_name); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if (!empty($courses)) : ?>
                <?php foreach ($courses as $course) : ?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="properties pb-20">
                            <div class="properties__card">
                                <div class="properties__img overlay1">
                                    <a href="<?= base_url('course/' . $course['id']); ?>">
                                        <img src="<?= base_url('public/assets/img/gallery/' . $course['image']); ?>" 
                                            alt="<?= esc($course['title']); ?>">
                                    </a>
                                </div>
                                <div class="properties__caption">
                                    <p><?= esc($course['category']); ?></p>
                                    <h3><a href="<?= base_url('course/' . $course['id']); ?>"><?= esc($course['title']); ?></a></h3>
                                    <p>
                                        <?= word_limiter(esc($course['description']), 10, '...'); ?>
                                    </p>
                                    <a href="<?= base_url('course/' . $course['id']); ?>" class="border-btn border-btn2">
                                        Explore Course
                                    </a>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">No courses available in this category.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Courses Area End -->

<!-- Include Slick.js -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css"/>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>

<script>
    $(document).ready(function(){
        $('.slider-active').slick({
            autoplay: true,
            autoplaySpeed: 2000, // Faster: Changes every 2 seconds
            arrows: false,
            fade: true,
            dots: false,
            speed: 300, // Faster transition effect (300ms)
            pauseOnHover: false,
            cssEase: 'linear' // Ensures smooth transitions
        });
    });
</script>



<?= $this->endSection() ?>
