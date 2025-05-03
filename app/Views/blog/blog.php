<?php $this->extend('layouts/app') ?>

<?php $this->section('content') ?>


<main>
        <!--? slider Area Start-->
        <section class="slider-area slider-area2">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Company insights</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="#">Blog</a></li> 
                                        </ol>
                                    </nav>
                                    <!-- breadcrumb End -->
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </section>
        <!--? Blog Area Start-->
        <section class="blog_area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <?php foreach ($blogs as $blog): ?>
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="<?= base_url('public/assets/img/blog/' . esc($blog['image'])) ?>" alt="<?= esc($blog['title']) ?>">
                                    <a href="#" class="blog_item_date">
                                        <h3><?= date('d', strtotime($blog['created_at'])) ?></h3>
                                        <p><?= date('M', strtotime($blog['created_at'])) ?></p>
                                    </a>
                                </div>
                                <div class="blog_details">
                                    <a class="d-inline-block" href="<?= base_url('blog/' . esc($blog['slug'])) ?>">
                                        <h2 class="blog-head" style="color: #2d2d2d;"><?= esc($blog['title']) ?></h2>
                                    </a>
                                    <p><?= word_limiter(strip_tags($blog['content']), 25) ?></p>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="fa fa-user"></i> <?= esc($blog['category']) ?></a></li>
                                    </ul>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                    </div>
                    <div class="col-lg-4">
                    <div class="blog_right_sidebar">

                            <!-- Search Widget -->
                            <aside class="single_sidebar_widget search_widget">
                                <form action="<?= base_url('blog/search') ?>" method="get">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="q" placeholder='Search Keyword'
                                                onfocus="this.placeholder = ''"
                                                onblur="this.placeholder = 'Search Keyword'">
                                            <div class="input-group-append">
                                                <button class="btns" type="submit"><i class="ti-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                            type="submit">Search</button>
                                </form>
                            </aside>

                            <!-- Category Widget -->
                            <aside class="single_sidebar_widget post_category_widget">
                                <h4 class="widget_title" style="color: #2d2d2d;">Categories</h4>
                                <ul class="list cat-list">
                                    <?php foreach ($categories as $category): ?>
                                        <li>
                                            <a href="<?= base_url('category/' . esc($category['slug'])) ?>" class="d-flex">
                                                <p><?= esc($category['name']) ?></p>
                                                <p>(<?= esc($category['post_count']) ?>)</p>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </aside>

                            <!-- Recent Posts Widget -->
                            <aside class="single_sidebar_widget popular_post_widget">
                                <h3 class="widget_title" style="color: #2d2d2d;">Recent Posts</h3>
                                <?php foreach ($recentPosts as $post): ?>
                                    <div class="media post_item">
                                        <img src="<?= base_url('public/uploads/' . esc($post['image'])) ?>" alt="<?= esc($post['title']) ?>" style="width: 80px; height: auto;">
                                        <div class="media-body">
                                            <a href="<?= base_url('blog/' . esc($post['slug'])) ?>">
                                                <h3 style="color: #2d2d2d;"><?= esc($post['title']) ?></h3>
                                            </a>
                                            <p><?= date('F d, Y', strtotime($post['created_at'])) ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </aside>

                            <!-- Tag Cloud Widget -->
                            <aside class="single_sidebar_widget tag_cloud_widget">
                                <h4 class="widget_title" style="color: #2d2d2d;">Tag Clouds</h4>
                                <ul class="list">
                                    <?php foreach ($tags as $tag): ?>
                                        <li>
                                            <a href="<?= base_url('tag/' . esc($tag['slug'])) ?>"><?= esc($tag['name']) ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </aside>

                            <!-- Instagram Feed (static for now) -->
                            <aside class="single_sidebar_widget instagram_feeds">
                                <h4 class="widget_title" style="color: #2d2d2d;">Instagram Feeds</h4>
                                <ul class="instagram_row flex-wrap">
                                    <?php for ($i = 5; $i <= 10; $i++): ?>
                                        <li>
                                            <a href="#">
                                                <img class="img-fluid" src="<?= base_url("public/assets/img/post/post_$i.png") ?>" alt="">
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </aside>

                            <!-- Newsletter -->
                            <aside class="single_sidebar_widget newsletter_widget">
                                <h4 class="widget_title" style="color: #2d2d2d;">Newsletter</h4>
                                <form action="#">
                                    <div class="form-group">
                                        <input type="email" class="form-control" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                                    </div>
                                    <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                            type="submit">Subscribe</button>
                                </form>
                            </aside>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog Area End -->
    </main>


<?php $this->endSection() ?>
