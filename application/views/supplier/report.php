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
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Kode Supplier</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Nama Supplier</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Telepon</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Email</th>
                    <th style="font-weight: 600; border: 1px solid black; padding: 8px;">Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_supplier as $supplier): ?>
                <tr>
                    <td style="border: 1px solid black; padding: 8px; text-align:center"><?= $no++ ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $supplier->kode_supplier ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $supplier->nama ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $supplier->telepon ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $supplier->email ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?= $supplier->alamat ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>