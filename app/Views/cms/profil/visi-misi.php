<div id="content" class="app-content app-footer-fixed mb-5">
    <div class="row align-items-center mb-md-3 mb-2">
        <div class="col-xl-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><?=$mymenu?></li>
                <li class="breadcrumb-item active"><?=$mysubmenu?></li>
            </ul>
			<div class="card mb-3">
				<div class="card-header d-flex">
					<span class="flex-grow-1"><b><?php echo $mysubmenu ?></b></span>
					<button type="button" class="btn btn-sm btn-primary add" data-bs-toggle="modal" data-bs-target="#modal-default"><i class="fa fa-plus-circle"></i> <b>Visi Misi</b></button>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="table" class="table table-striped table-hover text-nowrap" style="width:100%">
							<thead>
								<th>Flag</th>
								<th>Deskripsi</th>
								<th width="10">Status</th>
								<th></th>
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
                        <label for="kategori">Flag</label>
                        <select class="form-control" name="kategori" id="kategori">
                            <option></option>
                            <option value="VISI">VISI</option>
                            <option value="MISI">MISI</option>
                        </select>
                    </div>
					<div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option></option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
					<input type="hidden" name="id" id="id">
                    <button type="submit" class="btn btn-primary save btn-name">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>