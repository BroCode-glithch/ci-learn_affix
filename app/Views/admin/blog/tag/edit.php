<?php $this->extend('admin/layout/master') ?>

<?php $this->section('content') ?>

<div class="container mt-5">
    <h2>Edit Tag</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('admin/blog/tag/edit/' . $tag['id']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="name" class="form-label">Tag Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $tag['name']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Tag</button>
    </form>
</div>

<?php $this->endSection() ?>
