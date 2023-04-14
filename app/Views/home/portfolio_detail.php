<!--Page Title-->
<section class="page-title">
	<div class="pattern-layer-one" style="background-image: url(<?= base_url('/assets/images/background/pattern-16.png') ?>)"></div>
	<div class="auto-container">
		<h2>Portfolio</h2>
		<ul class="page-breadcrumb">
			<li><a href="<?= base_url('/') ?>">Portfolio</a></li>
			<li><?= $portfolio->title;?></li>
		</ul>
	</div>
</section>
<!--End Page Title-->

<section class="project-detail-section">
	<div class="auto-container">
		<div class="upper-section">
			<div class="row clearfix">

				<!-- Image Column -->
				<div class="image-column col-lg-7 col-md-12 col-sm-12">
					<div class="inner-column">
						<!-- Sec Title -->
						<div class="sec-title">
							<h2><?= $portfolio->title; ?></h2>
						</div>
						<div class="image">
							<img src="<?= $portfolio->photo_url; ?>" alt="">
						</div>
					</div>
				</div>

				<!-- Info Column -->
				<div class="info-column col-lg-5 col-md-12 col-sm-12">
					<div class="inner-column">
						<h4>Project Info</h4>
						<div class="text"><?= $portfolio->keterangan; ?></div>
						<ul class="info-list">
							<li><span class="icon flaticon-user"></span><strong>Client: </strong><?= $portfolio->client; ?></li>
							<li><span class="icon fa fa-bookmark-o"></span><strong>Category: </strong>Business, Campaign</li>
							<li><span class="icon flaticon-timetable"></span><strong>Date: </strong><?= $portfolio->date_project; ?></li>
							<li><span class="icon fa fa-map-marker"></span><strong>Location: </strong><?= $portfolio->location_project; ?></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
		<div class="lower-section">
			<?= $portfolio->deskripsi; ?>
		</div>
	</div>
</section>