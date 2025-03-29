<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?><?= esc($category_name) ?> Courses<?= $this->endSection() ?>

<?= $this->section('content') ?>

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
<?= $this->endSection() ?>
