<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
<h1>Data Transaksi</h1>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <?php foreach ($transaksi as $value) : ?>
        <div class="col-sm-4 mb-3 mb-sm-0">
            <div class="card border border-dark mb-3" style="overflow: hidden;">
                <div class="card-header bg-primary text-light shadow">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="card-title">
                                Customer: <?= $value['nama_customer']; ?>
                            </h5>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal-<?= $value['order_id']; ?>">
                                Bukti Bayar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php foreach ($value['pesanan'] as $item) : ?>
                        <div class="d-flex">
                            <p class="mr-auto">
                                <?= $item['name'] ?> - <?= $item['qty'] ?>x
                            </p>
                            <p>
                                <?= number_to_currency($item['price'], 'IDR', 'id_ID', 0); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                    <hr style="background-color:black;">
                    <p class="card-text">Total: <?= number_to_currency($value['total'], 'IDR', 'id_ID', 0); ?></p>
                    <form action="<?= url_to('ready', $value['id_transaksi']); ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <button class="btn btn-sm btn-success" type="submit">Ready</i></button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>

    <!-- Modal bukti bayar -->
    <?php foreach ($transaksi as $value) : ?>
        <div class="modal fade" id="exampleModal-<?= $value['order_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                        <h5 class="modal-title" id="buktiModalLabel-<?= $value['id_transaksi']; ?>">Bukti Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-light">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="<?= base_url('bukti/' . $value['receipt']); ?>" alt="Bukti Pembayaran" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>


<?= $this->endSection() ?>