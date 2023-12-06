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
        </div>
        <hr>
    </div>
    <div class="row">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">No</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Kode Barang</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Nama Barang</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Stok</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_barang as $barang): ?>
                <tr>
                    <td style="border: 1px solid black; padding: 8px; text-align:center"><?= $no++ ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $barang->kode_barang ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $barang->nama_barang ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $barang->stok ?>
                        <?= strtolower($barang->satuan) ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $barang->keterangan ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>