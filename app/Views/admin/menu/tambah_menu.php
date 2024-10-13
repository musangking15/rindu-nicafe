<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
<h1>Tambah Menu</h1>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4 p-4">
    <form method="post" action="<?= url_to('input_menu'); ?>" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="form-group">
            <label for="nama_makanan">Nama Makanan</label>
            <input type="text" class="form-control" id="nama_makanan" name="nama_makanan" value="<?= old('nama_makanan'); ?>">
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="5"><?= old('deskripsi'); ?></textarea>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?= old('harga'); ?>">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="id_kategori" class="d-block">Kategori</label>
                    <select name="id_kategori" id="id_kategori">
                        <option value="" disabled selected>Pilih Kategori</option>
                        <?php foreach ($kategori as $value) : ?>
                            <option value="<?= $value['id_kategori']; ?>"><?= $value['nama_kategori']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="post" class="d-block">Posting</label>
                    <select name="post" id="post">
                        <option value="" disabled selected>Pilih Posting</option>
                        <option value="publish">Publish</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="gambar">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar" value="<?= old('gambar'); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="<?= url_to('data_menu'); ?>" class="btn btn-danger">Kembali</a>
    </form>

</div>
<?= $this->endSection() ?>