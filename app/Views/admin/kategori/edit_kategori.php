<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
<h1>Edit Kategori</h1>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4 p-4">
    <form method="post" action="<?= url_to('update_kategori', $kategori['id_kategori']); ?>">
        <?= csrf_field(); ?>
        <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori']; ?>>
        <div class=" form-group">
        <label for="nama_kategori">Nama Kategori</label>
        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= $kategori['nama_kategori']; ?>">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<a href="<?= url_to('data_kategori'); ?>" class="btn btn-danger">Kembali</a>
</form>

</div>
<?= $this->endSection() ?>