<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Courses<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
function word_limiter_custom($text, $limit = 25, $end = '...')
{
    $words = explode(' ', $text);
    return count($words) > $limit ? implode(' ', array_slice($words, 0, $limit)) . $end : $text;
}
?>

<!-- Course Slider Start -->
<section class="slider-area">
    <div class="slider-active">
        <!-- Single Slider -->
        <div class="single-slider slider-height d-flex align-items-center" 
            style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
            url('<?= base_url("public/assets/img/gallery/" . $course["image"]); ?>') center/cover no-repeat;">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 col-md-12">
                        <div class="hero__caption text-white">
                            <h1 data-animation="fadeInLeft" data-delay="0.2s">
                                <?= htmlspecialchars($course['title']); ?>
                            </h1>
                            <p data-animation="fadeInLeft" data-delay="0.4s">
                                <?= word_limiter_custom(htmlspecialchars($course['description']), 25, '...'); ?>
                            </p>
                            <a href="#course-details" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.7s">
                                View Course Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>          
        </div>
    </div>
</section>
<!-- Course Slider End -->

<!-- Breadcrumb Start -->
<div class="breadcrumb-area" style="background: url('<?= base_url("public/assets/img/gallery/" . $course["image"]); ?>') center/cover no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-text text-center text-white" style="background: rgba(0, 0, 0, 0.5); padding: 20px; border-radius: 5px;">
                    <h2 style="color: #fff !important"><?= htmlspecialchars($course['title']); ?></h2>
                    <p style="color: #fff !important"><a href="<?= base_url(); ?>">Home</a> / Course Details</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Course Details Start -->
<div class="course-details-area section-padding40 fix">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="course-details-content">
                    <div class="course-thumb">
                        <img src="<?= base_url('public/assets/img/gallery/' . $course['image']); ?>" 
                            alt="<?= htmlspecialchars($course['title']); ?> image" class="img-fluid">
                    </div>
                    <div class="course-info mt-4">
                        <h2><?= htmlspecialchars($course['title']); ?></h2>
                        <p class="category"><strong>Category:</strong> <?= htmlspecialchars($course['category']); ?></p>
                        <p><?= nl2br(htmlspecialchars($course['description'])); ?></p>
                    </div>

                    <!-- Rating -->
                    <div class="course-rating">
                        <p><strong>Rating:</strong> <?= number_format($course['rating'], 1); ?> / 5</p>
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
                    </div>

                    <!-- Price -->
                    <div class="course-price mt-3">
                        <h3>Price: <span class="text-primary">$<?= number_format($course['price'], 2); ?></span></h3>
                    </div>

                    <!-- Enroll Button -->
                    <a href="#" class="btn btn-primary mt-4">Enroll Now</a>
                </div>
            </div>

            <!-- Sidebar -->
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <h3>Other Courses</h3>
                    <?php if (!empty($other_courses)) : ?>
                        <ul>
                            <?php foreach ($other_courses as $c) : ?>
                                <li>
                                    <a href="<?= base_url('course/' . $c['id']); ?>">
                                        <?= htmlspecialchars($c['title']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p>No other courses available.</p>
                    <?php endif; ?>
                </div>
            </div>            
        </div>
    </div>
</div>
<!-- Course Details End -->

<?= $this->endSection() ?>
