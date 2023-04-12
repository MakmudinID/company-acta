<?php $validation = \Config\Services::validation(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>CMS - Acta</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content=" PT. ASTRINDO CIPTA TEKNIKATAMA" name="description" />
	<meta content="ACTA" name="author" />
	<link rel="icon" type="image/x-icon" href="https://alazharpeduli.oss-ap-southeast-5.aliyuncs.com/asset/favicon.ico">

	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>/assets-cms/img/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>/assets-cms/img/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>/assets-cms/img/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>/assets-cms/img/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>/assets-cms/img/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>/assets-cms/img/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>/assets-cms/img/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>/assets-cms/img/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>/assets-cms/img/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url(); ?>/assets-cms/img/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>/assets-cms/img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>/assets-cms/img/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>/assets-cms/img/favicon/favicon-16x16.png">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo base_url(); ?>/assets-cms/img/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<!-- ================== BEGIN core-css ================== -->
	<link href="<?php echo base_url(); ?>/assets-cms/css/vendor.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>/assets-cms/css/app.min.css" rel="stylesheet" />
	<!-- ================== END core-css ================== -->
	<style>
		body {
			/* background-image: url("./assets-cms/img/back.jpg"); */
			background-color: #F3F5F9;
		}
	</style>

</head>

<body>
	<!-- BEGIN #app -->
	<div id="app" class="app app-full-height app-without-header">
		<!-- BEGIN login -->
		<div class="login">
			<!-- BEGIN login-content -->
			<div class="login-content">
				<div class="card border-primary">
					<div class="card-body">

						<form action="<?= base_url('auth'); ?>" method="POST" class="was-validated">
							<?= csrf_field() ?>
							<h4 class="text-center">LOGIN CMS</h4>
							<hr>
							<div class="text-muted text-left mb-4">
								<?php if ($validation->getErrors()) : ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<?= $validation->listErrors() ?>
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
								<?php endif ?>
								<?php if (isset($error)) : ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										<?= $error ?>
									</div>
								<?php endif ?>
							</div>
							<div class="mb-3">
								<label class="form-label">Email Address</label>
								<input name="username" type="text" class="form-control form-control-lg fs-15px" value="" placeholder="username@address.com" required />
								<!-- Error -->
								<?php if ($validation->hasError('username')) { ?>
									<div class="invalid-feedback"><?= $error = $validation->getError('username'); ?></div>
								<?php } ?>
							</div>
							<div class="mb-3">
								<div class="d-flex">
									<label class="form-label">Password</label>
								</div>
								<input name="password" type="password" class="form-control form-control-lg fs-15px" value="" placeholder="Enter your password" required />
								<!-- Error -->
								<?php if ($validation->hasError('password')) { ?>
									<div class="invalid-feedback"><?= $error = $validation->getError('password'); ?></div>
								<?php } ?>
							</div>
							<div class="mb-3 row text-center">
								<center>
									<?php echo reCaptcha3('recaptcha', ['id' => 'recaptcha', 'required' => ''], ['action' => 'auth']); ?>
									<!-- Error -->
									<?php if ($validation->hasError('recaptcha')) { ?>
										<div class="invalid-feedback"><?= $error = $validation->getError('recaptcha'); ?></div>
									<?php } ?>
								</center>
							</div>
							<button type="submit" class="btn btn-primary btn-lg d-block w-100 fw-500 mb-3">Sign In</button>
							<div class="text-center text-muted">
								<center>Copyright &copy; <a href='https://acta.co.id'>PT. ASTRINDO CIPTA TEKNIKATAMA</a></center>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- END login-content -->
		</div>
		<!-- END login -->

		<!-- BEGIN btn-scroll-top -->
		<a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
		<!-- END btn-scroll-top -->
	</div>
	<!-- END #app -->

	<!-- ================== BEGIN core-js ================== -->
	<script src="<?php echo base_url(); ?>/assets-cms/js/vendor.min.js"></script>
	<script src="<?php echo base_url(); ?>/assets-cms/js/app.min.js"></script>
	<!-- ================== END core-js ================== -->

</body>

</html>