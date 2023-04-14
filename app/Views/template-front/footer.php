<!-- Main Footer -->
<footer class="main-footer">
	<div class="pattern-layer-one" style="background-image: url(images/background/pattern-7.png)"></div>
	<div class="pattern-layer-two" style="background-image: url(images/background/pattern-8.png)"></div>
	<!--Waves end-->
	<div class="auto-container">
		<!--Widgets Section-->
		<div class="widgets-section">
			<div class="row clearfix">

				<!-- Footer Column -->
				<div class="footer-column col-lg-6 col-md-6 col-sm-12">
					<div class="footer-widget logo-widget">
						<div class="logo">
							<h5><?= $konfigurasi->nama_company; ?></h5>
						</div>
						<div class="text"><?= $konfigurasi->tagline; ?></div>
						<!-- Social Box -->
						<ul class="social-box">
							<?php if ($konfigurasi->facebook != '') : ?>
								<li><a href="<?= $konfigurasi->facebook ?>" class="fa fa-facebook-f"></a></li>
							<?php endif; ?>
							<?php if ($konfigurasi->instagram != '') : ?>
								<li><a href="<?= $konfigurasi->instagram ?>" class="fa fa-instagram"></a></li>
							<?php endif; ?>
							<?php if ($konfigurasi->linkedin != '') : ?>
								<li><a href="<?= $konfigurasi->linkedin ?>" class="fa fa-linkedin"></a></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>

				<!-- Footer Column -->
				<div class="footer-column col-lg-2 col-md-6 col-sm-12">
					<div class="footer-widget links-widget">
						<h5>Quick Links</h5>
						<ul class="list-link">
							<li><a href="<?=base_url('/tentang-kami')?>">Tentang Kami</a></li>
							<li><a href="<?=base_url('/galeri-produk')?>">Galeri Produk</a></li>
							<li><a href="<?=base_url('/portfolio')?>">Portfolio</a></li>
							<li><a href="<?=base_url('/blog')?>">Artikel & Berita</a></li>
						</ul>
					</div>
				</div>

				<!-- Footer Column -->
				<div class="footer-column col-lg-4 col-md-6 col-sm-12">
					<div class="footer-widget contact-widget">
						<h5>Kontak Kami</h5>
						<ul>
							<li>
								<span class="icon flaticon-placeholder-2"></span>
								<strong>Alamat</strong>
								<?= $konfigurasi->alamat;?>
							</li>
							<li>
								<span class="icon flaticon-phone-call"></span>
								<strong>Telephone</strong>
								<a href="tel:<?= $konfigurasi->telephone ?>"><?= $konfigurasi->telephone ?></a>
							</li>
							<li>
								<span class="icon flaticon-email-1"></span>
								<strong>E-Mail</strong>
								<a href="mailto:mailto:<?= $konfigurasi->email ?>"><?= $konfigurasi->email ?></a>
							</li>
						</ul>
					</div>
				</div>

			</div>
		</div>

	</div>

	<!-- Footer Bottom -->
	<div class="footer-bottom">
		<div class="auto-container">
			<div class="row clearfix">
				<!-- Column -->
				<div class="column col-lg-12 col-md-12 col-sm-12">
					<div class="copyright">Copyright &copy; <?= date('Y')?> by ArrasyidTech. All Rights Reserved.</div>
				</div>
			</div>
		</div>
	</div>

	</div>
</footer>
</div>
<!--End pagewrapper-->

<!-- Search Popup -->
<div class="search-popup">
	<button class="close-search style-two"><span class="flaticon-multiply"></span></button>
	<button class="close-search"><span class="flaticon-up-arrow-1"></span></button>
	<form method="post" action="blog.html">
		<div class="form-group">
			<input type="search" name="search-field" value="" placeholder="Search Here" required="">
			<button type="submit"><i class="fa fa-search"></i></button>
		</div>
	</form>
</div>
<!-- End Header Search -->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>

<script src="<?php echo base_url() ?>/assets/js/jquery.js"></script>
<script src="<?php echo base_url() ?>/assets/js/popper.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url() ?>/assets/js/appear.js"></script>
<script src="<?php echo base_url() ?>/assets/js/mixitup.js"></script>
<script src="<?php echo base_url() ?>/assets/js/parallax.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/tilt.jquery.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/jquery.paroller.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/owl.js"></script>
<script src="<?php echo base_url() ?>/assets/js/wow.js"></script>
<script src="<?php echo base_url() ?>/assets/js/nav-tool.js"></script>
<script src="<?php echo base_url() ?>/assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url() ?>/assets/js/jquery.bootstrap-touchspin.js"></script>
<script src="<?php echo base_url() ?>/assets/js/script.js"></script>
<script src="<?php echo base_url() ?>/assets/js/color-settings.js"></script>

<script>
	var timeout = 3000; // in miliseconds (3*1000)
	$('.tutup').delay(timeout).fadeOut(300);
	let base_url = '<?php echo base_url(); ?>';
</script>
<?php if (isset($js)) : foreach ($js as $j) : ?>
		<script src="<?php echo base_url() ?>/assets/<?php echo base_url() ?>/assets-cms/js/myjs/<?php echo $j ?>"></script>
<?php endforeach;
endif; ?>

</body>

</html>