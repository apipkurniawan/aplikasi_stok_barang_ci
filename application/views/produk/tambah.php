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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                                <div class="card-body">
                                    <form action="<?= base_url('produk/proses_tambah') ?>" id="form-tambah"
                                        method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="kode_produk"><strong>Kode Produk</strong></label>
                                                <input type="text" name="kode_produk" placeholder="Masukkan Kode Produk"
                                                    autocomplete="off" class="form-control" required
                                                    value="<?= mt_rand(10000000, 99999999) ?>" maxlength="8" readonly>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="nama_produk"><strong>Nama Produk</strong></label>
                                                <input type="text" name="nama_produk" placeholder="Masukkan Nama Produk"
                                                    autocomplete="off" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="satuan_produk"><strong>Satuan</strong></label>
                                                <input type="text" name="satuan_produk"
                                                    placeholder="Masukkan Satuan produk" autocomplete="off"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for=""><strong>Bahan Baku</strong></label>
                                                <div class="form-row">
                                                    <div class="form-group col-4">
                                                        <select name="bahan_baku" id="bahan_baku" class="form-control">
                                                            <option value="">Pilih Bahan Baku</option>
                                                            <?php foreach ($all_bahan_baku as $barang): ?>
                                                            <option
                                                                value="<?= $barang->nama_barang ?> - <?= $barang->kode_barang ?>">
                                                                <?= $barang->nama_barang ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <input type="number" name="qty" value="" class="form-control"
                                                            min='1'>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <input type="text" name="satuan" value="" class="form-control"
                                                            readonly>
                                                    </div>
                                                    <div class="form-group col-1">
                                                        <button type="button" class="btn btn-primary btn-block"
                                                            id="tambah"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                    <input type="hidden" name="satuan" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="keranjang">
                                            <h5>Detail Produk</h5>
                                            <table class="table table-bordered" id="keranjang">
                                                <thead>
                                                    <tr>
                                                        <td width="35%">Bahan Baku</td>
                                                        <td width="15%">Qty</td>
                                                        <td width="15%">Satuan</td>
                                                        <td width="15%">Aksi</td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
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
    <script>
    $(document).ready(function() {
        const allBahanBaku = $.parseJSON('<?= json_encode($all_bahan_baku) ?>');

        $('tfoot').hide()

        $(document).keypress(function(event) {
            if (event.which == '13') {
                event.preventDefault();
            }
        })

        // onchange dropdown bahan baku
        $('#bahan_baku').on('change', function() {
            const pKodeBrg = $(this).val().split(' - ')[1]

            if (!pKodeBrg) reset()
            else {
                const satuan = getSatuanBarang(pKodeBrg)
                $('input[name="satuan"]').val(satuan)
            }
        })

        // add detail product
        $(document).on('click', '#tambah', function(e) {
            const fBahanBaku = $('select[name="bahan_baku"]').val();
            const fQty = $('input[name="qty"]').val();
            const fNamaProduk = $('input[name="nama_produk"]').val();
            const fSatuan = $('input[name="satuan"]').val();
            if (!fBahanBaku || !fQty || !fNamaProduk || !fSatuan) {
                alert('Isi data terlebih dahulu!')
                return
            }

            const url_keranjang_produk = $('#content').data('url') + '/keranjang_produk'
            const data_keranjang = {
                bahan_baku: fBahanBaku,
                qty: fQty,
                satuan: fSatuan
            }

            $.ajax({
                url: url_keranjang_produk,
                type: 'POST',
                data: data_keranjang,
                success: function(data) {
                    reset()
                    $('table#keranjang tbody').append(data)
                    $('tfoot').show()
                }
            })

        })

        // delete row
        $(document).on('click', '#tombol-hapus', function() {
            $(this).closest('.row-keranjang').remove()
            if ($('tbody').children().length == 0) $('tfoot').hide()
        })

        // clear field
        function reset() {
            $('#bahan_baku').val('')
            $('input[name="satuan"]').val('')
            $('input[name="qty"]').val('')
        }

        function getSatuanBarang(kodeBrg) {
            return $.grep(allBahanBaku, function(obj) {
                return obj.kode_barang == kodeBrg
            })[0].satuan
        }
    })
    </script>
</body>

</html>