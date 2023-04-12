<div id="content" class="app-content app-footer-fixed mb-5">
    <div class="row mb-md-3 mb-2">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><?= $mymenu ?></li>
                <li class="breadcrumb-item active"><?= $mysubmenu ?></li>
            </ul>
            <div class="card mb-3">
                <div class="card-header d-flex">
                    <span class="flex-grow-1"><b>Struktur Organisasi</b></span>
                    <button type="button" class="btn btn-sm btn-primary add" data-bs-toggle="modal" data-bs-target="#modal-default"><i class="fa fa-plus-circle"></i> <b>Struktur Oraganisasi</b></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-hover text-nowrap" style="width:100%">
                            <thead>
                                <th width="15%">Photo</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th width="12%">Sosial Media</th>
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

<div class="modal modal-cover fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form role="form" id="form">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="foto">Foto</label><br>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" onchange="preview_image2 (event)">
                        <input type="hidden" id="foto_" name="foto_" value="">
                        <input type="hidden" id="id" name="id" value="">
                    </div>
                    <div class="form-group mb-3" style="display:none" id="row-display2">
                        <hr>
                        <label for="output_image">Preview foto</label>
                        <div class="mt-2">
                            <img id="output_image2" class="img-thumbnail" width="200" />
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="link_ig">URL Instagram</label>
                        <input type="text" class="form-control" id="link_ig" name="link_ig">
                    </div>
                    <div class="form-group mb-3">
                        <label for="link_fb">URL Facebook</label>
                        <input type="text" class="form-control" id="link_fb" name="link_fb">
                    </div>
                    <div class="form-group mb-3">
                        <label for="link_fb">URL LinkedIn</label>
                        <input type="text" class="form-control" id="link_linkedin" name="link_linkedin">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type='button' class='btn btn-default' id="hide" data-bs-dismiss='modal'>Batal</button>
                    <button class="btn btn-primary save btn-name submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>