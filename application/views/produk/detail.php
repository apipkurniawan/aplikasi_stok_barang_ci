<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('produk') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>

                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                        </div>
                        <div class="float-right">
                            <a href="<?= base_url('produk') ?>" class="btn btn-secondary btn-sm"><i
                                    class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                    </div>
                    <hr>
                    <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php elseif($this->session->flashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif ?>
                    <div class="card shadow">
                        <div class="card-header"><strong><?= $title ?> - <?= $produk->kode_produk ?></strong></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Kode Produk</strong></td>
                                            <td>:</td>
                                            <td><?= $produk->kode_produk ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama Produk</strong></td>
                                            <td>:</td>
                                            <td><?= $produk->nama_produk ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Satuan</strong></td>
                                            <td>:</td>
                                            <td><?= $produk->satuan ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td><strong>No</strong></td>
                                                <td><strong>Nama Barang</strong></td>
                                                <td><strong>Jumlah</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($all_detail_produk as $detail_produk): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $detail_produk->kode_barang ?> -
                                                    <?= $detail_produk->nama_barang ?></td>
                                                <td><?= $detail_produk->qty ?>
                                                    <?= strtolower($detail_produk->satuan) ?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- load footer -->
            <?php $this->load->view('partials/footer.php') ?>
        </div>
    </div>
    <?php $this->load->view('partials/js.php') ?>
    <script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>

</html>