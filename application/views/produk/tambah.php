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
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for=""><strong>Bahan Baku</strong></label>
                                                <div class="form-row">
                                                    <div class="form-group col-4">
                                                        <select name="bahan_baku" id="bahan_baku" class="form-control"
                                                            required>
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
                                                            min='1' required>
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
        $('tfoot').hide()

        $(document).keypress(function(event) {
            if (event.which == '13') {
                event.preventDefault();
            }
        })

        // onchange dropdown bahan baku
        $('#bahan_baku').on('change', function() {
            const pKodeBrg = $(this).val().split(' - ')[1]
            console.log('onchange dropdown..', pKodeBrg)
            if (!pKodeBrg) reset()
            else {
                const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
                console.log('url..', url_get_all_barang)
                $.ajax({
                    url: url_get_all_barang,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        kode_barang: pKodeBrg
                    },
                    success: function(data) {
                        console.log('data..', data)
                        $('input[name="kode_barang"]').val(data.kode_barang)
                        $('input[name="harga_barang"]').val(data.harga_jual)
                        $('input[name="jumlah"]').val(1)
                        $('input[name="satuan"]').val(data.satuan)
                        $('input[name="keterangan"]').val(data.keterangan)
                        $('input[name="max_hidden"]').val(data.stok)
                        $('input[name="jumlah"]').prop('readonly', false)
                        $('button#tambah').prop('disabled', false)

                        $('input[name="sub_total"]').val($('input[name="jumlah"]').val() *
                            $('input[name="harga_barang"]').val())

                        $('input[name="jumlah"]').on('keydown keyup change blur',
                            function() {
                                $('input[name="sub_total"]').val($(
                                    'input[name="jumlah"]').val() * $(
                                    'input[name="harga_barang"]').val())
                            })
                    }
                })
            }
        })

        // add detail product
        $(document).on('click', '#tambah', function(e) {
            const fBahanBaku = $('select[name="bahan_baku"]').val();
            const fQty = $('input[name="qty"]').val();
            const fNamaProduk = $('input[name="nama_produk"]').val();
            const fSatuan = $('input[name="satuan"]').val();
            if (!fBahanBaku || !fQty || !fNamaProduk || !fSatuan) return;

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
    })
    </script>
</body>

</html>