<?php $this->extend('admin/layout/master') ?>

<?php $this->section('content') ?>

<div class="container mt-5">
    <h2>Categories</h2>

    <a href="<?= site_url('admin/blog/category/create') ?>" class="btn btn-success mb-3">Create New Category</a>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Category Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= esc($category['id']) ?></td>
                    <td><?= esc($category['name']) ?></td>
                    <td><?= esc($category['slug']) ?></td>
                    <td>
                        <a href="<?= site_url('admin/blog/category/edit/' . $category['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="<?= site_url('admin/blog/category/delete/' . $category['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php $this->endSection() ?>
