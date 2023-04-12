<div id="content" class="app-content app-footer-fixed mb-5">
    <div class="align-items-center mb-md-3 mb-2">
        <div class="col-xl-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><?=$mymenu?></li>
                <li class="breadcrumb-item active"><?=$mysubmenu?></li>
            </ul>
			<div class="card">
				<div class="card-header d-flex">
					<span class="flex-grow-1"><b><?php echo $mysubmenu ?></b></span>
					<button type="button" class="btn btn-sm btn-primary add"><i class="fa fa-plus"></i> <b>Tambah Menu</b></button>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="table" class="table table-striped table-hover text-nowrap" style="width:100%">
							<thead>
								<th width="5%">No. Urut</th>
								<th>Menu</th>
								<th width="25%">URL</th>
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

<div class="modal fade" id="mdl-menu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Menu</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form role="form" id="form">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="urut">No. Urut</label>
                        <input type="number" min="1" class="form-control" id="urut" name="urut">
                        <input type="hidden" class="form-control" id="id" name="id">
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama">Menu</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group mb-3">
                        <label for="url">URL <small><span class="text-danger"><i>(kosongkan jika memiliki submenu)</i></span></small></label>
                        <input type="text" class="form-control" id="url" name="url">
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" name="status">
                            <option></option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
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