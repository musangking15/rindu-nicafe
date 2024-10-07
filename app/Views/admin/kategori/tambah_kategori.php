<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
<h1>Tambah Kategori</h1>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4 p-4">
    <form method="post" action="<?= url_to('input_kategori'); ?>">
        <?= csrf_field(); ?>
        <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= old('nama_kategori'); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="<?= url_to('data_kategori'); ?>" class="btn btn-danger">Kembali</a>
    </form>

</div>
<?= $this->endSection() ?>