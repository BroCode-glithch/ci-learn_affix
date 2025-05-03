<?php $this->extend('admin/layout/master') ?>

<?php $this->section('content') ?>

<div class="container mt-5">
    <h2>Tags</h2>

    <a href="<?= site_url('admin/blog/tag/create') ?>" class="btn btn-primary mb-3">Create New Tag</a>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tag Name</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tags as $tag): ?>
                <tr>
                    <td><?= esc($tag['id']) ?></td>
                    <td><?= esc($tag['name']) ?></td>
                    <td><?= esc($tag['slug']) ?></td>
                    <td>
                        <a href="<?= site_url('admin/blog/tag/edit/' . $tag['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php $this->endSection() ?>
