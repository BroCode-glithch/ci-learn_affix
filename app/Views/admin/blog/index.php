<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>All Blog Posts</h2>
    <a href="<?= base_url('/admin/blog/create') ?>" class="btn btn-primary mb-3">Add New Post</a>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blogs as $blog): ?>
                <tr>
                    <td><?= esc($blog['title']) ?></td>
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
