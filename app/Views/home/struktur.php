<?php echo view('template-front/header-page.php'); ?>
<div class="container">
    <div class="row mt-2">
        <div class="col-lg-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="fas fa-home"></i> Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Struktur Organisasi</a></li>
            </ul>
        </div>
    </div>
    <div class="team-area bottom-less">
        <div class="team-items text-center">
            <div class="row">
                <!-- Single item -->
                <?php foreach ($struktur as $s) : ?>
                    <div class="single-item col-lg-4 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <img src="<?= $s->foto ?>" alt="Thumb">
                                <div class="social">
                                    <ul>
                                        <?php if($s->link_ig != ''): ?>
                                        <li class="instagram">
                                            <a href="<?=$s->link_ig?>" target="_blank">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if($s->link_fb != ''): ?>
                                        <li class="facebook">
                                            <a href="<?=$s->link_fb?>" target="_blank">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if($s->link_linkedin != ''): ?>
                                        <li class="twitter">
                                            <a href="<?=$s->link_linkedin?>" target="_blank">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="info-box">
                                <div class="info">
                                    <h5><?= $s->nama; ?></h5>
                                    <span><?= $s->jabatan; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- End Single item -->
            </div>
        </div>
    </div>
</div>
<!-- End Blog -->
<?php echo view('template-front/footer-page.php'); ?>