<?php

use Hashids\Hashids;

$hashids = new Hashids('53qURe_produk', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');

?>
<!--Page Title-->
<section class="page-title">
    <div class="pattern-layer-one" style="background-image: url(<?= base_url('/assets/images/background/pattern-16.png') ?>)"></div>
    <div class="auto-container">
        <h2>Produk</h2>
        <?php if (isset($kategori_row)) : ?>
            <ul class="page-breadcrumb">
                <li><a href="<?= base_url('/') ?>">Kategori</a></li>
                <li><?= $kategori_row->nama; ?></li>
            </ul>
        <?php endif; ?>
        <?php if (isset($key)) : ?>
            <ul class="page-breadcrumb">
                <li>Hasil Pencarian : <?= $key; ?></li>
            </ul>
        <?php endif; ?>
    </div>
</section>
<!--End Page Title-->

<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">

            <!--Content Side-->
            <div class="content-side col-lg-8 col-md-12 col-sm-12">
                <!--Shop Single-->
                <div class="shop-section">
                    <div class="our-shops">
                        <div class="row clearfix justify-content-center">
                            <!-- Shop Item -->
                            <?php foreach ($list_produk as $p) : ?>
                                <div class="single-product-item col-lg-4 col-md-6 col-sm-12 text-center">
                                    <div class="img-holder">
                                        <img width="270" height="300" src="<?= $p->photo_url ?>" class="" alt="">
                                    </div>
                                    <div class="title-holder text-center">
                                        <div class="static-content">
                                            <h3 class="title text-center">
                                                <a href="<?= base_url('produk/' . $hashids->encode($p->id)) ?>"><?= $p->nama ?></a>
                                            </h3>
                                            <span class="price"><span class="amount"><span class="">Rp </span><?= number_format($p->harga_jasa, 0, ',', '.'); ?></span></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php if( count($list_produk) == 0): ?>
                                <div class="single-product-item col-lg-12 col-md-12 col-sm-12 text-center">
                                    <div class="title-holder text-center">
                                        <div class="static-content">
                                            <h5 class="text-danger">Produk Tidak Ditemukan</h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
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
                                <h5>Pencarian Produk :</h5>
                            </div>
                            <form method="get" action="<?= base_url('/produk-search') ?>">
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
                                <?php foreach ($kategori as $k) : ?>
                                    <a href="<?= base_url('produk-kategori/' . $k->kode) ?>"><?= $k->nama; ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                </aside>
            </div>

        </div>
    </div>
</div>