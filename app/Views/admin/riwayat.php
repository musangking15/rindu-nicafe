<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
<h1>Data Riwayat</h1>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Tabel Harian -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Riwayat Perhari</h6>
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
                        <th>Bukti Pembayaran</th>
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
                            <td class="text-center">
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal-<?= $value['order_id']; ?>">
                                    Bukti Bayar
                                </button>
                            </td>
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

<!-- Tabel Bulanan -->
<div class="card shadow">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Riwayat Perbulan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="<?= base_url('admin/riwayat'); ?>" method="get">
                <label for="year">Tahun:</label>
                <input type="number" name="year" id="year" value="<?= esc($tahun); ?>" required>
                <button type="submit">Filter</button>
            </form>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pendapatan)): ?>
                        <?php
                        $bulanNama = [
                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember'
                        ];

                        foreach ($pendapatan as $bulan => $totalPendapatan): ?>
                            <tr>
                                <td><?= $bulanNama[$bulan]; ?></td>
                                <td><?= number_to_currency($totalPendapatan, 'IDR', 'id_ID', 0); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td class="text-center" colspan="2">Tidak ada data untuk tahun ini</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal bukti bayar -->
<?php foreach ($riwayat as $value) : ?>
    <div class="modal fade" id="exampleModal-<?= $value['order_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buktiModalLabel-<?= $value['id_transaksi']; ?>">Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="<?= base_url('bukti/' . $value['receipt']); ?>" alt="Bukti Pembayaran" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<?= $this->endSection() ?>