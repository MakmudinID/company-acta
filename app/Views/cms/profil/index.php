<?php $validation = \Config\Services::validation(); ?>
<div id="content" class="app-content app-footer-fixed mb-5">
    <div class="row align-items-center mb-md-3 mb-2">
        <div class="col-xl-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><?= $mymenu ?></li>
                <li class="breadcrumb-item active"><?= $mysubmenu ?></li>
            </ul>
        </div>
        <div class="col-md-3">
            <div class="profile-header">
                <div class="profile-header-cover"></div>
                <div class="profile-header-content">
                    <div class="profile-header-img">
                        <img src="<?php echo session()->get('admin_photo'); ?>" alt="<?php echo session()->get('admin_name'); ?>" class="img-fluid"/>
                    </div>
                </div>
            </div>
            <div class="profile-sidebar mt-4">
                <div class="desktop-sticky-top">
                    <h4><?php echo session()->get('admin_name'); ?></h4>
                    <div class="font-weight-600 mb-3 text-muted mt-n2">
                        <?php echo session()->get('admin_email'); ?>
                    </div>
                    <div class="font-weight-600 mb-3 mt-n2">
                       ROLE: <?php echo session()->get('admin_role'); ?>
                    </div>
                    <hr class="mt-2 mb-3" />
                    <div class="card mb-3">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item font-weight-600 pl-3 pr-3 d-flex">
                                <span class="flex-fill">Last Login</span>
                            </div>
                            <div class="list-group-item pl-3 pr-3">
                                <?php echo session()->get('admin_last_login'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
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
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="tab-content p-0">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <span class="flex-fill font-weight-600">Edit Profil</span>
                                </div>
                                <div class="card-body">
                                    
                                    <form action="<?= base_url('cms/update-profile'); ?>" method="POST" enctype="multipart/form-data" class="myform" id="myform">
                                    <?= csrf_field()?>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="username" placeholder="Email/Username" disabled readonly value="<?php echo session()->get('admin_email'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required="" value="<?php echo session()->get('admin_name'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Old Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="oldpassword" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-2 col-form-label">Retype Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="repassword" placeholder="Retype Password">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-form-label col-sm-2">Photo URL</label>
                                        <div class="col-sm-10">
                                            <div class="custom-file">
                                                <input type="file" class="form-control" name="myphoto" id="myphoto" />
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary" id="btn-submit-profile">Save</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>