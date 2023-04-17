<?php
use Hashids\Hashids;
$hashids = new Hashids('53qURe_blog', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
?>

<!--Page Title-->
<section class="page-title">
	<div class="pattern-layer-one" style="background-image: url(<?= base_url('/assets/images/background/pattern-16.png') ?>)"></div>
	<div class="auto-container">
		<h2>ARTIKEL & BERITA</h2>
		<ul class="page-breadcrumb">
			<li><?= $blog->judul; ?></li>
		</ul>
	</div>
</section>
<!--End Page Title-->
<div class="sidebar-page-container">
	<div class="auto-container">
		<div class="row clearfix">

			<!-- Content Side -->
			<div class="content-side col-lg-8 col-md-12 col-sm-12">
				<div class="news-detail">
					<div class="inner-box">
						<div class="upper-box">
							<h3><?= $blog->judul; ?></h3>
							<ul class="post-meta">
								<li><span class="icon flaticon-user"></span><?= $blog->create_user; ?></li>
							</ul>
						</div>
						<div class="image">
							<img src="<?= $blog->photo_url ?>" alt="">
							<div class="post-date">22 <span>DEC 2022</span></div>
						</div>

						<div class="lower-content">
							<?= html_entity_decode($blog->konten) ?>

							<div class="post-share-options">
								<div class="post-share-inner clearfix">
									<div class="pull-left tags">
										<?php foreach ($tag_by as $t) : ?>
											<a href="<?= base_url('blog-tag/' . $hashids->encode($t->tag_id)) ?>"><?= $t->name; ?></a>
										<?php endforeach; ?>
									</div>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>

			<!-- Sidebar Side -->
			<div class="sidebar-side left-sidebar col-lg-4 col-md-12 col-sm-12">
				<aside class="sidebar sticky-top">
					<div class="sidebar-inner">
						<div class="sidebar-widget search-box">
							<div class="sidebar-title">
								<h5>Search :</h5>
							</div>
							<form method="get" action="<?= base_url('/blog-search') ?>">
								<div class="form-group">
									<input type="search" name="q" value="<?= isset($key) ? $key : ''?>" placeholder="Search....." required="">
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