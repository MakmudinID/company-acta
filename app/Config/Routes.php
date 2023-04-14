<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('/struktur-organisasi', 'Home::struktur_organisasi');
$routes->get('/blog', 'Home::blog');
$routes->get('/blog-detail', 'Home::blog_detail');
$routes->get('/tentang-kami', 'Home::tentang_kami');
$routes->get('/galeri-produk', 'Home::galeri_produk');
$routes->get('/portfolio', 'Home::portfolio');
$routes->get('/portfolio-detail', 'Home::portfolio_detail');
$routes->get('/gudang', 'Home::gudang');
$routes->get('/produk-kategori/(:any)', 'Home::produk_kategori/$1');
$routes->get('/produk/(:any)', 'Home::produk/$1');

$routes->get('/profil', 'Home::profil');

//PRODUK
$routes->get('/cms/product', 'CmsProduk::product', ['filter' => 'auth']);
$routes->post('/cms/product_', 'CmsProduk::product_', ['filter' => 'auth']);
$routes->post('/cms/create_product', 'CmsProduk::create_product', ['filter' => 'auth']);
$routes->post('/cms/update_product', 'CmsProduk::update_product', ['filter' => 'auth']);
$routes->get('/cms/delete_product/(:any)', 'CmsProduk::delete_product/$1', ['filter' => 'auth']);

$routes->get('/cms/product-category', 'CmsProduk::product_category', ['filter' => 'auth']);
$routes->post('/cms/product_category_', 'CmsProduk::product_category_', ['filter' => 'auth']);
$routes->post('/cms/create_product_category', 'CmsProduk::create_product_category', ['filter' => 'auth']);
$routes->post('/cms/update_product_category', 'CmsProduk::update_product_category', ['filter' => 'auth']);
$routes->get('/cms/delete_product_category/(:any)', 'CmsProduk::delete_product_category/$1', ['filter' => 'auth']);

$routes->get('/cms/product-gallery', 'CmsProduk::produk_gallery', ['filter' => 'auth']);
$routes->post('/cms/produk_gallery_', 'CmsProduk::produk_gallery_', ['filter' => 'auth']);
$routes->post('/cms/create_produk_gallery', 'CmsProduk::create_produk_gallery', ['filter' => 'auth']);
$routes->post('/cms/update_produk_gallery', 'CmsProduk::update_produk_gallery', ['filter' => 'auth']);
$routes->get('/cms/delete_produk_gallery/(:any)', 'CmsProduk::delete_produk_gallery/$1', ['filter' => 'auth']);  

$routes->get('/cms/product-price', 'CmsProduk::product_price', ['filter' => 'auth']);
$routes->post('/cms/product_price_', 'CmsProduk::product_price_', ['filter' => 'auth']);
$routes->post('/cms/update_produk_price', 'CmsProduk::update_product_price', ['filter' => 'auth']);
$routes->post('/cms/fetch-modal-fitur', 'CmsProduk::fetch_modal_fitur', ['filter' => 'auth']);


//DATA
$routes->get('/cms/blog', 'CmsData::blog', ['filter' => 'auth']);
$routes->post('/cms/blog_', 'CmsData::blog_', ['filter' => 'auth']);
$routes->post('/cms/create_blog', 'CmsData::create_blog', ['filter' => 'auth']);
$routes->post('/cms/update_blog', 'CmsData::update_blog', ['filter' => 'auth']);
$routes->get('/cms/delete_blog/(:any)', 'CmsData::delete_blog/$1', ['filter' => 'auth']);

$routes->get('/cms/mitra', 'CmsData::mitra', ['filter' => 'auth']);
$routes->post('/cms/mitra_', 'CmsData::mitra_', ['filter' => 'auth']);
$routes->post('/cms/create_mitra', 'CmsData::create_mitra', ['filter' => 'auth']);
$routes->post('/cms/update_mitra', 'CmsData::update_mitra', ['filter' => 'auth']);
$routes->get('/cms/delete_mitra/(:any)', 'CmsData::delete_mitra/$1', ['filter' => 'auth']);

$routes->get('/cms/portfolio', 'CmsData::portfolio', ['filter' => 'auth']);
$routes->post('/cms/portfolio_', 'CmsData::portfolio_', ['filter' => 'auth']);
$routes->post('/cms/create_portfolio', 'CmsData::create_portfolio', ['filter' => 'auth']);
$routes->post('/cms/update_portfolio', 'CmsData::update_portfolio', ['filter' => 'auth']);
$routes->get('/cms/delete_portfolio/(:any)', 'CmsData::delete_portfolio/$1', ['filter' => 'auth']);

$routes->get('/cms/testimoni', 'CmsData::testimoni', ['filter' => 'auth']);
$routes->post('/cms/testimoni_', 'CmsData::testimoni_', ['filter' => 'auth']);
$routes->post('/cms/create_testimoni', 'CmsData::create_testimoni', ['filter' => 'auth']);
$routes->post('/cms/update_testimoni', 'CmsData::update_testimoni', ['filter' => 'auth']);
$routes->get('/cms/delete_testimoni/(:any)', 'CmsData::delete_testimoni/$1', ['filter' => 'auth']);

//CMS
$routes->get('/cms/home', 'Cms::index', ['filter' => 'auth']);
$routes->post('/cms/upload_image_content', 'Cms::upload_image_content', ['filter' => 'auth']);
$routes->post('/cms/delete_image_content', 'Cms::delete_image_content', ['filter' => 'auth']);

//KONFIGURASI
$routes->get('/cms/visi-misi', 'Konfigurasi::visimisi', ['filter' => 'auth']);
$routes->post('/cms/visimisi_', 'Konfigurasi::visimisi_', ['filter' => 'auth']);
$routes->post('/cms/create_visimisi', 'Konfigurasi::create_visimisi', ['filter' => 'auth']);
$routes->post('/cms/update_visimisi', 'Konfigurasi::update_visimisi', ['filter' => 'auth']);
$routes->get('/cms/delete_visimisi/(:any)', 'Konfigurasi::delete_visimisi/$1', ['filter' => 'auth']);

$routes->get('/cms/konfigurasi', 'Konfigurasi::index', ['filter' => 'auth']);
$routes->post('/cms/update-konfigurasi', 'Konfigurasi::update_konfigurasi', ['filter' => 'auth']);

$routes->get('/cms/user-profile', 'Konfigurasi::profil', ['filter' => 'auth']);
$routes->post('/cms/update-profile', 'Konfigurasi::update_profil', ['filter' => 'auth']);

$routes->get('/cms/user', 'Konfigurasi::user', ['filter' => 'auth']);
$routes->post('/cms/user_', 'Konfigurasi::user_', ['filter' => 'auth']);
$routes->post('/cms/create_user', 'Konfigurasi::create_user', ['filter' => 'auth']);
$routes->post('/cms/update_user', 'Konfigurasi::update_user', ['filter' => 'auth']);
$routes->get('/cms/delete_user/(:any)', 'Konfigurasi::delete_user/$1', ['filter' => 'auth']);

$routes->get('/cms/struktur-organisasi', 'Konfigurasi::struktur_organisasi', ['filter' => 'auth']);
$routes->post('/cms/struktur_organisasi_', 'Konfigurasi::struktur_organisasi_', ['filter' => 'auth']);
$routes->post('/cms/create_struktur_organisasi', 'Konfigurasi::create_struktur_organisasi', ['filter' => 'auth']);
$routes->post('/cms/update_struktur_organisasi', 'Konfigurasi::update_struktur_organisasi', ['filter' => 'auth']);
$routes->get('/cms/delete_struktur_organisasi/(:any)', 'Konfigurasi::delete_struktur_organisasi/$1', ['filter' => 'auth']);

$routes->get('/cms/slider', 'Konfigurasi::slider', ['filter' => 'auth']);
$routes->post('/cms/slider_', 'Konfigurasi::slider_', ['filter' => 'auth']);
$routes->post('/cms/create_slider', 'Konfigurasi::create_slider', ['filter' => 'auth']);
$routes->post('/cms/update_slider', 'Konfigurasi::update_slider', ['filter' => 'auth']);
$routes->get('/cms/delete_slider/(:any)', 'Konfigurasi::delete_slider/$1', ['filter' => 'auth']);

//AUTH
$routes->add('login', 'Auth::index');
$routes->post('auth', 'Auth::p');
$routes->post('auth_pusdiklat', 'Pusdiklat::login_');
$routes->add('logout', 'Auth::s');
$routes->add('forbidden', 'Home::forbidden');

// Would execute the show404 method of the App\Errors class
$routes->set404Override('App\Errors::show404');

// Will display a custom view
$routes->set404Override(static function () {
    echo view('error404');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
