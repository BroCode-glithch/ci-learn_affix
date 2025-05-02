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
            <?php if (!empty($courses_data)) : ?>
                <?php foreach ($courses_data as $course) : ?>
                    <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-right" data-aos-delay="400">
                        <div class="properties pb-20">
                            <div class="properties__card">
                                <!-- Course Preview Image or Video Thumbnail -->
                                <div class="properties__img overlay1">
                                    <?php 
                                        $thumbnail = $course['image'];
                                    ?>
                                    <a href="<?php echo !empty($course['affiliate_url']) ? $course['affiliate_url'] : '#'; ?>" target="_blank">
                                        <img src="<?php echo $thumbnail; ?>" alt="<?php echo htmlspecialchars($course['title']); ?>">
                                    </a>
                                </div>

                                <!-- Course Content -->
                                <div class="properties__caption">
                                    <p><?php echo htmlspecialchars($course['category']); ?></p>
                                    <h3>
                                        <a href="<?= base_url('course/' . $course['id']); ?>">
                                            <?php echo htmlspecialchars($course['title']); ?>
                                        </a>
                                    </h3>
                                    <p>
                                        <?php 
                                            $words = explode(" ", $course['description']); 
                                            $wordLimit = 10;
                                            echo htmlspecialchars(implode(" ", array_slice($words, 0, $wordLimit))) . (count($words) > $wordLimit ? '...' : '');
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

                                                    for ($i = 0; $i < $fullStars; $i++) echo '<i class="fas fa-star"></i>';
                                                    if ($halfStar) echo '<i class="fas fa-star-half-alt"></i>';
                                                    for ($i = 0; $i < $emptyStars; $i++) echo '<i class="far fa-star"></i>';
                                                ?>
                                            </div>
                                            <p><span>(<?php echo $rating; ?>)</span> based on <?php echo intval($course['reviews']); ?> reviews</p>
                                        </div>

                                        <!-- Price -->
                                        <div class="price">
                                            <?php if ($course['price'] > 0) : ?>
                                                <span class="original-price">$<?php echo number_format($course['price'], 2); ?></span>
                                                <span class="free-text">FREE</span>
                                            <?php else : ?>
                                                <span class="free-text">FREE</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Affiliate Link Button -->
                                <?php if (auth()->loggedIn()) : ?>
                                    <?php if (isUnlocked($course['id'], $unlocked_courses)) : ?>
                                        <?php if (!empty($course['affiliate_url'])) : ?>
                                            <a href="<?= esc($course['affiliate_url']) ?>" target="_blank" class="border-btn border-btn2">Go to Course</a>
                                        <?php else : ?>
                                            <a href="<?= base_url('course/' . $course['id']) ?>" class="border-btn border-btn2">Go to Course</a>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <a href="<?= base_url('unlock/' . $course['id']) ?>" class="border-btn border-btn2">Unlock Course</a>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <a href="<?= base_url('login') ?>" class="border-btn border-btn2">Log in to Unlock</a>
                                <?php endif; ?>
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

<?= $this->endSection() ?>
