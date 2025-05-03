<!-- _sidebar.php -->
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <!-- Core Section -->
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="<?= site_url('/admin/dashboard') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <!-- Blog Section -->
                <div class="sb-sidenav-menu-heading">Blog</div>
                <a class="nav-link" href="<?= site_url('/admin/blog') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-blog"></i></div>
                    All Posts
                </a>
                <a class="nav-link" href="<?= site_url('/admin/blog/create') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-plus"></i></div>
                    Create Post
                </a>

                <!-- Blog Category Section -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Blog Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCategory" aria-labelledby="headingCategory" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= site_url('admin/blog/category/create') ?>">Create</a>
                        <a class="nav-link" href="<?= site_url('admin/blog/category') ?>">View Categories</a>
                    </nav>
                </div>

                <!-- Blog Tag Section -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTag" aria-expanded="false" aria-controls="collapseTag">
                    <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                    Blog Tag
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseTag" aria-labelledby="headingTag" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= site_url('admin/blog/tag/create') ?>">Create</a>
                        <a class="nav-link" href="<?= site_url('admin/blog/tag') ?>">View Tags</a>
                    </nav>
                </div>

                                <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Blog Tags
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div>
                    </nav> 
                </div> -->

            </div>
        </div>

        <!-- Sidebar Footer Section -->
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= esc(session('admin_name')) ?>
        </div>
    </nav>
</div>
