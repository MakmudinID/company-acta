<?php

use Hashids\Hashids;
use App\Models\ProdukModel;

$this->produkModel = new ProdukModel();

$hashids = new Hashids('53qURe_produk_price', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
?>
<div id="content" class="app-content app-footer-fixed mb-5">
    <div class="align-items-center mb-md-3 mb-2">
        <div class="col-xl-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><?= $mymenu ?></li>
                <li class="breadcrumb-item active"><?= $mysubmenu ?></li>
            </ul>
            <div class="row">
                <?php foreach ($product_price as $p) : ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header d-flex">
                                <span class="flex-grow-1">
                                    <H4><?= $p->judul ?></H4>
                                </span>
                                <button type="button" class="btn btn-sm btn-primary edit" data-id="<?= $hashids->encode($p->id) ?>"><i class="fa fa-edit"></i> EDIT</button>
                            </div>
                            <div class="card-body">
                                <?= $p->keterangan; ?>
                                <hr>
                                <h3 class="text-center text-primary">
                                    Rp <?= number_format($p->harga, 0, ',', '.'); ?>
                                </h3>
                                <hr>
                                <div class="list-group list-group-flush">
                                    <?php foreach ($this->produkModel->fitur_produk($p->id) as $list) : ?>
                                        <div class="list-group-item d-flex ps-3">
                                            <div class="me-3">
                                                <i class="far fa-lg fa-fw me-2 fa-check-circle"></i>
                                            </div>
                                            <div class="flex-fill">
                                                <?= $list->deskripsi;?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-cover fade" id="modal-produk-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold">Edit Pilihan Harga</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="form">
                    <div id="content-produk-edit"></div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-default" id="hide" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary save btn-name">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>