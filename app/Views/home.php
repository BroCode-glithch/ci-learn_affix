<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Courses<?= $this->endSection() ?>

<?= $this->section('content') ?>

        <section class="slider-area" data-aos="fade-in" data-aos-delay="200">
                    <div class="slider-active">
                        <!-- Single Slider -->
                        <div class="single-slider slider-height d-flex align-items-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-7 col-md-12">
                                        <div class="hero__caption">
                                            <h1 data-animation="fadeInLeft" data-delay="0.2s">Online learning<br> platform</h1>
                                            <p data-animation="fadeInLeft" data-delay="0.4s">Build skills with courses, certificates, and degrees online from world-class universities and companies</p>
                                            <div class="hero-btn-group">
                                                <?php if(isset(auth()->user()->username)) : ?> 
                                                    <a href="<?= base_url('courses') ?>" class="btn hero-btn">Join for Free</a>
                                                <?php else : ?>
                                                    <a href="<?= base_url('register') ?>" class="btn hero-btn">Sign Up for Free</a>
                                                    <a href="<?= base_url('login') ?>" class="btn hero-btn">Log In for Free</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>          
                        </div>
                    </div>
        </section>
        <!-- ? services-area -->
        <div class="services-area" data-aos="fade-left" data-aos-delay="200">
            <div class="container">
                <div class="row justify-content-sm-center">
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30">
                            <div class="features-icon">
                                <img src="assets/img/icon/icon1.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>60+ UX courses</h3>
                                <p>The automated process all your website tasks.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30">
                            <div class="features-icon">
                                <img src="assets/img/icon/icon2.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>Expert instructors</h3>
                                <p>The automated process all your website tasks.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30">
                            <div class="features-icon">
                                <img src="assets/img/icon/icon3.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>Life time access</h3>
                                <p>The automated process all your website tasks.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
           
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
                                            <h3><a href="<?= base_url('course/' . $course['id']); ?>"><?php echo htmlspecialchars($course['title']); ?></a></h3>
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
                                        <a href="<?php echo !empty($course['affiliate_url']) ? $course['affiliate_url'] : '#'; ?>" class="border-btn border-btn2" target="_blank">
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
                <!-- View More Courses Button -->
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="section-tittle text-center mt-20">
                            <a href="<?= base_url('courses'); ?>" class="border-btn">View More Courses</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Courses Area End -->

<!-- Top Subjects Area Start -->
<!-- <div class="topic-area"> -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8">
                <div class="section-tittle text-center mb-55">
                    <h2>Explore Top Subjects</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if (!empty($categories)) : ?>
                <?php foreach ($categories as $category) : ?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="<?= esc(!empty($category['category_image']) ? $category['category_image'] : base_url('path/to/default-image.jpg')); ?>" 
                                    alt="<?= esc($category['category']); ?>" 
                                    class="card-img-top" 
                                    style="height: 200px; object-fit: cover;">
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
            <?php else : ?>
                <p class="text-center">No categories available.</p>
            <?php endif; ?>
        </div>
    
        <!-- View More Subjects Button -->
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="section-tittle text-center mt-20">
                    <a href="<?= base_url('courses/all-categories'); ?>" class="border-btn">View More Subjects</a>
                </div>
            </div>
        </div>
    
    </div>
<!-- </div> -->
<!-- Top Subjects End -->

        
        <!--? About Area-3 Start -->
        <section class="about-area3 fix">
            <div class="support-wrapper align-items-center">
                <div class="right-content3">
                    <!-- img -->
                    <div class="right-img">
                        <img src="<?php echo base_url('public/assets/img/gallery/about3.png'); ?>" alt="">
                    </div>
                </div>
                <div class="left-content3">
                    <!-- section tittle -->
                    <div class="section-tittle section-tittle2 mb-20">
                        <div class="front-text">
                            <h2 class="">Learner outcomes on courses you will take</h2>
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="features-icon">
                            <img src="<?php echo base_url('public/assets/img/icon/right-icon.svg'); ?>" alt="">
                        </div>
                        <div class="features-caption">
                            <p>Techniques to engage effectively with vulnerable children and young people.</p>
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="features-icon">
                            <img src="<?php echo base_url('public/assets/img/icon/right-icon.svg'); ?>" alt="">
                        </div>
                        <div class="features-caption">
                            <p>Join millions of people from around the world
                            learning together.</p>
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="features-icon">
                            <img src="<?php echo base_url('public/assets/img/icon/right-icon.svg'); ?>" alt="">
                        </div>
                        <div class="features-caption">
                            <p>Join millions of people from around the world learning together.
                            Online learning is as easy and natural.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Area End -->
        <!--? Team -->
        <section class="team-area section-padding40 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Community experts</h2>
                        </div>
                    </div>
                </div>
        
                <div class="team-active">
                    <?php if (!empty($teams)) : ?>
                        <?php foreach ($teams as $team) : ?>
                            <div class="single-cat text-center">
                                <div class="cat-icon">
                                    <img src="<?= base_url('public/assets/img/gallery/' . esc($team['image'])) ?>" alt="<?= esc($team['name']) ?>">
                                </div>
                                <div class="cat-cap">
                                    <h5><a href="#"><?= esc($team['name']) ?></a></h5>
                                    <p><?= esc($team['bio']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="text-center">No team members found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        
        <!-- Services End -->
        <!--? About Area-2 Start -->
        <section class="about-area2 fix pb-padding">
            <div class="support-wrapper align-items-center">
                <div class="right-content2">
                    <!-- img -->
                    <div class="right-img">
                        <img src="<?php echo base_url('public/assets/img/gallery/about2.png'); ?>" alt="">
                    </div>
                </div>
                <div class="left-content2">
                    <!-- section tittle -->
                    <div class="section-tittle section-tittle2 mb-20">
                        <div class="front-text">
                            <h2 class="">Take the next step
                                toward your personal
                                and professional goals
                            with us.</h2>
                            <p>The automated process all your website tasks. Discover tools and techniques to engage effectively with vulnerable children and young people.</p>
                            <?php if(isset(auth()->user()->username)) : ?> 
                                <a href="<?= base_url('courses') ?>" class="btn">
                                    View and Enrol in our <b>Courses</b> for Free
                                </a>
                            <?php else : ?>
                                <a href="<?= base_url('login') ?>" class="btn">
                                    Login to Start Learning
                                </a>
                            <?php endif; ?>                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Area End -->

    <?= $this->endSection() ?>
