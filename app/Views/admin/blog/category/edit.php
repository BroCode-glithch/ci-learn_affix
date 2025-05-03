<?php $this->extend('admin/layout/master') ?>

<?php $this->section('content') ?>

<div class="container mt-5">
    <h2>Edit Category</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('admin/blog/category/edit/' . $category['id']) ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $category['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="<?= old('slug', $category['slug']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>

<?php $this->endSection() ?>
