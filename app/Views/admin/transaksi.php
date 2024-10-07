<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
<h1>Data Transaksi</h1>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <?php foreach ($transaksi as $value) : ?>
        <div class="col-sm-4 mb-3 mb-sm-0">
            <div class="card mb-3">
                <div class="card-header bg-primary text-light shadow">
                    <h5 class="card-title">
                        Customer: <?= $value['nama_customer']; ?>
                    </h5>
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
                    <hr>
                    <p class="card-text">Total: <?= number_to_currency($value['total'], 'IDR', 'id_ID', 0); ?></p>
                    <form action="<?= url_to('ready', $value['id_transaksi']); ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <button class="btn btn-sm btn-success" type="submit">Ready</i></button>
                    </form>
                    <form action="" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <button class="btn btn-sm btn-warning" type="submit">paid</i></button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?>