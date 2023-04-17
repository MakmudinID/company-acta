<?php
use App\Libraries\Plugins;
use Hashids\Hashids;

$this->pl = new Plugins();
$hashids = new Hashids('53qURe_portfolio', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
?>

<section class="page-title">
    <div class="pattern-layer-one" style="background-image: url(assets/images/background/pattern-16.png)"></div>
    <div class="auto-container">
        <h2>PORTFOLIO</h2>
        <ul class="page-breadcrumb">
            <li>Hasil Karya Terbaik Kami <br> Semoga menjadi inspirasi dan referensi untuk kita dapat bekerja sama</li>
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
						<?php foreach($tag as $t): ?>
                        	<li class="filter" data-role="button" data-filter=".<?=$t->nama?>">#<?= $t->nama;?></li>
						<?php endforeach; ?>
                    </ul>
                    
                </div>
                
                <div class="filter-list row clearfix" id="MixItUp309EFA">
					<?php foreach($portfolio as $p): ?>
						<div class="case-block mix all <?= $this->pl->getTag($p->id) ?>col-lg-4 col-md-6 col-sm-12" style="display: inline-block;">
							<div class="inner-box">
								<div class="image">
									<img src="<?=$p->photo_url?>" alt="">
									<div class="overlay-box">
										<a href="<?=base_url('/portfolio-detail/'.$hashids->encode($p->id))?>"  class="search-icon"><span class="icon flaticon-search"></span></a>
										<div class="content">
											<h4><a href="<?=base_url('/portfolio-detail/'.$hashids->encode($p->id))?>"><?= $p->title;?></a></h4>
											<div class="category"><?= $p->client;?></div>
										</div>
										<a href="<?=base_url('/portfolio-detail')?>" class="arrow flaticon-long-arrow-pointing-to-the-right"></a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach;?>
				</div>
				
			</div>
		</div>
	</section>