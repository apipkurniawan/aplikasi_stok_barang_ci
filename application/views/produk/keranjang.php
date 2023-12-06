<tr class="row-keranjang">
    <td class="bahan_baku">
        <?= $this->input->post('bahan_baku') ?>
        <input type="hidden" name="bahan_baku_hidden[]" value="<?= $this->input->post('bahan_baku') ?>">
    </td>
    <td class="qty">
        <?= $this->input->post('qty') ?>
        <input type="hidden" name="qty_hidden[]" value="<?= $this->input->post('qty') ?>">
    </td>
    <td class="satuan">
        <?= strtolower($this->input->post('satuan')) ?>
        <input type="hidden" name="satuan_hidden[]" value="<?= $this->input->post('satuan') ?>">
    </td>
    <td class="aksi">
        <button type="button" class="btn btn-danger btn-sm" id="tombol-hapus"
            data-bahan-baku="<?= $this->input->post('kode_barang') ?>"><i class="fa fa-trash"></i></button>
    </td>
</tr>