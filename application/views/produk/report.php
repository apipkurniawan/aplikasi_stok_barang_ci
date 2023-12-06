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
            <hr>
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">No</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Kode Produk</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Nama Produk</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Satuan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_produk as $produk): ?>
                <tr>
                    <td style="border: 1px solid black; padding: 8px; text-align:center"><?= $no++ ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $produk->kode_produk ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $produk->nama_produk ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $produk->satuan ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>