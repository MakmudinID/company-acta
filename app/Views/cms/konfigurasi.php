<?php $validation = \Config\Services::validation(); ?>
<div id="content" class="app-content app-footer-fixed mb-5">
    <div class="row align-items-center mb-md-3 mb-2">
        <div class="col-xl-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><?= $mymenu ?></li>
                <li class="breadcrumb-item active"><?= $mysubmenu ?></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="profile-content">
                <div class="text-muted">
                    <?php if ($validation->getErrors()) : ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif ?>
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?= $error ?>
                        </div>
                    <?php endif ?>
                </div>
                <form action="<?= base_url('cms/update-konfigurasi'); ?>" method="POST" enctype="multipart/form-data" class="myform" id="myform">
                    <?= csrf_field() ?>
                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <span class="flex-fill font-weight-600">Konfigurasi Profil Web</span>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_company" required value="<?php echo $data->nama_company ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Nama Populer</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_populer" required value="<?php echo $data->nama_populer ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Profil Singkat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="tagline" required rows="5"><?php echo $data->tagline ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Profil Perusahaan</label>
                                        <div class="col-sm-10">
                                            <textarea class="summernote" name="deskripsi" required><?php echo $data->deskripsi ?></textarea>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="col-form-label">Logo Perusahaan</label>
                                                    <input type="file" class="form-control" name="logo_url" id="logo_url" accept="image/*" onchange="preview_logo(event)" />
                                                    <hr>
                                                    <label class="form-label"><b>Preview Logo</b></label><br>
                                                    <img id="output_image" src="<?= $data->logo_url ?>" class="img-thumbnail" width="200" />
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="col-form-label">Image Profil Perusahaan</label>
                                                    <input type="file" class="form-control" name="profil_url" id="profil_url" accept="image/*" onchange="preview_profil(event)" />
                                                    <hr>
                                                    <label class="form-label"><b>Preview Profil</b></label><br>
                                                    <img id="output_image_profil" src="<?= $data->profil_url ?>" class="img-thumbnail" width="200" />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Alamat Perusahaan</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="alamat"><?php echo $data->alamat; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Kota Perusahaan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="kota" value="<?php echo $data->kota; ?>"></input>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Alamat URL Maps</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="google_maps"><?php echo $data->google_maps; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" value="<?php echo $data->email; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Telp.</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="telephone" value="<?php echo $data->telephone; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">WhatsApp</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="whatsapp" value="<?php echo $data->whatsapp; ?>">
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-4 mb-3">
                                            <label class="col-form-label">URL Instagram</label>
                                            <input type="text" class="form-control" name="instagram" value="<?= $data->instagram ?>">
                                        </div>
                                        <div class="form-group col-md-4 mb-3">
                                            <label class="col-form-label">URL Facebook</label>
                                            <input type="text" class="form-control" name="linkedin" value="<?= $data->linkedin ?>">
                                        </div>
                                        <div class="form-group col-md-4 mb-3">
                                            <label class="col-form-label">URL Youtube</label>
                                            <input type="text" class="form-control" name="youtube" value="<?= $data->youtube ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <span class="flex-fill font-weight-600">Layanan Perusahaan Yang Diberikan</span>
                                </div>
                                <div class="card-body">
                                    <h4>Layanan Ke-1</h4>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Judul</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_company" required value="<?php echo $data->nama_company ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="nama_company" required><?php echo $data->nama_company ?></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Layanan Ke-2</h4>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Judul</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_company" required value="<?php echo $data->nama_company ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="nama_company" required><?php echo $data->nama_company ?></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Layanan Ke-3</h4>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Judul</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_company" required value="<?php echo $data->nama_company ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="nama_company" required><?php echo $data->nama_company ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>