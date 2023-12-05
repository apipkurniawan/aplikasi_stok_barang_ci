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
            <div id="content" data-url="<?= base_url('barang') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>

                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                        </div>
                        <div class="float-right">
                            <a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-sm"><i
                                    class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                                <div class="card-body">
                                    <form action="<?= base_url('barang/proses_ubah/' . $barang->kode_barang) ?>"
                                        id="form-tambah" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="kode_barang"><strong>Kode Barang</strong></label>
                                                <input type="text" name="kode_barang" placeholder="Masukkan Kode Barang"
                                                    autocomplete="off" class="form-control" required
                                                    value="<?= $barang->kode_barang ?>" maxlength="8" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="nama_barang"><strong>Nama Barang</strong></label>
                                                <input type="text" name="nama_barang" placeholder="Masukkan Nama Barang"
                                                    autocomplete="off" class="form-control" required
                                                    value="<?= $barang->nama_barang ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="stok"><strong>Stok</strong></label>
                                                <input type="number" name="stok" placeholder="Masukkan Stok"
                                                    autocomplete="off" class="form-control" required
                                                    value="<?= $barang->stok ?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="satuan"><strong>Satuan</strong></label>
                                                <select name="satuan" id="satuan" class="form-control" required>
                                                    <option value="">Silahkan Pilih</option>
                                                    <option value="pcs"
                                                        <?= $barang->satuan == 'pcs' ? 'selected' : '' ?>>pcs</option>
                                                    <option value="gram"
                                                        <?= $barang->satuan == 'gram' ? 'selected' : '' ?>>gram</option>
                                                    <option value="pack"
                                                        <?= $barang->satuan == 'pack' ? 'selected' : '' ?>>pack</option>
                                                    <option value="liter"
                                                        <?= $barang->satuan == 'liter' ? 'selected' : '' ?>>liter
                                                    </option>
                                                    <option value="kg" <?= $barang->satuan == 'kg' ? 'selected' : '' ?>>
                                                        kg</option>
                                                    <option value="mil"
                                                        <?= $barang->satuan == 'mili' ? 'selected' : '' ?>>mil</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="bahan_baku"><strong>Bahan Baku</strong></label>
                                                <select name="bahan_baku" id="bahan_baku" class="form-control" required>
                                                    <option value="">Silahkan Pilih</option>
                                                    <option value="Y"
                                                        <?= $barang->bahan_baku == 'Y' ? 'selected' : '' ?>>Ya</option>
                                                    <option value="N"
                                                        <?= $barang->bahan_baku == 'N' ? 'selected' : '' ?>>Tidak
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="keterangan"><strong>Keterangan</strong></label>
                                                <input type="text" name="keterangan" placeholder="Masukkan Keterangan"
                                                    autocomplete="off" class="form-control"
                                                    value="<?= $barang->keterangan ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                            <button type="reset" class="btn btn-danger"><i
                                                    class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                                        </div>
                                    </form>
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
</body>

</html>