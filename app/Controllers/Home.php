<?php

namespace App\Controllers;
use App\Models\BlogModel;
use App\Models\ProdukModel;

class Home extends BaseController
{
    protected $db;

    public function __construct()
    {
        helper(['url', 'form', 'array']);
        date_default_timezone_set('Asia/Jakarta');
        $this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['slider'] = $this->konfigurasi->getSlider();
        $data['testimoni'] = $this->db->table('testimoni')->getWhere(['status' => 1])->getResult();
        $data['gallery'] = $this->db->table('product_gallery')->orderBy('product_gallery.title', 'ASC')->getWhere(['status' => 1])->getResult();
        $data['product_price'] = $this->db->table('price_product')->orderBy('harga')->get()->getResult();
        $data['produk_pilihan'] = $this->db->query('SELECT * FROM product WHERE status=1 AND flag="Highlight" ORDER BY RAND() LIMIT 6')->getResult();
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['mitra'] = $this->db->table('mitra')->getWhere(['status' => 1])->getResult();
        $data['blog'] = $this->db->query('SELECT * FROM blog WHERE status=1 ORDER BY id desc LIMIT 3')->getResult();
        $data['main_content'] = 'home/index';
        $data['js'] = array("blog/detail.js?r=" . uniqid(), "produk/detail.js?r=" . uniqid());
        return view('template-front/template', $data);
    }

    public function tentang_kami()
    {
        $data['title'] = 'Profil';
        $data['main_content'] = 'home/about';
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['mitra'] = $this->db->table('mitra')->getWhere(['status' => '1'])->getResult();
        $data['team'] = $this->db->table('pengurus')->get()->getResult();
        $data['js'] = array("blog/detail.js?r=" . uniqid(), "produk/detail.js?r=" . uniqid());
        return view('template-front/template', $data);
    }

    public function gudang()
    {
        $data['title'] = 'Profil';
        $data['main_content'] = 'home/gudang';
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['js'] = array("blog/detail.js?r=" . uniqid(), "produk/detail.js?r=" . uniqid());
        return view('template-front/template', $data);
    }

    public function galeri_produk()
    {
        $data['title'] = 'Profil';
        $data['main_content'] = 'home/galeri_produk';
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['js'] = array("blog/detail.js?r=" . uniqid(), "produk/detail.js?r=" . uniqid());
        return view('template-front/template', $data);
    }

    public function portfolio()
    {
        $data['title'] = 'Portfolio';
        $data['main_content'] = 'home/portfolio';
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['js'] = array("blog/detail.js?r=" . uniqid(), "produk/detail.js?r=" . uniqid());
        return view('template-front/template', $data);
    }

    public function portfolio_detail()
    {
        $data['title'] = 'Portfolio';
        $data['main_content'] = 'home/portfolio_detail';
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['js'] = array("blog/detail.js?r=" . uniqid(), "produk/detail.js?r=" . uniqid());
        return view('template-front/template', $data);
    }

    public function blog()
    {
        $data['title'] = 'Artikel';
        $blog = new BlogModel();
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['list_blog'] = $blog->Where('status', 1)->orderBy('id', 'DESC')->paginate(12, 'blog');
        $data['pager'] = $blog->pager;
        $data['js'] = array("blog/detail.js?r=" . uniqid());
        $data['main_content'] = 'home/blog';
        return view('template-front/template', $data);
    }

    public function blog_detail()
    {
        $data['title'] = 'Artikel';
        $blog = new BlogModel();
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['list_blog'] = $blog->Where('status', 1)->orderBy('id', 'DESC')->paginate(12, 'blog');
        $data['pager'] = $blog->pager;
        $data['js'] = array("blog/blog_detail.js?r=" . uniqid());
        $data['main_content'] = 'home/blog_detail';
        return view('template-front/template', $data);
    }

    public function profil()
    {
        // $data['produk_unggulan'] = $this->db->table('produk_unggulan')->Select('produk_unggulan.*, merek_dagang.nama as nama_merek')->Join('merek_dagang', 'merek_dagang.id = produk_unggulan.id_merek_dagang')->Where('produk_unggulan.status', 1)->orderBy('produk_unggulan.id', 'DESC')->get()->getResult();
        // $data['blog'] = $this->db->query('SELECT * FROM blog WHERE status=1 ORDER BY id desc LIMIT 3')->getResult();
        // $data['main_content'] = 'home/index';
        // $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        // return view('home/profil', $data);
    }

    public function produk()
    {
        // $produk = new ProdukModel();

        // $data['produk_unggulan'] = $this->db->table('produk_unggulan')->Select('produk_unggulan.*, merek_dagang.nama as nama_merek')->Join('merek_dagang', 'merek_dagang.id = produk_unggulan.id_merek_dagang')->Where('produk_unggulan.status', 1)->orderBy('produk_unggulan.id', 'DESC')->get()->getResult();
        // $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        // $data['list_produk'] = $produk->Select('produk_unggulan.*, merek_dagang.nama as nama_merek')->Join('merek_dagang', 'merek_dagang.id = produk_unggulan.id_merek_dagang')->Where('produk_unggulan.status', 1)->orderBy('produk_unggulan.id', 'DESC')->paginate(12, 'blog');
        // $data['pager'] = $produk->pager;
        // $data['js'] = array("produk/detail.js?r=" . uniqid());
        // return view('home/produk', $data);
    }

    public function struktur_organisasi()
    {
        $data['produk_unggulan'] = $this->db->table('produk_unggulan')->Select('produk_unggulan.*, merek_dagang.nama as nama_merek')->Join('merek_dagang', 'merek_dagang.id = produk_unggulan.id_merek_dagang')->Where('produk_unggulan.status', 1)->orderBy('produk_unggulan.id', 'DESC')->get()->getResult();
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['struktur'] = $this->db->table('pengurus')->get()->getResult();
        return view('home/struktur', $data);
    }
    
    // public function blog_()
    // {
    //     // $data['get'] = $this->serverside->getBlogBy($slug);
    //     // $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
	// 	// echo view('home/blog_detail', $data);

    //     $produk = new ProdukModel();
    //     // echo $slug;
    //     $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
    //     $data['list_produk'] = $produk->Select('produk_unggulan.*, merek_dagang.nama as nama_merek')->Join('merek_dagang', 'merek_dagang.id = produk_unggulan.id_merek_dagang')->Where('produk_unggulan.status', 1)->orderBy('produk_unggulan.id', 'DESC')->paginate(12, 'blog');
    //     $data['pager'] = $produk->pager;
    //     $data['js'] = array("blog/detail.js?r=" . uniqid());
    //     return view('home/produk', $data);
    // }
}
