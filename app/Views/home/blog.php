<?php

use App\Libraries\Plugins;
use Hashids\Hashids;

$this->pl = new Plugins();
$hashids = new Hashids('53qURe_blog', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
?>

<section class="page-title">
	<div class="pattern-layer-one" style="background-image: url(<?= base_url('/assets/images/background/pattern-16.png') ?>)"></div>
	<div class="auto-container">
		<h2>ARTIKEL & BERITA</h2>
		<?php if (isset($tag_name)) : ?>
			<ul class="page-breadcrumb">
				<li>TAG: <?= $tag_name; ?></li>
			</ul>
		<?php endif; ?>
		<?php if (isset($key)) : ?>
			<ul class="page-breadcrumb">
				<li>Hasil Pencarian: <?= $key; ?></li>
			</ul>
		<?php endif; ?>
	</div>
</section>

<div class="sidebar-page-container">
	<div class="auto-container">
		<div class="row clearfix">
			<div class="content-side col-lg-8 col-md-12 col-sm-12">
				<div class="blog-classic">

					<?php foreach ($list_blog as $b) : ?>
						<div class="news-block-five">
							<div class="inner-box wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
								<div class="image">
									<a href="<?= base_url('/blog-detail/' . $hashids->encode($b->id)) ?>">
										<img src="<?= $b->photo_url ?>" alt="">
									</a>
								</div>
								<div class="lower-content">
									<div class="post-date"><?= $this->pl->format_tanggal($b->create_date, 'no'); ?></div>
									<h4>
										<a href="<?= base_url('/blog-detail/' . $hashids->encode($b->id)) ?>">
											<?= $b->judul; ?>
										</a>
									</h4>
									<div class="text">
										<?= $b->ringkasan; ?>
									</div>
									<div class="lower-box clearfix">
										<div class="pull-left">
											<ul class="post-meta">
												<li><span class="icon flaticon-user"></span><?= $b->create_user; ?></li>
											</ul>
										</div>
										<div class="pull-right">
											<a class="read-more" href="<?= base_url('/blog-detail/' . $hashids->encode($b->id)) ?>"><span class="arrow flaticon-long-arrow-pointing-to-the-right"></span> Selengkapnya</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>

					<?php if (count($list_blog) == 0) : ?>
						<div class="single-product-item col-lg-12 col-md-12 col-sm-12 text-center">
							<div class="title-holder text-center">
								<div class="static-content">
									<h5 class="text-danger">Artikel & Berita Tidak Ditemukan</h5>
								</div>
							</div>
						</div>
					<?php else: ?>
						<?= $pager->links('blog', 'bootstrap_pagination'); ?>
					<?php endif; ?>

				</div>
			</div>

			<!-- Sidebar Side -->
			<div class="sidebar-side left-sidebar col-lg-4 col-md-12 col-sm-12">
				<aside class="sidebar sticky-top">
					<div class="sidebar-inner">
						<div class="sidebar-widget search-box">
							<div class="sidebar-title">
								<h5>Pencarian :</h5>
							</div>
							<form method="get" action="<?= base_url('/blog-search') ?>">
								<div class="form-group">
									<input type="search" name="q" value="<?= isset($key) ? $key : '' ?>" placeholder="Search....." required="">
									<button type="submit"><span class="icon fa fa-search"></span></button>
								</div>
							</form>
						</div>
						<div class="sidebar-widget popular-tags mt-4">
							<div class="sidebar-title">
								<h5>Tag :</h5>
							</div>
							<div class="widget-content">
								<?php foreach ($tag as $t) : ?>
									<a href="<?= base_url('blog-tag/' . $hashids->encode($t->tag_id)) ?>"><?= $t->name; ?></a>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</div>
</div>