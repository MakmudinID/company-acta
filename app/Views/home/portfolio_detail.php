<?php

use App\Libraries\Plugins;
use Hashids\Hashids;

$this->pl = new Plugins();
$hashids = new Hashids('53qURe_portfolio', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
?>

<!--Page Title-->
<section class="page-title">
	<div class="pattern-layer-one" style="background-image: url(<?= base_url('/assets/images/background/pattern-16.png') ?>)"></div>
	<div class="auto-container">
		<h2>Portfolio</h2>
		<ul class="page-breadcrumb">
			<li><a href="<?= base_url('/') ?>">Portfolio</a></li>
			<li><?= $portfolio->title; ?></li>
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
						<div class="image">
							<img src="<?= $portfolio->photo_url; ?>" alt="" class="rounded">
						</div>
						<div class="lower-section">
							<?= $portfolio->deskripsi; ?>
						</div>
					</div>
				</div>

				<!-- Info Column -->
				<div class="info-column col-lg-5 col-md-12 col-sm-12">
					<div style="position: -webkit-sticky; position: sticky; top: 100px;">
						<div class="inner-column">
							<h4><?= $portfolio->title; ?></h4>
							<div class="text"><?= $portfolio->keterangan; ?></div>
							<ul class="info-list">
								<?php if ($portfolio->client != '') : ?>
									<li><span class="icon flaticon-user"></span><strong>Client: </strong><?= $portfolio->client; ?></li>
								<?php endif; ?>
								<li><span class="icon fa fa-bookmark-o"></span><strong>Category: </strong><?= $this->pl->getTags($portfolio->id) ?></li>
								<li><span class="icon flaticon-timetable"></span><strong>Date: </strong><?= $portfolio->date_project; ?></li>
								<li><span class="icon fa fa-map-marker"></span><strong>Location: </strong><?= $portfolio->location_project; ?></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>

		<?php
		$id_prev = $this->pl->getPrevPortfolio($portfolio->id);
		$id_next = $this->pl->getNextPortfolio($portfolio->id);
		?>
		<?php if ($id_prev != false || $id_next != false) : ?>
			<div class="buttons-box clearfix mt-5">
				<?php if ($id_prev != false) : ?>
					<div class="pull-left">
						<a href="<?= base_url('/portfolio-detail/' . $hashids->encode($id_prev)) ?>" class="theme-btn btn-style-three"><span class="txt"><i class="fa fa-angle-double-left"></i>&nbsp; Sebelumnya</span></a>
					</div>
				<?php endif; ?>
				<?php if ($id_next != false) : ?>
					<div class="pull-right">
						<a href="<?= base_url('/portfolio-detail/' . $hashids->encode($id_next)) ?>" class="theme-btn btn-style-three"><span class="txt"> Selanjutnya &nbsp;<i class="fa fa-angle-double-right"></i></span></a>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	</div>
</section>