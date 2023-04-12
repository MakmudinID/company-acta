<?php

use App\Libraries\Plugins;

$this->pl = new Plugins();
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

<!-- About Section -->
<section class="about-section">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title">
            <div class="title">PROFIL <?= $konfigurasi->nama_populer; ?></div>
            <h2><?= $konfigurasi->nama_company; ?></h2>
        </div>
        <div class="row">

            <!-- Content Column -->
            <div class="content-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="text">Does any industry face a more complex audience journey and marketing sales process than B2B technology? Consider the number of people who influence a sale, the length of the decision-making cycle, the competing interests of the people who purchase, implement, manage, and use the technology. It’s a lot meaningful content here.</div>
                </div>
            </div>

            <!-- Images Column -->
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="blocks-outer">

                    <!-- Feature Block -->
                    <div class="feature-block">
                        <div class="inner-box">
                            <div class="icon flaticon-award-1"></div>
                            <h6>Berpengalaman</h6>
                            <div class="feature-text">Memiliki Sumber daya yang ahli di bidang Design & Manufaktur</div>
                        </div>
                    </div>

                    <!-- Feature Block -->
                    <div class="feature-block">
                        <div class="inner-box">
                            <div class="icon flaticon-technical-support"></div>
                            <h6>Dukungan Teknis</h6>
                            <div class="feature-text">Memiliki dukungan Layanan Teknis yang bisa diandalkan dengan harga terjangkau</div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<!-- End About Section -->

<!-- Featured Section -->
<section class="featured-section">
    <div class="auto-container">
        <div class="row clearfix">

            <!-- Featured Block Two -->
            <div class="feature-block-two col-lg-6 col-md-12 col-sm-12">
                <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="number">35 +</div>
                    <h4>Worldwide Work Pair</h4>
                    <div class="text">To succeed, every software solution must be deeply integrated into the existing tech environment..</div>
                </div>
            </div>

            <!-- Featured Block Two -->
            <div class="feature-block-two col-lg-6 col-md-12 col-sm-12">
                <div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="number">40 k</div>
                    <h4>Happy Clients</h4>
                    <div class="text">To succeed, every software solution must be deeply integrated into the existing tech environment..</div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Featured Section -->

<!-- Services Section -->
<section class="services-section margin-top">
    <div class="pattern-layer" style="background-image: url(assets/images/background/pattern-2.png)"></div>
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title light centered">
            <div class="title">Produk Jasa</div>
            <h2>Layanan Professional <br>Untuk Mengembangkan Bisnis Anda</h2>
        </div>
        <div class="row clearfix">
            <?php foreach ($produk_highlight as $ph) : ?>
                <div class="service-block col-lg-3 col-md-6 col-sm-12 text-center">
                    <div class="inner-box">
                        <div class="icon-box">
                            <img src="<?= $ph->photo_url ?>" alt="">
                        </div>
                        <h5><a href="<?php echo base_url() ?>/assets/services-detail.html"><?= $ph->nama ?></a></h5>
                        <div class="text"><?= $ph->ringkasan ?></div>
                        <a href="<?php echo base_url() ?>/assets/services-detail.html" class="arrow flaticon-long-arrow-pointing-to-the-right"></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- End Services Section -->

<!-- News Section -->
<section class="news-section">
    <div class="auto-container">

        <div class="sec-title text-black centered margin-top">
            <div class="title">PROMO</div>
            <h2>Temukan Diskon & Penawaran Spesial</h2>
        </div>

        <div class="row clearfix justify-content-center">

            <?php foreach ($produk_promo as $pr) : ?>
                <div class="service-block-two col-lg-4 col-md-6 text-center col-sm-12">
                    <div class="inner-box wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                        <div class="shape-one"></div>
                        <div class="shape-two"></div>
                        <div class="icon-box">
                            <img src="<?= $pr->photo_url ?>" alt="">
                        </div>
                        <h5><a href="services-detail.html"><?= $pr->nama ?></a></h5>
                        <div class="text"><?= $pr->ringkasan ?></div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <!-- Sec Title -->
        <div class="sec-title centered margin-top mt-4">
            <div class="title">TERBARU</div>
            <h2>Berita & Artikel</h2>
        </div>
        <div class="row clearfix justify-content-center">
            <?php foreach ($blog as $b) : ?>
                <div class="news-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image">
                            <a href="<?php echo base_url() ?>"><img src="<?= $b->photo_url ?>" alt="" /></a>
                        </div>
                        <div class="lower-content">
                            <div class="post-date"><?= $this->pl->format_tanggal($b->create_date, 'no') ?></div>
                            <ul class="post-meta">
                                <li><span class="icon flaticon-user"></span><?= $b->create_user; ?></li>
                            </ul>
                            <h4><a href="<?php echo base_url() ?>"><?= $b->judul; ?></a></h4>
                            <div class="text"><?= $b->ringkasan; ?></div>
                            <a class="read-more" href="<?php echo base_url() ?>">Baca Selengkapnya<span class="arrow flaticon-long-arrow-pointing-to-the-right"></span></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- End News Section -->

<section class="call-to-action-section" style="background-image: url(assets/images/background/pattern-3.png)">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Heading Column -->
            <div class="heading-column col-lg-8 col-md-12 col-sm-12">
                <div class="inner-column">
                    <h2>Awali kesuksesan Anda <br> bersama ACTA!</h2>
                </div>
            </div>
            <!-- Button Column -->
            <div class="button-column col-lg-4 col-md-12 col-sm-12">
                <div class="inner-column">
                    <a href="contact.html" class="theme-btn btn-style-two"><span class="txt">Mulai Sekarang</span></a>
                </div>
            </div>
        </div>
    </div>
</section>