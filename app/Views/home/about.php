<!--Page Title-->
<section class="page-title">
    <div class="pattern-layer-one" style="background-image: url(assets/images/background/pattern-16.png)"></div>
    <div class="auto-container">
        <h2>TENTANG KAMI</h2>
    </div>
</section>
<!--End Page Title-->

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
        <?php if($konfigurasi->deskripsi != ''): ?>
            <div class="row">
                <div class="col-md-12">
                    <?= $konfigurasi->deskripsi;?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- End About Section -->

<!--Sponsors Section-->
<section class="team-section-two" style="background-image: url(images/background/2.jpg)">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title">
            <div class="clearfix">
                <div class="pull-left">
                    <div class="title">LEADER</div>
                    <h2>Kami memimiliki Tim Leader <br> yang berpengalaman</h2>
                </div>
                <div class="pull-right align-self-center">
                    <div class="text">Untuk dapat memberikan kepuasan dan kepercayaan <br> kepada semua pelanggan kami secara profesional </div>
                </div>
            </div>
        </div>
        <div class="row clearfix justify-content-center">

            <?php foreach($team as $t): ?>
            <div class="team-block-two col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="image">
                        <img src="<?=$t->foto?>" alt="">
                    </div>
                    <div class="lower-box">
                        <!-- Social Box -->
                        <ul class="social-box">
                            <li><a href="#" class="fa fa-facebook-f"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-dribbble"></a></li>
                        </ul>
                        <div class="content">
                            <h5><?= $t->nama;?></h5>
                            <div class="designation"><?= $t->jabatan;?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
<!--End Sponsors Section-->

<!--Sponsors Section-->
<section class="sponsors-section style-two">
    <div class="auto-container">
        <div class="sec-title centered margin-top">
            <div class="title">Mitra</div>
            <h2>Kami berkolaborasi dengan berbagai sektor perusahaan </h2>
        </div>
        <div class="carousel-outer">
            <!--Sponsors Slider-->
            <ul class="sponsors-carousel owl-carousel owl-theme">
                <?php foreach($mitra as $m): ?>
                <li>
                    <div class="image-box"><img src="<?=$m->photo_url?>" alt="<?=$m->nama?>" style="height:100px"></a></div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
</section>
<!--End Sponsors Section-->
