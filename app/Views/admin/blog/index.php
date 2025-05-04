<?php $this->extend('admin/layout/master') ?>

<?php $this->section('content') ?>

<div class="container mt-5">
    <h2>All Blog Posts</h2>
    <a href="<?= base_url('/admin/blog/create') ?>" class="btn btn-primary mb-3">Add New Post</a>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blogs as $key => $blog): ?>
                <tr>
                    <td><?= esc($key + 1) ?></td>
                    <td><?= esc($blog['title']) ?></td>
                    <td><?= esc($blog['content']) ?></td>
                    <td><?= esc($blog['category']) ?></td>
                    <td><?= esc($blog['created_at']) ?></td>
                    <td>
                        <a href="<?= base_url('/admin/blog/edit/' . $blog['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('/admin/blog/delete/' . $blog['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
