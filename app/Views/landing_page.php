<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-1HbQdzP9Etrnz8U8"></script>
    <title>Rindu Nicafe</title>
    <!-- Favicon -->
    <link rel="icon" href="<?= base_url(); ?>/img/logo2.png" sizes="16x16" type="image/png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>css/style.css">
</head>

<body>
    <!-- start navbar -->
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container">
            <a class="navbar-brand fs-3 fw-semibold" href="#">Rindu<span class="text-danger">Nicafe</span></a>
            <button class="btn btn-warning ms-auto me-2 position-relative" data-bs-toggle="modal" data-bs-target="#cart"><i class="bi bi-cart-fill"></i>
                <?php if (empty($carts)) : ?>
                <?php else : ?>
                    <span class="badge text-bg-danger position-absolute">
                        <?php
                        $jml = 0;
                        foreach ($carts as $value) {
                            $jml += $value['qty'];
                        }
                        ?>
                        <?= $jml; ?>
                    </span>
                <?php endif ?>
            </button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto fs-5">
                    <button type="button" class="btn btn-danger fw-semibold" data-bs-toggle="modal" data-bs-target="#login">
                        Login
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <!-- start menu -->
    <section class="my-3">
        <div class="container">
            <div class="d-flex gap-2 overflow-x-auto flex-nowrap py-3 justify-content-md-center">
                <a style="font-size: 10px;" href="<?= base_url('/'); ?>"
                    class="btn btn-sm btn-outline-primary <?= (empty($selectedCategory) ? 'active' : '') ?>">
                    All
                </a>
                <?php foreach ($kategori as $k) : ?>
                    <a style="font-size: 10px;" href="<?= base_url('/?category=' . $k['nama_kategori']); ?>"
                        class="btn btn-sm btn-outline-primary <?= ($selectedCategory == $k['nama_kategori'] ? 'active' : '') ?>">
                        <?= ucfirst($k['nama_kategori']); ?>
                    </a>
                <?php endforeach ?>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row px-2 <?= count($items) > 1 ? 'row-cols-2' : '' ?>">
                <?php foreach ($items as $item) : ?>
                    <div class="col-sm-6 mb-3">
                        <?php
                        echo form_open('home/add');
                        echo form_hidden('id', $item['id_menu']);
                        echo form_hidden('price', $item['harga']);
                        echo form_hidden('name', $item['nama_makanan']);
                        ?>
                        <div class="card">
                            <img src="<?= base_url('gambar/') . $item['gambar'] ?>" class="card-img-top">
                            <div class="card-body">
                                <p class="card-title fw-bold"><?= $item['nama_makanan']; ?></p>
                                <div class="deskripsi">
                                    <p><?= $item['deskripsi']; ?></p>
                                </div>
                                <p class="card-text"><?= number_to_currency($item['harga'], 'IDR', 'id_ID', 0); ?></p>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Beli</button>
                                </div>
                                <div class="tooltip-note"><?= $item['deskripsi']; ?></div>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- end menu -->

    <!-- Modal Cart -->
    <div class="modal fade" id="cart" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body body-hidden">
                    <?php if (empty($carts)) : ?>
                        <p class="text-center">Keranjang kosong</p>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <?php else : ?>
                        <?= form_open_multipart('home/transaksi') ?>
                        <p class="fst-italic">*Wajib mengisi nama dan bukti pembayaran</p>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="#customer" class="fw-bold">Nama Customer</label>
                                <input type="text" name="customer" id="customer" class="d-block" placeholder="Silahkan masukkan nama" class="form-control mb-3">
                            </div>
                            <div class="col-6">
                                <label for="#receipt" class="fw-bold">Bukti Pembayaran</label>
                                <input type="file" name="receipt" id="receipt">
                            </div>
                        </div>
                        <table class="table table-striped">
                            <tbody>
                                <?php foreach ($carts as $item) : ?>
                                    <tr>
                                        <td><?= $item['name']; ?></td>
                                        <td><?= $item['qty']; ?>x</td>
                                        <td><?= number_to_currency($item['subtotal'], 'IDR', 'id_ID', 0); ?></td>
                                        <td>
                                            <a href="<?= url_to('delete', $item['rowid']); ?>" class="btn btn-danger btn-sm">
                                                <i class="bi bi-x-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="d-flex flex-row-reverse me-5">
                            <p>Total : <?= number_to_currency($keranjang->total(), 'IDR', 'id_ID', 0); ?></p>
                        </div>
                        <button type="submit" id="order" class="btn btn-primary">Pesan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <?= form_close() ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal login -->
    <div class="modal fade" id="login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center bg-info">
                    <p class="modal-title fs-2 fw-bold text-light" id="staticBackdropLabel">Login</p>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= url_to('login'); ?>">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name='username' class="form-control" id="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name='password' class="form-control" id="password">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info text-light fw-bold">Login</button>
                    <button type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Sweet Alert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->getFlashdata('pesan1')) : ?>
            Swal.fire({
                icon: '<?= session()->getFlashdata('jenis'); ?>',
                title: '<?= session()->getFlashdata('pesan1'); ?>',
                text: '<?= session()->getFlashdata('pesan2'); ?>'
            });
        <?php endif; ?>

        const customerInput = document.getElementById('customer');
        const receiptInput = document.getElementById('receipt')
        const btnOrder = document.getElementById('order');

        function checkCustomerInput() {
            if (customerInput.value.trim() === '' || receiptInput.files.length === 0) {
                btnOrder.setAttribute('disabled', true);
            } else {
                btnOrder.removeAttribute('disabled');
            }
        }


        customerInput.addEventListener('input', checkCustomerInput);
        receiptInput.addEventListener('change', checkCustomerInput);

        checkCustomerInput();

        function isMobile() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

        }
    });
</script>


</html>