<?php

use Hashids\Hashids;

$hashids = new Hashids('53qURe_produk_price', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
?>
<div class="form-group mb-3">
    <label for="nama">Judul <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="judul" name="judul" value="<?= $produk->judul ?>">
    <input type="hidden" class="form-control" id="id" name="id" value="<?= $hashids->encode($produk->id) ?>">
</div>
<div class="form-group mb-3">
    <label for="ringkasan">Ringkasan <span class="text-danger">*</span></label>
    <textarea class="form-control" id="ringkasan" name="ringkasan" rows="5"><?= $produk->keterangan ?></textarea>
</div>
<div class="form-group mb-3">
    <label for="harga">Harga Mulai Dari <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="harga" name="harga" value="<?= $produk->harga ?>">
</div>
<div class="form-group mb-3">
    <label for="harga">Fitur <span class="text-danger">*</span></label>
    <?php if (count($fitur) > 0) : ?>
        <?php $i = 99;
        foreach ($fitur as $f) : ?>
            <div id="list-fitur-edit-<?= $i ?>">
                <div class="row <?= ($i > 99) ? "mt-3" : "" ?>">
                    <div class="col-md-10 mb-2">
                        <input type="text" class="form-control" id="fitur-<?= $i ?>" name="fitur[]" value="<?= $f->deskripsi ?>">
                    </div>
                    <div class="col-md-2 mb-2">
                        <?php if ($i > 99) : ?>
                            <button type="button" class="btn btn-danger w-100 delete-fitur-edit" id="<?=$i?>"><i class="fa fa-trash"></i></button>
                        <?php else : ?>
                            <button type="button" class="btn btn-success w-100 add-fitur"><i class="fa fa-plus-circle"></i></button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php $i++; endforeach; ?>
    <?php else : ?>
        <div class="row">
            <div class="col-md-8">
                <input type="text" class="form-control" id="fitur-0" name="fitur[]" required>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-success w-100 add-fitur"><i class="fa fa-plus-circle"></i> Fitur</button>
            </div>
        </div>
    <?php endif; ?>
    <div id="list-fitur"></div>
</div>