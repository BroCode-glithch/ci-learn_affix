<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<!-- Slider Area Start -->
<section class="slider-area slider-area2">
    <div class="slider-active">
        <div class="slider-wrapper">
            <?php foreach ($courses as $course) : ?>
                <div class="single-slider slider-height2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2 text-center">
                                    <h1>All Categories</h1>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <div class="slider-img">
                        <img src="<?= base_url('public/assets/img/courses/'.$course['image']); ?>" alt="Course Image">
                    </div>       
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Slider Area End -->

<!-- All Categories Section -->
<div class="container mt-5">
    <h2 class="text-center mb-4">All Course Categories</h2>
    <div class="row">
        <?php foreach ($categories as $category) : ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="single-topic text-center mb-30">
                    <div class="topic-img">
                        <img src="<?= base_url('public/assets/img/gallery/'.$category['image']); ?>" alt="<?= esc($category['category']); ?>">
                        <div class="topic-content-box">
                            <div class="topic-content">
                                <h3>
                                    <a href="<?= base_url('courses/course-category/' . urlencode($category['category'])); ?>">
                                        <?= esc($category['category']); ?>
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    var swiper = new Swiper('.slider-active', {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        effect: 'fade',
        speed: 800,
    });
</script>


<?= $this->endSection(); ?>

