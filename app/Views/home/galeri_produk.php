<?php

use Hashids\Hashids;

$hashids = new Hashids('53qURe_produk', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');

?>

<!--Page Title-->
<section class="page-title">
    <div class="pattern-layer-one" style="background-image: url(assets/images/background/pattern-16.png)"></div>
    <div class="auto-container">
        <h2>Galeri Produk</h2>
        <ul class="page-breadcrumb">
            <li><a href="<?= base_url('/') ?>">Profil</a></li>
            <li>Galeri Produk</li>
        </ul>
    </div>
</section>
<!--End Page Title-->

<section class="gallery-section">
		<div class="auto-container">
			<!--MixitUp Galery-->
            <div class="mixitup-gallery">
                
                <!--Filter-->
                <div class="filters clearfix">
                	
                	<ul class="filter-tabs filter-btns text-center clearfix">
                        <li class="filter active" data-role="button" data-filter="all">All</li>
						<?php foreach($kategori as $k): ?>
                        <li class="filter" data-role="button" data-filter=".<?=$k->kode?>"><?= $k->nama;?></li>
						<?php endforeach; ?>
                    </ul>
                    
                </div>
                
                <div class="filter-list row clearfix" id="MixItUp309EFA">
					<?php foreach($produk as $p): ?>
					<div class="case-block mix all <?=$p->kode?> col-lg-4 col-md-6 col-sm-12" style="display: inline-block;">
						<div class="inner-box">
							<div class="image">
								<img src="<?=$p->gallery?>" alt="">
								<div class="overlay-box">
									<a href="<?=$p->gallery?>" data-fancybox="gallery" data-caption="" class="search-icon"><span class="icon flaticon-search"></span></a>
									<div class="content">
										<h4><a href="<?= base_url('produk/' . $hashids->encode($p->id)) ?>"><?= $p->nama;?></a></h4>
										<div class="category"><?= $p->kategori;?></div>
									</div>
									<a href="<?= base_url('produk/' . $hashids->encode($p->id)) ?>" class="arrow flaticon-long-arrow-pointing-to-the-right"></a>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				
			</div>
		</div>
	</section>