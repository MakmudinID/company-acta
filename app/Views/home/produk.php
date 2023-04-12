<?php echo view('template-front/header-page.php'); ?>
<div class="container">
    <div class="row mt-2">
        <div class="col-lg-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="fas fa-home"></i> Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Produk</a></li>
            </ul>
        </div>
    </div>

    <div class="team-area bottom-less">
        <div class="team-items text-center">
            <div class="row justify-content-center">
                <!-- Single item -->
                <?php foreach ($list_produk as $m) : ?>
                    <div class="single-item col-lg-4 col-md-6 col-6">
                        <div class="item detail-produk" data-nama="<?= $m->nama_produk; ?>" data-photo="<?= $m->photo_url; ?>" data-merek="<?= $m->nama_merek ?>" data-deskripsi="<?= $m->deskripsi ?>" style="cursor: pointer;">
                            <div class="thumb">
                                <img src="<?= $m->photo_url ?>" alt="Thumb">
                            </div>
                            <div class="info-box">
                                <div class="info">
                                    <h5><?= $m->nama_produk; ?></h5>
                                    <span><i class="flaticon-badge"></i> <?= $m->nama_merek; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- End Single item -->
            </div>
            <?= $pager->links('produk_unggulan', 'bootstrap_pagination'); ?>
        </div>
    </div>
</div>
<!-- End Blog -->
<?php echo view('template-front/footer-page.php'); ?>

<div class="modal fade" id="detail-produk" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="" id="photo-produk" class="img-fluid" alt="produk">
                    </div>
                    <div class="col-md-8 align-self-center">
                        <table class="table table-sm table-hover" style="width: 100%;">
                            <tr>
                                <td width="25%">Nama Produk</td>
                                <td>: <label id="text-nama"></label></td>
                            </tr>
                            <tr>
                                <td>Merek Produk</td>
                                <td>: <label id="text-merek"></label></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div id="text-deskripsi"></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>