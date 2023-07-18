<?php 
use App\Libraries\Plugins;
use Hashids\Hashids;

$this->pl = new Plugins();
$hashids = new Hashids('53qURe_produk', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
?>

<section class="page-title">
    <div class="pattern-layer-one" style="background-image: url(<?= base_url('/assets/images/background/pattern-16.png') ?>)"></div>
    <div class="auto-container">
        <h2><?= $produk->nama; ?></h2>
        <ul class="page-breadcrumb">
            <li><a href="<?= base_url('/') ?>">Produk</a></li>
            <li><?= $produk->kategori; ?></li>
        </ul>
    </div>
</section>

<section class="project-detail-section">
    <div class="auto-container">

        <div class="upper-section">
            <div class="row clearfix">

                <div class="image-column col-lg-7 col-md-12 col-sm-12">
                    <div class="shop-page product-details">
                        <div class="carousel-outer">

                            <ul class="image-carousel owl-carousel owl-theme">
                                <li>
                                    <a href="<?= $produk->photo_url ?>" class="lightbox-image" title="Image Caption Here">
                                        <img src="<?= $produk->photo_url ?>" alt="<?= $produk->nama ?>" class="rounded">
                                    </a>
                                </li>
                                <?php foreach ($galery_produk as $g) : ?>
                                    <li>
                                        <a href="<?= $g->photo_url ?>" class="lightbox-image" title="Image Caption Here">
                                            <img src="<?= $g->photo_url ?>" alt="<?= $g->title ?>" class="rounded">
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <ul class="mt-3 thumbs-carousel owl-carousel owl-theme">
                                <?php foreach ($galery_produk as $g) : ?>
                                    <li>
                                        <img src="<?= $g->photo_url ?>" alt="<?= $g->title ?>" height="10px" class="rounded">
                                    </li>
                                <?php endforeach; ?>
                                <li>
                                    <img src="<?= $produk->photo_url ?>" alt="<?= $produk->nama ?>" height="10px" class="rounded">
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="row mt-3 container">
                        <?= $produk->deskripsi; ?>
                    </div>
                </div>

                <div class="info-column col-lg-5 col-md-12 col-sm-12">
                    <div class="mt-5" style="position: -webkit-sticky; position: sticky; top: 135px;">
                        <div class="inner-column">
                            <h4><?= $produk->nama; ?></h4>
                            <hr>
                            <!-- <div style="font-size: 25px; font-weight:500">Rp <?= number_format($produk->harga_jasa, 0, ',', '.'); ?></div>
                            <hr> -->
                            <div class="text"><?= $produk->ringkasan; ?></div>
                            <div class="d-flex">
                                <div><i class="icon fa fa-bookmark-o"></i> <strong>Kategori: </strong></div>
                                <div class="ml-2"><?= $produk->kategori; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
		$id_prev = $this->pl->getPrevProduk($produk->id);
		$id_next = $this->pl->getNextProduk($produk->id);
		?>
		<?php if ($id_prev != false || $id_next != false) : ?>
			<div class="buttons-box clearfix mt-5">
				<?php if ($id_prev != false) : ?>
					<div class="pull-left">
						<a href="<?= base_url('/produk/' . $hashids->encode($id_prev)) ?>" class="theme-btn btn-style-three"><span class="txt"><i class="fa fa-angle-double-left"></i>&nbsp; Sebelumnya</span></a>
					</div>
				<?php endif; ?>
				<?php if ($id_next != false) : ?>
					<div class="pull-right">
						<a href="<?= base_url('/produk/' . $hashids->encode($id_next)) ?>" class="theme-btn btn-style-three"><span class="txt"> Selanjutnya &nbsp;<i class="fa fa-angle-double-right"></i></span></a>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

    </div>
</section>