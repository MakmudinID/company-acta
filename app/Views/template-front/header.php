<?php

use App\Models\KonfigurasiModel;

$this->konfigurasi = new KonfigurasiModel();

$template = $this->konfigurasi->getData();
$kategori_produk = $this->konfigurasi->getKategoriProduk();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>ACTA | PT. Astrindo Cipta Teknikatama</title>
	<!-- Stylesheets -->
	<link href="<?php echo base_url() ?>/assets/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>/assets/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>/assets/css/responsive.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Nunito+Sans:wght@300;600;700;800;900&display=swap" rel="stylesheet">

	<!-- Color Switcher Mockup -->
	<link href="<?php echo base_url() ?>/assets/css/color-switcher-design.css" rel="stylesheet">

	<!-- Color Themes -->
	<link id="theme-color-file" href="<?php echo base_url() ?>/assets/css/color-themes/default-theme.css" rel="stylesheet">

	<link rel="shortcut icon" href="<?= base_url('/assets-cms/img/konfigurasi/logo.png') ?>" type="image/x-icon">
	<link rel="icon" href="<?= base_url('/assets-cms/img/konfigurasi/logo.png') ?>" type="image/x-icon">

	<!-- Responsive -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<body class="hidden-bar-wrapper">

	<div class="page-wrapper">

		<!-- Preloader -->
		<div class="preloader"></div>

		<!-- Main Header-->
		<header class="main-header header-style-one">

			<!-- Header Top -->
			<div class="header-top">
				<div class="auto-container">
					<div class="clearfix">
						<!-- Top Left -->
						<div class="top-left">
							<!-- Info List -->
							<ul class="info-list">
								<li><a href="mailto:<?= $template->email ?>"><span class="icon flaticon-email"></span> <?= $template->email ?></a></li>
								<li><a href="tel:<?= $template->telephone ?>"><span class="icon flaticon-telephone"></span> <?= $template->telephone ?></a></li>
							</ul>
						</div>

						<!-- Top Right -->
						<div class="top-right pull-right">
							<!-- Social Box -->
							<ul class="social-box">
								<?php if ($template->facebook != '') : ?>
									<li><a href="<?= $template->facebook ?>" class="fa fa-facebook-f"></a></li>
								<?php endif; ?>
								<?php if ($template->instagram != '') : ?>
									<li><a href="<?= $template->instagram ?>" class="fa fa-instagram"></a></li>
								<?php endif; ?>
								<?php if ($template->linkedin != '') : ?>
									<li><a href="<?= $template->linkedin ?>" class="fa fa-linkedin"></a></li>
								<?php endif; ?>
							</ul>
						</div>

					</div>
				</div>
			</div>

			<!--Header-Upper-->
			<div class="header-upper">
				<div class="auto-container clearfix">

					<div class="pull-left logo-box">
						<div class="logo"><a href="<?php echo base_url('/') ?>"><img src="<?= $template->logo_url ?>" style="height:60px" alt="" title=""></a></div>
					</div>

					<div class="nav-outer clearfix">
						<!--Mobile Navigation Toggler-->
						<div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
						<!-- Main Menu -->
						<nav class="main-menu navbar-expand-md">
							<div class="navbar-header">
								<!-- Toggle Button -->
								<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>

							<div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
								<ul class="navigation clearfix">
									<li class="<?= ($title == 'Home') ? 'current' : ''; ?>">
										<a href="<?php echo base_url('/') ?>">Home</a>
									</li>
									<li class="dropdown <?= ($title == 'Profil') ? 'current' : ''; ?>"><a href="#">Profil</a>
										<ul>
											<li><a href="<?php echo base_url('/tentang-kami') ?>">Tentang Kami</a></li>
											<li><a href="<?php echo base_url('/galeri-produk') ?>">Galeri Produk</a></li>
										</ul>
									</li>
									<li class="dropdown <?= ($title == 'Produk') ? 'current' : ''; ?>"><a href="<?php echo base_url('produk')?>">Produk</a>
										<ul>
											<?php foreach ($kategori_produk as $k) : ?>
												<li>
													<a href="<?php echo base_url('produk-kategori/'.$k->kode) ?>"><?= $k->nama; ?></a>
												</li>
											<?php endforeach; ?>
										</ul>
									</li>
									<li class="<?= ($title == 'Portfolio') ? 'current' : ''; ?>"><a href="<?php echo base_url('/portfolio') ?>">Portfolio</a>
									</li>
									<li class="<?= ($title == 'Artikel') ? 'current' : ''; ?>"><a href="<?php echo base_url('/blog') ?>">Artikel & Berita</a></li>
								</ul>
							</div>
						</nav>

						<!-- Main Menu End-->
						<div class="outer-box clearfix">

							<!-- Nav Btn -->
							<div class="nav-btn navSidebar-button"><span class="icon flaticon-menu-2"></span></div>

							<!-- Quote Btn -->
							<div class="btn-box">
								<a href="https://wa.me/<?=$template->whatsapp?>?text=Saya%20ingin%20konsultasi%20dengan%20ACTA" class="theme-btn btn-style-one"><span class="txt">Kontak Kami</span></a>
							</div>

						</div>
					</div>

				</div>
			</div>
			<!--End Header Upper-->

			<!-- Sticky Header  -->
			<div class="sticky-header">
				<div class="auto-container clearfix">
					<!--Logo-->
					<div class="logo pull-left">
						<a href="<?php echo base_url('/') ?>" title=""><img src="<?= $template->logo_url ?>" style="height:60px" alt="" title=""></a>
					</div>
					<!--Right Col-->
					<div class="pull-right">
						<!-- Main Menu -->
						<nav class="main-menu">
							<!--Keep This Empty / Menu will come through Javascript-->
						</nav><!-- Main Menu End-->

						<!-- Main Menu End-->
						<div class="outer-box clearfix">

							<!-- Nav Btn -->
							<div class="nav-btn navSidebar-button"><span class="icon flaticon-menu"></span></div>

						</div>

					</div>
				</div>
			</div><!-- End Sticky Menu -->

			<!-- Mobile Menu  -->
			<div class="mobile-menu">
				<div class="menu-backdrop"></div>
				<div class="close-btn"><span class="icon flaticon-multiply"></span></div>

				<nav class="menu-box">
					<div class="nav-logo"><a href="<?php echo base_url('/') ?>"><img src="<?= $template->logo_url ?>" alt="" title=""></a></div>
					<div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
				</nav>
			</div><!-- End Mobile Menu -->

		</header>
		<!-- End Main Header -->

		<!-- Sidebar Cart Item -->
		<div class="xs-sidebar-group info-group">
			<div class="xs-overlay xs-bg-black"></div>
			<div class="xs-sidebar-widget">
				<div class="sidebar-widget-container">
					<div class="widget-heading">
						<a href="#" class="close-side-widget">
							X
						</a>
					</div>
					<div class="sidebar-textwidget">
						<div class="sidebar-info-contents">
							<div class="content-inner">
								<div class="logo">
									<a href="<?php echo base_url('/') ?>"><img src="<?= $template->logo_url ?>" alt="" /></a>
								</div>
								<div class="content-box">
									<h2>Tentang Kami</h2>
									<p class="text"><?= $template->tagline;?></p>
									<a href="https://wa.me/<?=$template->whatsapp?>?text=Saya%20ingin%20konsultasi%20dengan%20ACTA" class="theme-btn btn-style-two"><span class="txt">Konsultasi</span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END sidebar widget item -->