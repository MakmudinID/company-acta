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
                    <button type="button" class="btn btn-sm btn-primary add"><i class="fa fa-plus-circle"></i> <b>Portfolio</b></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-hover text-nowrap" style="width:100%">
                            <thead>
                                <th width="5%">No</th>
                                <th width="15%">Photo</th>
                                <th>Client</th>
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
<div class="modal modal-cover fade" id="mdl-portfolio">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Portfolio</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form role="form" id="form">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input class="form-control" id="title" name="title">
                            <input type="hidden" id="id" name="id">
                        </div>
                        <div class="form-group col-md-6 mb-3" id="create">
                            <label for="tag">Tag</label>
                            <input type="text" class="some_class_name" id="tag" name="tag" placeholder="write some tags">
                        </div>
                        <div class="form-group col-md-6 mb-3" id="edit" style="display:none">
                            <label for="tags">Tag</label>
                            <input type="text" class="some_class_name" id="tags" name="tags" placeholder="write some tags">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control summernote" id="deskripsi" name="deskripsi"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="client">Client <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="client" name="client" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="location_project">Lokasi Client <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="location_project" name="location_project" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="date_project">Tanggal Projek <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_project" name="date_project" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="status">
                                    <option></option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="photo">Photo <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="photo" onchange="preview_image(event)" id="photo">
                                <input type="hidden" class="form-control" name="photo_url" id="photo_url">
                            </div>
                        </div>
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