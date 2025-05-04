<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Learn Affix Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="<?php echo base_url('public/admin/css/styles.css') ?>" rel="stylesheet" />
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/assets/img/favicon.ico') ?>">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    </head>
<body class="sb-nav-fixed">

<div id="layoutSidenav">
        <!-- Header -->
        <?php include APPPATH . 'Views/admin/layout/header.php'; ?>

        <!-- Sidebar -->
        <?php include APPPATH . 'Views/admin/partials/_sidebar.php'; ?>

        <div id="layoutSidenav_content">
            <!-- Conditionally include the header based on the URI -->
            <?php if (isset($current_uri) && $current_uri === 'create'): ?>
                <!-- If the page is 'create', don't include the header -->
            <?php else: ?>
                <?php echo view('admin/partials/_header'); ?>
            <?php endif; ?>

            <!-- Main Content (this will be injected from your page views) -->
            <main>
                <?= $this->renderSection('content') ?>
            </main>

            <!-- Footer -->
            <?php include APPPATH . 'Views/admin/partials/_footer.php'; ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('public/admin/js/scripts.js') ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('public/admin/assets/demo/chart-area-demo.js') ?>"></script>
        <script src="<?php echo base_url('public/admin/assets/demo/chart-bar-demo.js') ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('public/admin/js/datatables-simple-demo.js') ?>"></script>
    </body>
</html>

