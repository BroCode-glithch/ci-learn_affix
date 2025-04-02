<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<!-- app/Views/payment_failed.php -->
<h1 class="text-danger">Payment Failed!</h1>
<p>There was an issue with your payment. Please try again later.</p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Reference</th>
            <th>Course Name</th>
            <th>Price (NGN)</th>
            <th>User</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= esc($reference ?? 'N/A'); ?></td>
            <td><?= esc($course_name ?? 'N/A'); ?></td>
            <td><?= esc(number_format($course_price ?? 0, 2)); ?></td>
            <td><?= esc($user_name ?? 'N/A'); ?></td>
        </tr>
    </tbody>
</table>

<a href="<?= base_url('courses'); ?>" class="btn btn-primary">Try Again</a>

<?= $this->endSection(); ?>
