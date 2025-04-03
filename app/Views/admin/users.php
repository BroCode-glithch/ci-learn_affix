<!-- app/Views/admin/users.php -->

<?= $this->extend('admin/layout/master'); ?>

<?= $this->section('content'); ?>

<h2>Manage Users</h2>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Loop through users and display them -->
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= esc($user->id); ?></td>
                <td><?= esc($user->name); ?></td>
                <td><?= esc($user->email); ?></td>
                <td><?= esc($user->role); ?></td>
                <td>
                    <a href="<?= site_url('admin/users/edit/'.$user->id); ?>">Edit</a>
                    <a href="<?= site_url('admin/users/delete/'.$user->id); ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection(); ?>
