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
					<button type="button" class="btn btn-sm btn-primary add" data-bs-toggle="modal" data-bs-target="#modal-default"><i class="fa fa-plus-circle"></i> <b>User Admin</b></button>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="table" class="table table-striped table-hover text-nowrap" style="width:100%">
							<thead>
								<th width="5%">No</th>
								<th>Image</th>
								<th>Nama</th>
								<th>Email</th>
								<th>Role</th>
								<th width="10%">Status</th>
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
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group mb-3">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" id="role">
                            <option></option>
                            <option value="ADMIN">Admin</option>
                            <option value="SUPERADMIN">Super Admin</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option></option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="gambar">Gambar</label><br>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" onchange="preview_image(event)">
                        <input type="hidden" id="gambar_" name="gambar_" value="">
                        <input type="hidden" id="id" name="id" value="">
                    </div>
                    <div class="form-group mb-3" style="display:none" id="row-display">
                        <hr>
                        <label for="output_image">Preview Gambar</label>
                        <div class="mt-2">
                            <img id="output_image" class="img-thumbnail" width="200"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
					<input type="hidden" name="id" id="id">
                    <button type='button' class='btn btn-default' id="hide" data-bs-dismiss='modal'>Batal</button>
                    <button type="submit" class="btn btn-primary save btn-name">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>