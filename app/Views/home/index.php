<?php

use App\Libraries\Plugins;
use App\Models\ProdukModel;

$this->pl = new Plugins();
$this->produkModel = new ProdukModel();
?>

<!-- Banner Section -->
<section class="banner-section">
    <div class="main-slider-carousel owl-carousel owl-theme">
        <?php foreach ($slider as $s) : ?>
            <div class="slide" style="background-image: url(<?= $s->photo_url ?>)">
                <div class="patern-layer-one" style="background-image: url(assets/images/main-slider/pattern-1.png)"></div>
                <div class="patern-layer-two" style="background-image: url(assets/images/main-slider/pattern-2.png)"></div>
                <div class="auto-container">
                    <!-- Content Column -->
                    <div class="content-column">
                        <div class="inner-column">
                            <div class="patern-layer-three" style="background-image: url(<?= $s->photo_url ?>)"></div>
                            <div class="title"><?= $s->title_normal; ?></div>
                            <h1><?= $s->title_bold; ?></h1>
                            <div class="text"><?= $s->keterangan; ?></div>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>

</section>
<!-- End Banner Section -->

<section class="services-section-three margin-top">
    <div class="auto-container">
        <div class="inner-container">
            <div class="row clearfix justify-content-center">

                <!-- Service Block Three -->
                <div class="service-block-three col-lg-4 col-md-6 col-sm-12 mt-3">
                    <div class="inner-box wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                        <div class="content">
                            <div class="service-number">01</div>
                            <h4><a href="services-detail.html">Warranty Management IT</a></h4>
                            <div class="text">Entrust full-cycle implementation of your software product to our experienced BAs, UI/UX designers, developers.</div>
                            <a href="services-detail.html" class="more-detail">More Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Service Block Three -->
                <div class="service-block-three col-lg-4 col-md-6 col-sm-12 mt-3">
                    <div class="inner-box wow fadeInUp animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
                        <div class="content">
                            <div class="service-number">02</div>
                            <h4><a href="services-detail.html">Product Control Service</a></h4>
                            <div class="text">Entrust full-cycle implementation of your software product to our experienced BAs, UI/UX designers, developers.</div>
                            <a href="services-detail.html" class="more-detail">More Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Service Block Three -->
                <div class="service-block-three col-lg-4 col-md-6 col-sm-12 mt-3">
                    <div class="inner-box wow fadeInRight animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInRight;">
                        <div class="content">
                            <div class="service-number">03</div>
                            <h4><a href="services-detail.html">Quality Control System</a></h4>
                            <div class="text">Entrust full-cycle implementation of your software product to our experienced BAs, UI/UX designers, developers.</div>
                            <a href="services-detail.html" class="more-detail">More Detail</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mb-3">
                <div class="sec-title">
                    <div class="title">PROFIL <?= $konfigurasi->nama_populer; ?></div>
                </div>
                <h2 style="display:black;"><?= $konfigurasi->nama_company; ?></h2>
                <div class="text"><?= $konfigurasi->tagline;?></div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <img src="<?= $konfigurasi->profil_url ?>" alt="">
            </div>
        </div>
    </div>
</section>
<!-- End About Section -->

<section class="services-section-two margin-top">
    <div class="auto-container">
        <div class="upper-box">
            <div class="icon-one" style="background-image: url(assets/images/icons/icon-1.png)"></div>
            <div class="icon-two" style="background-image: url(assets/images/icons/icon-2.png)"></div>
            <div class="icon-three" style="background-image: url(assets/images/icons/icon-3.png)"></div>
            <!-- Sec Title -->
            <div class="sec-title light centered">
                <div class="title">Produk Pilihan</div>
                <h2>Berbagai jenis produk yang dapat anda pilih <br>untuk mengembangkan bisnis anda</h2>
            </div>
        </div>
        <div class="inner-container">
            <div class="row clearfix justify-content-center">
                <?php foreach ($produk_pilihan as $ph) : ?>
                    <div class="service-block-two col-lg-4 col-md-6 col-sm-12 text-center">
                        <div class="inner-box wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                            <div class="shape-one"></div>
                            <div class="shape-two"></div>
                            <div class="icon-box">
                                <img src="<?= $ph->photo_url ?>" class="img-fluid rounded"></img>
                            </div>
                            <h5><a href="services-detail.html"><?= $ph->nama; ?></a></h5>
                            <div class="text"><?= $ph->ringkasan; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!-- End Services Section -->

<section class="pricing-section margin-top">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="title">PILIHAN HARGA</div>
            <h2>Harga terbaik yang kami hadirkan untuk anda</h2>
        </div>

        <div class="row clearfix mt-5">

            <?php foreach($product_price as $p): ?>
                <div class="price-block col-lg-4 col-md-6 col-sm-12 mb-2">
                    <div class="inner-box">
                        <h3><?= $p->judul;?></h3>
                        <div class="text"><?= $p->keterangan;?></div>
                        <div class="price"><span>Mulai Dari</span> Rp <?= number_format($p->harga, 0, ',', '.');?> </div>
                        <ul class="price-list">
                            <?php foreach($this->produkModel->fitur_produk($p->id) as $list): ?>
                                <li><?= $list->deskripsi;?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="btn-box">
                            <a href="#" class="theme-btn btn-style-one"><span class="txt">Hubungi Sekarang</span></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </div>
</section>

<section class="call-to-action-section-two">
    <div class="auto-container">
        <div class="inner-container">
            <div class="image">
                <img src="<?= base_url('/assets/images/thumb-success.jpg') ?>" alt="">
            </div>
            <h3>Awali kesuksesan bisnis Anda <br> bersama ACTA!</h3>
            <a href="services.html" class="theme-btn btn-style-two"><span class="txt">More Services</span></a>
        </div>
    </div>
</section>



<!-- Testimonial Section -->
<section class="testimonial-section">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title">
            <div class="clearfix">
                <div class="pull-left align-self-center">
                    <div class="title">TESTIMONI</div>
                    <h2>Pendapat Pelanggan Kami</h2>
                </div>
                <div class="pull-right">
                    <div class="text">Keinginan dan kepuasan anda adalah menjadi prioritas kami <br> dengan memberikan dukungan teknis terbaik</div>
                </div>
            </div>
        </div>

        <div class="testimonial-carousel owl-carousel owl-theme">
            <?php foreach ($testimoni as $t) : ?>
                <div class="testimonial-block">
                    <div class="inner-box" style="background-image: url(images/background/pattern-4.png)">
                        <div class="upper-box">
                            <div class="icon">
                                <img src="<?= $t->photo_url ?>" alt="" class="img-fluid rounded" />
                            </div>
                            <h4><?= $t->nama; ?></h4>
                            <div class="designation"><?= $t->title; ?></div>
                        </div>
                        <div class="text text-justify"><?= $t->deskripsi; ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- End Testimonial Section -->