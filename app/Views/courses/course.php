<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Courses<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!--? Slider Area Start -->
<section class="slider-area slider-area2">
    <div class="slider-active">
        <!-- Single Slider -->
        <div class="single-slider slider-height2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-11 col-md-12">
                        <div class="hero__caption hero__caption2">
                            <h1 data-animation="bounceIn" data-delay="0.2s">Our Courses</h1>
                            <!-- Breadcrumb Start -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Courses</li>
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

<!-- Courses Area Start -->
<div class="courses-area section-padding40 fix">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8">
                <div class="section-tittle text-center mb-55">
                    <h2>Our Featured Courses</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Loop through courses -->
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
                                        <?php 
                                            $words = explode(" ", $course['description']); 
                                            $wordLimit = 10;
                                            if (count($words) > $wordLimit) {
                                                echo esc(implode(" ", array_slice($words, 0, $wordLimit))) . '...';
                                            } else {
                                                echo esc($course['description']);
                                            }
                                        ?>
                                    </p>
                                    <div class="properties__footer d-flex justify-content-between align-items-center">
                                        <div class="restaurant-name">
                                            <div class="rating">
                                                <?php 
                                                $rating = round($course['rating'] * 2) / 2;
                                                $fullStars = floor($rating);
                                                $halfStar = ($rating - $fullStars) == 0.5;
                                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

                                                for ($i = 0; $i < $fullStars; $i++) {
                                                    echo '<i class="fas fa-star"></i>';
                                                }
                                                if ($halfStar) {
                                                    echo '<i class="fas fa-star-half-alt"></i>';
                                                }
                                                for ($i = 0; $i < $emptyStars; $i++) {
                                                    echo '<i class="far fa-star"></i>';
                                                }
                                                ?>
                                            </div>
                                            <p><span>(<?= $rating; ?>)</span> based on <?= intval($course['reviews']); ?> reviews</p>
                                        </div>
                                        <div class="price">
                                            <span>$<?= number_format($course['price'], 2); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('course/' . $course['id']); ?>" class="border-btn border-btn2">
                                    Explore Course
                                </a>                                    
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">No courses available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Courses Area End -->


<!--? Top Subjects Area Start -->
<div class="topic-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8">
                <div class="section-tittle text-center mb-55">
                    <h2>Explore Top Subjects</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php 
            $images = [
                'topic1.png', 'topic2.png', 'topic3.png', 'topic4.png',
                'topic5.png', 'topic6.png', 'topic7.png', 'topic8.png'
            ];
            $i = 0;
            ?>
            <?php foreach ($categories as $category) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-topic text-center mb-30">
                        <div class="topic-img">
                            <img src="<?= base_url('public/assets/img/gallery/' . $images[$i % count($images)]); ?>" alt="Category Image">
                            <div class="topic-content-box">
                                <div class="topic-content">
                                    <h3><a href="<?= base_url('courses/course-category/' . urlencode($category['category'])); ?>">
                                        <?= esc($category['category']); ?>
                                    </a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
            <?php endforeach; ?>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="section-tittle text-center mt-20">
                    <a href="<?= base_url('courses'); ?>" class="border-btn">View More Subjects</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Subjects End -->


<!--? Services Area Start -->
<div class="services-area services-area2 section-padding40">
    <div class="container">
        <div class="row justify-content-sm-center">
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="single-services mb-30">
                    <div class="features-icon">
                        <img src="<?= base_url('public/assets/img/icon/icon1.svg'); ?>" alt="">
                    </div>
                    <div class="features-caption">
                        <h3>60+ UX Courses</h3>
                        <p>The automated process handles all your website tasks.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="single-services mb-30">
                    <div class="features-icon">
                        <img src="<?= base_url('public/assets/img/icon/icon2.svg'); ?>" alt="">
                    </div>
                    <div class="features-caption">
                        <h3>Expert Instructors</h3>
                        <p>The automated process handles all your website tasks.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="single-services mb-30">
                    <div class="features-icon">
                        <img src="<?= base_url('public/assets/img/icon/icon3.svg'); ?>" alt="">
                    </div>
                    <div class="features-caption">
                        <h3>Lifetime Access</h3>
                        <p>The automated process handles all your website tasks.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services Area End -->

<?= $this->endSection() ?>
