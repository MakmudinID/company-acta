<?php 
use Hashids\Hashids;
$hashids = new Hashids('53qURe_gallery', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
?>
<div id="content" class="app-content app-footer-fixed mb-5">
    <div class="align-items-center mb-md-3 mb-2">
        <div class="col-xl-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><?= $mymenu ?></li>
                <li class="breadcrumb-item active"><?= $mysubmenu ?></li>
            </ul>
            <div class="card">
                <div class="card-header d-flex">
                    <span class="flex-grow-1"><b><?php echo $mysubmenu ?></b></span>
                    <button type="button" class="btn btn-sm btn-primary add"><i class="fa fa-plus-circle"></i> <b>Galeri Produk</b></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-hover text-nowrap" style="width:100%">
                            <thead>
                                <th width="5%">No</th>
                                <th>Produk</th>
                                <th width="15%">Galeri</th>
                                <th>Judul</th>
                                <th>Keterangan</th>
                                <th width="10%">Status</th>
                                <th width="12%"></th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-cover fade" id="mdl-produk-gallery">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Galeri Produk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form role="form" id="form">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="produk">Produk <span class="text-danger">*</span></label>
                        <select class="form-control" name="produk" id="produk">
                            <option></option>
                            <?php foreach($produk as $p): ?>
                                <option value="<?=$hashids->encode($p->id)?>"><?= $p->nama;?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="title">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group mb-3">
                        <label for="caption">Keterangan <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="caption" name="caption"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status">
                            <option></option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="photo">Photo <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="photo" onchange="preview_image(event)" id="photo">
                        <input type="hidden" class="form-control" name="photo_url" id="photo_url">
                        <input type="hidden" class="form-control" name="id" id="id">
                    </div>
                    <div class="form-group row mb-3" id="row-display" style="display:none">
                        <div class="col-sm-6">
                            <label class="form-label" for="preview"><b>Preview Photo</b></label><br>
                            <img id="output_image" class="img-thumbnail" width="200" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type='button' class='btn btn-default' id="hide" data-bs-dismiss='modal'>Batal</button>
                    <button type="submit" class="btn btn-primary save btn-name">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>