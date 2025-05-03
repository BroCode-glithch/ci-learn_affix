<?php $this->extend('admin/layout/master') ?>

<?php $this->section('content') ?>

<div class="container mt-5">
    <h2>Create Blog Post</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('admin/blog/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= old('title') ?>" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required><?= old('content') ?></textarea>
        </div>

        <!-- Category dropdown (optional) -->
        <?php if (isset($categories)): ?>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="">-- Select Category --</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= esc($category['category']) ?>" <?= old('category') == $category['category'] ? 'selected' : '' ?>>
                            <?= esc($category['category']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <a href="<?= base_url('/admin/blog/category/create') ?>" class="btn btn-primary mb-3">Add New Category</a>
        <?php endif; ?>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

<?php $this->endSection() ?>
