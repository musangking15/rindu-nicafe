<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
<h1>Data Menu</h1>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        <a href="<?= url_to('tambah_menu'); ?>" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah</span>
        </a>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashdata('failed')) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('failed') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($menu as $value) : ?>
                        <tr>
                            <td class="text-center"><img src="<?= base_url(); ?>gambar/<?= $value['gambar']; ?>" width="auto" height="100"></td>
                            <td><?= $value['nama_makanan']; ?></td>
                            <td>Rp <?= number_format($value['harga'], 0, ',', '.'); ?></td>
                            <td>
                                <button class="btn btn-secondary btn-circle" data-toggle="modal" data-target="#exampleModal<?= $value['id_menu']; ?>">
                                    <i class="fas fa-sticky-note"></i>
                                </button>
                                <a href="<?= url_to('edit_menu', $value['id_menu']); ?>" class="btn btn-warning btn-circle">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="<?= url_to('delete_menu', $value['id_menu']); ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger btn-circle" onclick="return confirm('apakah anda yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php foreach ($menu as $value) : ?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal<?= $value['id_menu']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title text-light" id="exampleModalLabel"><?= $value['nama_makanan']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item text-center"><img src="<?= base_url(); ?>gambar/<?= $value['gambar']; ?>" width="auto" height="100"></li>
                        <li class="list-group-item">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <?= $value['nama_kategori']; ?>
                                </div>
                                <div class="col-md-6">
                                    <?= number_to_currency($value['harga'], 'IDR', 'id_ID', 0); ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <h4><?= $value['deskripsi']; ?></h4>
                        </li>
                    </ul>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
<?php endforeach ?>
<?= $this->endSection() ?>