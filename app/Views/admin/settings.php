<!-- app/Views/admin/settings.php -->

<?= $this->extend('admin/layout/master'); ?>

<?= $this->section('content'); ?>

<h2>Settings</h2>
<form method="post" action="<?= site_url('admin/settings/update'); ?>">
    <div class="form-group">
        <label for="site_name">Site Name</label>
        
    </div>
    <button type="submit">Save Changes</button>
</form>

<?= $this->endSection(); ?>
