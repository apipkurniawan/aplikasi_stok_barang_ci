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
            <div id="content" data-url="<?= base_url('pengeluaran') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>

                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                        </div>
                        <div class="float-right">
                            <a href="<?= base_url('pengeluaran') ?>" class="btn btn-secondary btn-sm"><i
                                    class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                                <div class="card-body">
                                    <form action="<?= base_url('pengeluaran/proses_tambah') ?>" id="form-tambah"
                                        method="POST">
                                        <h5>Data Petugas</h5>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-2">
                                                <label>No. Terima</label>
                                                <input type="text" name="no_keluar" value="TR<?= time() ?>" readonly
                                                    class="form-control">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Kode Petugas</label>
                                                <input type="text" name="kode_petugas"
                                                    value="<?= $this->session->login['kode'] ?>" readonly
                                                    class="form-control">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Nama Petugas</label>
                                                <input type="text" name="nama_petugas"
                                                    value="<?= $this->session->login['nama'] ?>" readonly
                                                    class="form-control">
                                            </div>
                                            <div class="form-group col-2">
                                                <label>Tanggal Keluar</label>
                                                <input type="text" name="tgl_keluar" value="<?= date('d/m/Y') ?>"
                                                    readonly class="form-control">
                                            </div>
                                            <div class="form-group col-2">
                                                <label>Jam</label>
                                                <input type="text" name="jam_keluar" value="<?= date('H:i:s') ?>"
                                                    readonly class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5>Data Barang</h5>
                                                <hr>
                                                <div class="form-row">
                                                    <div class="form-group col-4">
                                                        <label for="nama_barang">Nama Barang/Produk</label>
                                                        <select name="nama_barang" id="nama_barang"
                                                            class="form-control">
                                                            <option value="">Pilih Barang/Produk</option>
                                                            <?php foreach ($all_barang as $barang): ?>
                                                            <option
                                                                value="<?= $barang->nama_barang ?> - <?= $barang->kode_barang ?>">
                                                                <?= $barang->nama_barang ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <!-- <div class="form-group col-1">
                                                        <label>Stok</label>
                                                        <input type="hidden" name="stok" value="" readonly
                                                            class="form-control">
                                                    </div> -->
                                                    <div class="form-group col-1">
                                                        <label>Jumlah</label>
                                                        <input type="number" name="jumlah" value="" class="form-control"
                                                            min='1'>
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>Satuan</label>
                                                        <input type="text" name="satuan" value="" readonly
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-3">
                                                        <label>Keterangan</label>
                                                        <input type="text" name="keterangan" value=""
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-1">
                                                        <label for="">&nbsp;</label>
                                                        <button type="button" class="btn btn-primary btn-block"
                                                            id="tambah"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                    <input type="hidden" name="category" value="">
                                                    <input type="hidden" name="stok" value="" readonly
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="keranjang">
                                            <h5>Detail Pengeluaran</h5>
                                            <hr>
                                            <table class="table table-bordered" id="keranjang">
                                                <thead>
                                                    <tr>
                                                        <td width="35%">Nama Barang</td>
                                                        <td width="15%">Jumlah</td>
                                                        <td width="10%">Satuan</td>
                                                        <td width="15%">Keterangan</td>
                                                        <td width="15%">Aksi</td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="6" align="center">
                                                            <button type="submit" class="btn btn-primary"><i
                                                                    class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
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
        const allBarang = $.parseJSON('<?= json_encode($all_barang) ?>');
        $('tfoot').hide()

        $(document).keypress(function(event) {
            if (event.which == '13') {
                event.preventDefault();
            }
        })

        $(document).on('click', '#reset', function() {
            $('#nama_customer').val('')
            $('#nama_customer').prop('disabled', false)
            $(this).prop('disabled', true)
            $('input[name="nama_customer"]').val('')
        })

        $('#nama_barang').on('change', function() {
            const pKodeBrg = $(this).val().split(' - ')[1];

            if (!pKodeBrg) reset()
            else {
                const satuan = getDataBarang(pKodeBrg).satuan
                const stok = getDataBarang(pKodeBrg).stok
                const category = getDataBarang(pKodeBrg).category
                $('input[name="satuan"]').val(satuan)
                $('input[name="stok"]').val(stok)
                $('input[name="category"]').val(category)
            }
        })

        $(document).on('click', '#tambah', function(e) {
            const jml = $('input[name="jumlah"]').val()
            const brg = $('select[name="nama_barang"]').val()
            const ket = $('input[name="keterangan"]').val();
            const satuan = $('input[name="satuan"]').val();
            const stok = $('input[name="stok"]').val();
            const category = $('input[name="category"]').val();
            if (!jml || !brg) {
                alert('Isi data terlebih dahulu!')
                return
            }

            const url_keranjang_barang = $('#content').data('url') + '/keranjang_barang'
            const data_keranjang = {
                nama_barang: brg,
                jumlah: jml,
                satuan: satuan,
                keterangan: ket,
            }

            if (category == 'barang' && parseInt(data_keranjang.jumlah) > parseInt(stok)) {
                alert('Jumlah pengeluaran melebihi stok! stok tersedia : ' + parseInt(stok))
            } else if (category == 'barang' && parseInt(stok) <= 0) {
                alert('stok tidak tersedia!')
            } else {
                $.ajax({
                    url: url_keranjang_barang,
                    type: 'POST',
                    data: data_keranjang,
                    success: function(data) {
                        if ($('select[name="nama_barang"]').val() == data_keranjang
                            .nama_barang) $('option[value="' + data_keranjang.nama_barang +
                            '"]').hide()

                        reset()

                        $('table#keranjang tbody').append(data)
                        $('tfoot').show()
                    }
                })
            }
        })

        $(document).on('click', '#tombol-hapus', function() {
            $(this).closest('.row-keranjang').remove()
            $('option[value="' + $(this).data('nama-barang') + '"]').show()
            if ($('tbody').children().length == 0) $('tfoot').hide()
        })

        function reset() {
            $('#nama_barang').val('')
            $('input[name="stok"]').val('')
            $('input[name="jumlah"]').val('')
            $('input[name="satuan"]').val('')
            $('input[name="keterangan"]').val('')
            $('input[name="category"]').val('')
        }

        function getDataBarang(kodeBrg) {
            return $.grep(allBarang, function(obj) {
                return obj.kode_barang == kodeBrg
            })[0]
        }
    })
    </script>
</body>

</html>