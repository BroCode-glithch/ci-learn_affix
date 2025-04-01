<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<main>
    <!-- Slider Section -->
    <section class="slider-area slider-area2">
        <div class="slider-active">
            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s"><?= $about['title'] ?></h1>
                                <!-- Breadcrumb Section -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                                        <li class="breadcrumb-item active"><?= $about['title'] ?></li>
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

    <!-- Services Section -->
    <div class="services-area services-area2 section-padding40">
        <div class="container">
            <div class="row justify-content-sm-center">
                <?php foreach ($services as $service): ?>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="<?= base_url('public/assets/img/icon/'.$service['icon']) ?>" alt="<?= $service['title'] ?> Icon">
                        </div>
                        <div class="features-caption">
                            <h3><?= $service['title'] ?></h3>
                            <p><?= $service['description'] ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <section class="about-area1 fix pt-10">
        <div class="support-wrapper align-items-center">
            <div class="left-content1">
                <div class="about-icon">
                    <img src="<?= base_url('public/assets/img/icon/about.svg') ?>" alt="About Icon">
                </div>
                <div class="section-tittle section-tittle2 mb-55">
                    <div class="front-text">
                        <h2><?= $about['title'] ?></h2>
                        <p><?= $about['description'] ?></p>
                    </div>
                </div>

                <!-- Single Features (Dynamic) -->
                <div class="single-features">
                    <div class="features-icon">
                        <img src="<?= base_url('public/assets/img/icon/right-icon.svg') ?>" alt="Icon">
                    </div>
                    <div class="features-caption">
                        <p>Techniques to engage effectively with vulnerable children and young people.</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="<?= base_url('public/assets/img/icon/right-icon.svg') ?>" alt="Icon">
                    </div>
                    <div class="features-caption">
                        <p>Join millions of people from around the world learning together.</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="<?= base_url('public/assets/img/icon/right-icon.svg') ?>" alt="Icon">
                    </div>
                    <div class="features-caption">
                        <p>Join millions of people from around the world learning together. Online learning is as easy and natural.</p>
                    </div>
                </div>
            </div>

            <div class="right-content1">
                <div class="right-img">
                    <img src="<?= base_url('public/assets/img/gallery/about.png') ?>" alt="About Image">
                    <div class="video-icon">
                        <a class="popup-video btn-icon" href="https://www.youtube.com/watch?v=up68UAfH0d0"><i class="fas fa-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Topics Section -->
    <div class="topic-area section-padding40">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>Explore top subjects</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($topics as $topic): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-topic text-center mb-30">
                        <div class="topic-img">
                            <img src="<?= base_url('public/assets/img/gallery/'.$topic['topic_image']) ?>" alt="<?= $topic['topic'] ?> Image">
                            <div class="topic-content-box">
                                <div class="topic-content">
                                    <h3><a href="#"><?= $topic['topic'] ?></a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="section-tittle text-center mt-20">
                        <a href="courses.html" class="border-btn">View More Subjects</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
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
                <?php foreach ($team as $member): ?>
                <div class="single-cat text-center">
                    <div class="cat-icon">
                        <img src="<?= base_url('public/assets/img/gallery/'.$member['image']) ?>" alt="<?= $member['name'] ?> Image">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="services.html"><?= $member['name'] ?></a></h5>
                        <p><?= $member['position'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main>

<?= $this->endSection(); ?>
