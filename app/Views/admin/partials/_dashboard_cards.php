<style>
    @keyframes floatingPulse {
        0% { transform: translateY(0) scale(1); }
        50% { transform: translateY(-5px) scale(1.03); }
        100% { transform: translateY(0) scale(1); }
    }

    .dashboard-card {
        animation: floatingPulse 3s ease-in-out infinite;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 1rem;
        overflow: hidden;
        position: relative;
    }

    .dashboard-card:hover {
        transform: translateY(-8px) scale(1.05);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        animation-play-state: paused; /* Pause floating on hover */
    }

    .dashboard-card .card-footer i {
        transition: transform 0.3s ease;
    }

    .dashboard-card:hover .card-footer i {
        transform: translateX(5px);
    }

    .dashboard-card .card-body {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(0, 0, 0, 0.1));
        backdrop-filter: blur(5px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .dashboard-label {
        font-size: 0.85rem;
        letter-spacing: 0.05em;
        opacity: 0.9;
    }

    .dashboard-count {
        font-size: 2rem;
        font-weight: 700;
    }
</style>


<div class="row">
    <!-- Total Courses -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-danger text-white shadow h-100 dashboard-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="dashboard-label mb-1 text-uppercase">Total Courses</div>
                        <div class="dashboard-count"><?= esc(data: $courseCount) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-graduation-cap fa-3x text-white-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer text-white small d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="/admin/courses">View Details</a>
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>

    <!-- Total Posts -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-primary text-white shadow h-100 dashboard-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="dashboard-label mb-1 text-uppercase">Total Posts</div>
                        <div class="dashboard-count"><?= esc($postCount) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-pen fa-3x text-white-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer text-white small d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="/admin/blog/posts">View Details</a>
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>

    <!-- Total Categories -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-success text-white shadow h-100 dashboard-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="dashboard-label mb-1 text-uppercase">Total Categories</div>
                        <div class="dashboard-count"><?= esc($categoryCount) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-folder fa-3x text-white-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer text-white small d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="/admin/blog/category">View Details</a>
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>

    <!-- Total Tags -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-warning text-white shadow h-100 dashboard-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="dashboard-label mb-1 text-uppercase">Total Tags</div>
                        <div class="dashboard-count"><?= esc($tagCount) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tags fa-3x text-white-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer text-white small d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="/admin/blog/tags">View Details</a>
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>
</div>
