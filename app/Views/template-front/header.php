<?php
    use App\Models\KonfigurasiModel;
    $this->konfigurasi = new KonfigurasiModel();

    $template = $this->konfigurasi->getData();
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

<link href="<?php echo base_url() ?>/assets/https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Nunito+Sans:wght@300;600;700;800;900&display=swap" rel="stylesheet">

<!-- Color Switcher Mockup -->
<link href="<?php echo base_url() ?>/assets/css/color-switcher-design.css" rel="stylesheet">

<!-- Color Themes -->
<link id="theme-color-file" href="<?php echo base_url() ?>/assets/css/color-themes/default-theme.css" rel="stylesheet">

<link rel="shortcut icon" href="<?=base_url('/assets-cms/img/konfigurasi/logo.png')?>" type="image/x-icon">
<link rel="icon" href="<?=base_url('/assets-cms/img/konfigurasi/logo.png')?>" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
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
							<li><a href="mailto:<?=$template->email?>"><span class="icon flaticon-email"></span> <?=$template->email?></a></li>
							<li><a href="tel:<?=$template->telephone?>"><span class="icon flaticon-telephone"></span> <?=$template->telephone?></a></li>
						</ul>
					</div>
					
					<!-- Top Right -->
                    <div class="top-right pull-right">
						<!-- Social Box -->
						<ul class="social-box">
							<li><a href="#" class="fa fa-facebook-f"></a></li>
							<li><a href="#" class="fa fa-twitter"></a></li>
							<li><a href="#" class="fa fa-dribbble"></a></li>
							<li><a href="#" class="fa fa-google"></a></li>
						</ul>
                    </div>
					
                </div>
            </div>
        </div>
		
		<!--Header-Upper-->
        <div class="header-upper">
        	<div class="auto-container clearfix">
            	
				<div class="pull-left logo-box">
					<div class="logo"><a href="<?php echo base_url('/') ?>"><img src="<?=$template->logo_url?>" style="height:60px" alt="" title=""></a></div>
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
								<li class="<?= ($title=='Home') ? 'current' : '';?>" >
                                    <a href="<?php echo base_url('/') ?>">Home</a>
								</li>
								<li class="dropdown <?= ($title=='Profil') ? 'current' : '';?>"><a href="#">Profil</a>
									<ul>
										<li><a href="<?php echo base_url('/tentang-kami') ?>">Tentang Kami</a></li>
										<li><a href="<?php echo base_url('/galeri-produk') ?>">Galeri Produk</a></li>
									</ul>
								</li>
								<li class="dropdown <?= ($title=='Produk') ? 'current' : '';?>"><a href="#">Produk</a>
									<ul>
										<li class="dropdown">
                                            <a href="<?php echo base_url() ?>/assets/services.html">Trading</a>
                                            <ul>
                                                <li>1</li>
                                                <li>2</li>
                                                <li>3</li>
                                            </ul>
                                        </li>
										<li class="dropdown">
                                            <a href="<?php echo base_url() ?>/assets/services.html">Fabrikasi</a>
                                            <ul>
                                                <li>1</li>
                                                <li>2</li>
                                                <li>3</li>
                                            </ul>
                                        </li>
									</ul>
								</li>
								<li class="<?= ($title=='Portfolio') ? 'current' : '';?>"><a href="<?php echo base_url('/portfolio') ?>">Portfolio</a>
								</li>
								<li class="<?= ($title=='Artikel') ? 'current' : '';?>"><a href="<?php echo base_url('/blog') ?>">Artikel & Berita</a></li>
							</ul>
						</div>
					</nav>
					
					<!-- Main Menu End-->
					<div class="outer-box clearfix">
						
						<!-- Search Btn -->
						<div class="search-box-btn search-box-outer"><span class="icon fa fa-search"></span></div>
						
						<!-- Nav Btn -->
						<div class="nav-btn navSidebar-button"><span class="icon flaticon-menu-2"></span></div>
						
						<!-- Quote Btn -->
						<div class="btn-box">
							<a href="<?php echo base_url() ?>/assets/contact.html" class="theme-btn btn-style-one"><span class="txt">Kontak Kami</span></a>
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
                    <a href="<?php echo base_url('/') ?>" title=""><img src="<?=$template->logo_url?>" style="height:60px" alt="" title=""></a>
                </div>
                <!--Right Col-->
                <div class="pull-right">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav><!-- Main Menu End-->
					
					<!-- Main Menu End-->
					<div class="outer-box clearfix">
						<!-- Search Btn -->
						<div class="search-box-btn search-box-outer"><span class="icon fa fa-search"></span></div>
						
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
                <div class="nav-logo"><a href="<?php echo base_url('/') ?>"><img src="<?=$template->logo_url?>" alt="" title=""></a></div>
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
					
					<!-- Sidebar Info Content -->
					<div class="sidebar-info-contents">
						<div class="content-inner">
							<div class="logo">
								<a href="<?php echo base_url('/') ?>"><img src="<?=$template->logo_url?>" alt="" /></a>
							</div>
							<div class="content-box">
								<h2>Tentang Kami</h2>
								<p class="text">The argument in favor of using filler text goes something like this: If you use real content in the Consulting Process, anytime you reach a review point you’ll end up reviewing and negotiating the content itself and not the design.</p>
								<a href="#" class="theme-btn btn-style-two"><span class="txt">Consultation</span></a>
							</div>
							<div class="contact-info">
								<h2>Contact Info</h2>
								<ul class="list-style-one">
									<li><span class="icon fa fa-location-arrow"></span>Chicago 12, Melborne City, USA</li>
									<li><span class="icon fa fa-phone"></span>(111) 111-111-1111</li>
									<li><span class="icon fa fa-envelope"></span>globex@gmail.com</li>
									<li><span class="icon fa fa-clock-o"></span>Week Days: 09.00 to 18.00 Sunday: Closed</li>
								</ul>
							</div>
							<!-- Social Box -->
							<ul class="social-box">
								<li class="facebook"><a href="#" class="fa fa-facebook-f"></a></li>
								<li class="twitter"><a href="#" class="fa fa-twitter"></a></li>
								<li class="linkedin"><a href="#" class="fa fa-linkedin"></a></li>
								<li class="instagram"><a href="#" class="fa fa-instagram"></a></li>
								<li class="youtube"><a href="#" class="fa fa-youtube"></a></li>
							</ul>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<!-- END sidebar widget item -->
	