<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <div class="row" style="margin-bottom: 40px;">
        <div class="col text-center">
            <h2 class="h2 text-dark"><?= $title ?></h2>
            <!-- <h4 class="h4 text-dark "><strong><?= $perusahaan->nama_perusahaan ?></strong></h4> -->
            <hr>
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">No</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">No. Keluar</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Nama Barang</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Jumlah</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Nama Petugas</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Tanggal Keluar</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_pengeluaran as $pengeluaran): ?>
                <tr>
                    <td style="border: 1px solid black; padding: 8px; text-align:center"><?= $no++ ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $pengeluaran->no_keluar ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $pengeluaran->nama_barang ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $pengeluaran->jumlah ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $pengeluaran->nama ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $pengeluaran->tgl_keluar ?>
                        <?= $pengeluaran->jam_keluar ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $pengeluaran->keterangan ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>