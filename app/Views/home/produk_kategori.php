<?php 
use Hashids\Hashids;
$hashids = new Hashids('53qURe_produk', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');

?>
<!--Page Title-->
<section class="page-title">
    <div class="pattern-layer-one" style="background-image: url(<?= base_url('/assets/images/background/pattern-16.png') ?>)"></div>
    <div class="auto-container">
        <h2><?= $kategori_row->nama;?></h2>
        <ul class="page-breadcrumb">
            <li><a href="<?= base_url('/') ?>">Produk</a></li>
            <li><?= $kategori_row->nama;?></li>
        </ul>
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
                        <div class="row clearfix">
                            <!-- Shop Item -->
                            <?php foreach ($list_produk as $p) : ?>
                                <div class="single-product-item col-lg-4 col-md-6 col-sm-12 text-center">
                                    <div class="img-holder">
                                        <img width="270" height="300" src="<?=$p->photo_url?>" class="" alt="">
                                    </div>
                                    <div class="title-holder text-center">
                                        <div class="static-content">
                                            <h3 class="title text-center">
                                                <a href="<?=base_url('produk/'.$hashids->encode($p->id))?>"><?=$p->nama?></a>
                                            </h3>
                                            <span class="price"><span class="amount"><span class="">Rp </span><?= number_format($p->harga_jasa, 0, ',', '.');?></span></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Side -->
            <div class="sidebar-side left-sidebar col-lg-4 col-md-12 col-sm-12">
                <aside class="sidebar sticky-top">
                    <div class="sidebar-inner">

                        <!-- Search -->
                        <div class="sidebar-widget search-box">
                            <div class="sidebar-title">
                                <h5>Pencarian Produk :</h5>
                            </div>
                            <form method="post" action="contact.html">
                                <div class="form-group">
                                    <input type="search" name="search-field" value="" placeholder="Search....." required="">
                                    <button type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>
                        </div>


                        <div class="sidebar-widget categories-widget mt-5">
                            <div class="sidebar-title">
                                <h5>Kategori :</h5>
                            </div>
                            <div class="widget-content">
                                <ul class="blog-cat">
                                    <?php foreach($kategori as $k): ?>
                                    <li><a href="<?=base_url('produk-kategori/'.$k->kode)?>"><?= $k->nama;?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

        </div>
    </div>
</div>