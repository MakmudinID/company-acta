<?php
$this->role = \Config\Services::role();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Admin</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="Passion For Innovation" name="description" />
	<meta content="PT. ASTRINDO CIPTA TEKNIKATAMA" name="author" />
	<meta name="csrf_token" content="<?= csrf_hash() ?>">
	<meta name="csrf" content="<?= csrf_token() ?>">
	<!-- Favicon  -->
	<link rel="icon" type="image/x-icon" href="<?=base_url('/assets-cms/img/konfigurasi/logo.png')?>">
	<meta name="theme-color" content="#ffffff">

	<!-- ================== BEGIN core-css ================== -->
	<link href="<?php echo base_url(); ?>/assets-cms/css/vendor.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>/assets-cms/css/app.min.css" rel="stylesheet" />
	<!-- ================== END core-css ================== -->

	<!-- ================== BEGIN page-css ================== -->
	<link href="<?php echo base_url(); ?>/assets-cms/plugins/popover/jquery.webui-popover.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>/assets-cms/plugins/photoswipe/photoswipe.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>/assets-cms/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>/assets-cms/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>/assets-cms/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>/assets-cms/plugins/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>/assets-cms/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>/assets-cms/plugins/blueimp-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
	<?php if (isset($vendorcss)) : foreach ($vendorcss as $j) : ?>
			<link href="<?php echo base_url(); ?>/assets-cms/plugins/<?php echo $j ?>" rel="stylesheet" />
	<?php endforeach;
	endif; ?>
	<link href="<?php echo base_url(); ?>/assets-cms/plugins/select2/select2.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>/assets-cms/css/digitalazhar.css" rel="stylesheet" />
	<!-- ================== END page-css ================== -->
	<link href="<?php echo base_url(); ?>/assets-cms/plugins/summernote/summernote-lite.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>/assets-cms/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>/assets-cms/css/tagify.min.css" rel="stylesheet" />
</head>

<body>
	<!-- BEGIN #app -->
	<div id="app" class="app app-content-full-height">
		<!-- BEGIN #header -->
		<header id="header" class="app-header">
			<!-- BEGIN mobile-toggler -->
			<div class="mobile-toggler">
				<button type="button" class="menu-toggler" data-toggle="sidebar-mobile">
					<span class="bar"></span>
					<span class="bar"></span>
				</button>
			</div>
			<!-- END mobile-toggler -->

			<!-- BEGIN brand -->
			<div class="brand">
				<div class="desktop-toggler">
					<button type="button" class="menu-toggler" data-toggle="sidebar-minify">
						<span class="bar"></span>
						<span class="bar"></span>
					</button>
				</div>
				<a href="<?= base_url() ?>" class="brand-logo">
					CMS - ACTA
				</a>
			</div>
			<!-- END brand -->

			<!-- BEGIN menu -->
			<div class="menu">
				<form class="menu-search" method="POST" name="header_search_form">
					<a href="#" target="_blank" class="btn btn-block btn-secondary font-weight-600 rounded-pill">
						<i class="fa fa-file-pdf mr-1 ml-n1 opacity-5"></i> Panduan Admin
					</a>
				</form>
				<div class="menu-item dropdown">
					<a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">
						<div class="menu-img online">
							<img src="<?= session()->get('admin_photo') ?>" alt="" style="width: 50px; height: 50px;" class="mw-100 mh-100 rounded-circle" />
						</div>
						<div class="menu-text"><?= session()->get('admin_name'); ?></div>
					</a>
					<div class="dropdown-menu dropdown-menu-right me-lg-3">
						<a class="dropdown-item d-flex align-items-center" href="<?= base_url('/cms/user-profile') ?>"><i class="fa fa-user-circle"></i> &nbsp; Edit Profile</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item d-flex align-items-center" id="logout" href="#" role="button"><i class="fas fa-sign-out-alt"></i> &nbsp; Log Out</a>
					</div>
				</div>
			</div>
			<!-- END menu -->
		</header>
		<!-- END #header -->

		<!-- BEGIN #sidebar -->
		<sidebar id="sidebar" class="app-sidebar">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="menu-header">Produk</div>
					<div class="menu-item <?= ($mysubmenu == 'DAFTAR PRODUK') ? 'active' : '' ?>">
						<a href="<?php echo base_url(); ?>/cms/product" class="menu-link">
							<span class="menu-icon"><i class="fas fa-cubes"></i></span>
							<span class="menu-text">Produk</span>
						</a>
					</div>
					<div class="menu-item <?= ($mysubmenu == 'PRODUK KATEGORI') ? 'active' : '' ?>">
						<a href="<?php echo base_url(); ?>/cms/product-category" class="menu-link">
							<span class="menu-icon"><i class="fas fa-list"></i></span>
							<span class="menu-text">Produk Kategori</span>
						</a>
					</div>
					<div class="menu-item <?= ($mysubmenu == 'GALERI PRODUK') ? 'active' : '' ?>">
						<a href="<?php echo base_url(); ?>/cms/produk-gallery" class="menu-link">
							<span class="menu-icon"><i class="far fa-images"></i></span>
							<span class="menu-text">Galeri Produk</span>
						</a>
					</div>
					<div class="menu-divider"></div>
					<div class="menu-header">Data</div>
					<div class="menu-item <?= ($mysubmenu == 'BLOG') ? 'active' : '' ?>">
						<a href="<?php echo base_url(); ?>/cms/blog" class="menu-link">
							<span class="menu-icon"><i class="fas fa-rss"></i></span>
							<span class="menu-text">Blog</span>
						</a>
					</div>
					<div class="menu-item <?= ($mysubmenu == 'MITRA') ? 'active' : '' ?>">
						<a href="<?php echo base_url(); ?>/cms/mitra" class="menu-link">
							<span class="menu-icon"><i class="far fa-handshake"></i></span>
							<span class="menu-text">Mitra</span>
						</a>
					</div>
					<div class="menu-item <?= ($mysubmenu == 'PORTFOLIO') ? 'active' : '' ?>">
						<a href="<?php echo base_url(); ?>/cms/portfolio" class="menu-link">
							<span class="menu-icon"><i class="fa fa-address-card"></i></span>
							<span class="menu-text">Portfolio</span>
						</a>
					</div>
					<div class="menu-item <?= ($mysubmenu == 'TESTIMONI') ? 'active' : '' ?>">
						<a href="<?php echo base_url(); ?>/cms/testimoni" class="menu-link">
							<span class="menu-icon"><i class="fa fa-comments"></i></span>
							<span class="menu-text">Testimoni</span>
						</a>
					</div>
					<div class="menu-divider"></div>
					<div class="menu-header">Konfigurasi</div>
					<div class="menu-item <?= ($mysubmenu == 'PROFIL') ? 'active' : '' ?>">
						<a href="<?php echo base_url(); ?>/cms/user-profile" class="menu-link">
							<span class="menu-icon"><i class="fa fa-user-circle"></i></span>
							<span class="menu-text">Profil</span>
						</a>
					</div>
					<?php if (session()->get('admin_role') == 'SUPERADMIN') : ?>
						<div class="menu-item <?= ($mysubmenu == 'USER ADMIN') ? 'active' : '' ?>">
							<a href="<?php echo base_url(); ?>/cms/user" class="menu-link">
								<span class="menu-icon"><i class="fa fa-users"></i></span>
								<span class="menu-text">User Admin</span>
							</a>
						</div>
					<?php endif; ?>
					<div class="menu-item <?= ($mysubmenu == 'STRUKTUR ORGANISASI') ? 'active' : '' ?>">
						<a href="<?php echo base_url(); ?>/cms/struktur-organisasi" class="menu-link">
							<span class="menu-icon"><i class="fas fa-sitemap"></i></span>
							<span class="menu-text">Struktur Organisasi</span>
						</a>
					</div>
					<div class="menu-item <?= ($mysubmenu == 'SLIDER') ? 'active' : '' ?>">
						<a href="<?php echo base_url(); ?>/cms/slider" class="menu-link">
							<span class="menu-icon"><i class="far fa-images"></i></span>
							<span class="menu-text">Slider</span>
						</a>
					</div>
					<div class="menu-item <?= ($mysubmenu == 'VISI-MISI') ? 'active' : '' ?>">
						<a href="<?php echo base_url(); ?>/cms/visi-misi" class="menu-link">
							<span class="menu-icon"><i class="fas fa-list"></i></span>
							<span class="menu-text">Visi & Misi</span>
						</a>
					</div>
					<?php if (session()->get('admin_role') == 'SUPERADMIN') : ?>
						<div class="menu-item <?= ($mysubmenu == 'WEB') ? 'active' : '' ?>">
							<a href="<?php echo base_url(); ?>/cms/konfigurasi" class="menu-link">
								<span class="menu-icon"><i class="fa fa-cog"></i></span>
								<span class="menu-text">Web</span>
							</a>
						</div>
					<?php endif; ?>
					<div class="footer mt-auto bg-secondary" style="position: fixed; right: 0; bottom: 0; border-top-left-radius: 8px;">
						<div class="container">
							Developed By <b><a href="https://wehoot.id/" target="blank_">wehoot.id</a></b> <?= date('Y'); ?>. All rights reserved
						</div>
					</div>
				</div>
				<!-- END menu -->
			</div>
			<!-- END scrollbar -->
			<!-- BEGIN mobile-sidebar-backdrop -->
			<button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>
			<!-- END mobile-sidebar-backdrop -->
		</sidebar>
		<!-- END #sidebar -->