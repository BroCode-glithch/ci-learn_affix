<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Learn Affix Admin</title>
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/assets/img/favicon.ico') ?>">
        <link href="<?php echo base_url('public/admin/css/styles.css') ?>" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        .toast-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .toast {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
            min-width: 250px;
            max-width: 350px;
            background-color: #333;
            color: white;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            margin-bottom: 10px;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        .toast-success {
            background-color: #28a745; /* Green */
        }

        .toast-error {
            background-color: #dc3545; /* Red */
        }

        .close-toast {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            margin-left: 10px;
        }

        </style>
    </head>
    <body class="bg-primary">

        <!-- Flash Message Container -->
        <div class="toast-container">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="toast toast-success">
                    <span><?= session()->getFlashdata('success'); ?></span>
                    <button class="close-toast">&times;</button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="toast toast-error">
                    <span><?= session()->getFlashdata('error'); ?></span>
                    <button class="close-toast">&times;</button>
                </div>
            <?php endif; ?>
        </div>

        <?= $this->renderSection('content'); ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('public/admin/js/scripts.js') ?>"></script>

                
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Auto-hide after 5 seconds
                setTimeout(function () {
                    document.querySelectorAll(".toast").forEach(function (toast) {
                        toast.style.opacity = "0";
                        setTimeout(() => toast.remove(), 500);
                    });
                }, 5000);

                // Close toast when clicking the button
                document.querySelectorAll(".close-toast").forEach(function (btn) {
                    btn.addEventListener("click", function () {
                        let toast = this.parentElement;
                        toast.style.opacity = "0";
                        setTimeout(() => toast.remove(), 500);
                    });
                });
            });
        </script>
    </body>
</html>