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

<section class="shop-single-section">
    <div class="auto-container">

        <!--Shop Single-->
        <div class="shop-page product-details">

            <!--Basic Details-->
            <div class="basic-details">
                <div class="row clearfix">

                    <div class="image-column col-lg-6 col-md-12 col-sm-12">
                        <div class="carousel-outer">

                            <ul class="image-carousel owl-carousel owl-theme">
                                <li>
                                    <a href="<?= $produk->photo_url ?>" class="lightbox-image" title="Image Caption Here">
                                        <img src="<?= $produk->photo_url ?>" alt="<?= $produk->nama ?>">
                                    </a>
                                </li>
                                <?php foreach ($galery_produk as $g) : ?>
                                    <li>
                                        <a href="<?= $g->photo_url ?>" class="lightbox-image" title="Image Caption Here">
                                            <img src="<?= $g->photo_url ?>" alt="<?= $g->title ?>">
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <ul class="thumbs-carousel owl-carousel owl-theme">
                                <?php foreach ($galery_produk as $g) : ?>
                                    <li>
                                        <img src="<?= $g->photo_url ?>" alt="<?= $g->title ?>" height="10px">
                                    </li>
                                <?php endforeach; ?>
                                <li>
                                    <img src="<?= $produk->photo_url ?>" alt="<?= $produk->nama ?>" height="10px">
                                </li>
                            </ul>

                        </div>
                    </div>

                    <!--Info Column-->
                    <div class="info-column col-lg-6 col-md-12 col-sm-12">
                        <div class="details-header">
                            <h2><?= $produk->nama; ?></h2>
                            <div class="item-price">Harga: <?= number_format($produk->harga_jasa, 0, ',', '.'); ?></div>
                        </div>
                        <div class="text">
                            <p><?= $produk->ringkasan; ?></p>
                            <hr>
                            <?= $produk->deskripsi; ?>
                        </div>
                    </div>

                </div>
            </div>
            <!--Basic Details-->
        </div>

    </div>
</section>