
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>404 | Not Found</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Admin - Al Azhar Peduli" />
	<meta name="author" content="404" />
	
	<!-- ================== BEGIN core-css ================== -->
    <link href="<?php echo base_url(); ?>/assets-cms/css/vendor.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>/assets-cms/css/app.min.css" rel="stylesheet" />
	<!-- ================== END core-css ================== -->
	
</head>
<body>
	<!-- BEGIN #app -->
	<div id="app" class="app app-full-height app-without-header">
		<!-- BEGIN error -->
		<div class="error-page">
			<!-- BEGIN error-page-content -->
			<div class="error-page-content">
				<div class="error-img">
					<div class="error-img-code">404</div>
					<img src="<?php echo base_url(); ?>/assets-cms/img/page/404.svg" alt="" />
				</div>
				
				<h1>Oops!</h1> 
				<h3>We can't seem to find the page you're looking for</h3>
				<a href="<?=base_url('/')?>" class="btn btn-primary">Go to Homepage</a>
			</div>
			<!-- END error-page-content -->
		</div>
		<!-- END error -->
		
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
