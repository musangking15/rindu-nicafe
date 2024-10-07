<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
<h1>Data Riwayat</h1>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Riwayat</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="<?= base_url('admin/riwayat'); ?>" method="get">
                <input type="date" name="date">
                <button type="submit" class="btn btn-primary btn-sm">Search</button>
            </form>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($riwayat as $value) :
                    ?>
                        <tr>
                            <td><?= $value['nama_customer']; ?></td>
                            <td><?= date('l, d M Y', strtotime($value['tanggal'])); ?></td>
                            <td><?= number_to_currency($value['total'], 'IDR', 'id_ID', 0); ?></td>
                        </tr>
                        <?php $total  += $value['total'] ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <p>Total : <?= number_to_currency($total, 'IDR', 'id_ID', 0); ?></p>
    </div>
</div>
<?= $this->endSection() ?>