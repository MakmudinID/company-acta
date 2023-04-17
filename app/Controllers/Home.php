<?php

namespace App\Controllers;

use App\Models\BlogModel;
use App\Models\ProdukModel;
use Hashids\Hashids;
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
        $data['visi'] = $this->db->table('visimisi')->getWhere(['kategori' => 'VISI', 'status' => 1])->getResult();
        $data['misi'] = $this->db->table('visimisi')->getWhere(['kategori' => 'MISI', 'status' => 1])->getResult();
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
        $data['produk'] = $this->konfigurasi->getProduk();
        $data['kategori'] = $this->db->table('product_category')->getWhere(['status' => '1'])->getResult();
        $data['js'] = array("blog/detail.js?r=" . uniqid(), "produk/detail.js?r=" . uniqid());
        return view('template-front/template', $data);
    }

    public function portfolio()
    {
        $data['title'] = 'Portfolio';
        $data['main_content'] = 'home/portfolio';
        $data['tag'] = $this->db->table('portfolio_tag')->groupBy('nama')->get()->getResult();
        $data['portfolio'] = $this->db->table('portfolio')->getWhere(['status' => '1'])->getResult();
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['js'] = array("blog/detail.js?r=" . uniqid(), "produk/detail.js?r=" . uniqid());
        return view('template-front/template', $data);
    }

    public function portfolio_detail($id_portfolio)
    {
        $hashids = new Hashids('53qURe_portfolio', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        $id = $hashids->decode($id_portfolio)[0];

        $data['title'] = 'Portfolio';
        $data['main_content'] = 'home/portfolio_detail';
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['portfolio'] = $this->db->table('portfolio')->getWhere(['id' => $id])->getRow();
        $data['js'] = array("blog/detail.js?r=" . uniqid(), "produk/detail.js?r=" . uniqid());
        return view('template-front/template', $data);
    }

    public function blog()
    {
        $data['title'] = 'Artikel';
        $blog = new BlogModel();
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['list_blog'] = $blog->Where('status', 1)->orderBy('id', 'DESC')->paginate(10, 'blog');
        $data['pager'] = $blog->pager;
        $data['tag'] = $this->db->table('blog_tag')->groupBy('name')->get()->getResult();
        $data['main_content'] = 'home/blog';
        return view('template-front/template', $data);
    }

    public function blog_tag($id_tag)
    {
        $hashids = new Hashids('53qURe_blog', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        $id = $hashids->decode($id_tag)[0];
        $tag_nama = $this->db->table('blog_tag')->getWhere(['tag_id' => $id])->getRow()->name;

        $data['title'] = 'Artikel';
        $blog = new BlogModel();
        $data['tag_name'] = $tag_nama;
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['list_blog'] = $blog->Join('blog_tag','blog_tag.blog_id = blog.id')->Where('status', 1)->Where('blog_tag.name', $tag_nama)->orderBy('id', 'DESC')->paginate(10, 'blog');
        $data['pager'] = $blog->pager;
        $data['tag'] = $this->db->table('blog_tag')->groupBy('name')->get()->getResult();
        $data['main_content'] = 'home/blog';
        return view('template-front/template', $data);
    }

    public function blog_detail($id_blog)
    {
        $hashids = new Hashids('53qURe_blog', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        $id = $hashids->decode($id_blog)[0];

        $data['title'] = 'Artikel';
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['blog'] = $this->db->table('blog')->getWhere(['id' => $id])->getRow();
        $data['tag_by'] = $this->db->table('blog_tag')->getWhere(['blog_id' => $id])->getResult();
        $data['tag'] = $this->db->table('blog_tag')->groupBy('name')->get()->getResult();
        $data['js'] = array("blog/blog_detail.js?r=" . uniqid());
        $data['main_content'] = 'home/blog_detail';
        return view('template-front/template', $data);
    }

    public function blog_search()
    {
        $q = htmlspecialchars($this->request->getGet('q'), ENT_QUOTES);

        $data['title'] = 'Artikel';
        $blog = new BlogModel();
        $data['key'] = $q;

        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['list_blog'] = $blog->Join('blog_tag','blog_tag.blog_id = blog.id')->Where('status', 1)->Like('blog.judul', $q)->orLike('blog.ringkasan', $q)->orderBy('id', 'DESC')->paginate(10, 'blog');
        $data['pager'] = $blog->pager;
        $data['tag'] = $this->db->table('blog_tag')->groupBy('name')->get()->getResult();
        $data['main_content'] = 'home/blog';
        return view('template-front/template', $data);
    }

    public function produk()
    {
        $data['title'] = 'Produk';
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['kategori'] = $this->konfigurasi->getKategoriProduk();
        $data['list_produk'] = $this->db->table('product')->getWhere(['status' => 1])->getResult();
        $data['main_content'] = 'home/produk_kategori';
        return view('template-front/template', $data);
    }

    public function produk_search()
    {
        $data['title'] = 'Produk';
        $q = htmlspecialchars($this->request->getGet('q'), ENT_QUOTES);

        $data['key'] = $q;
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['kategori'] = $this->konfigurasi->getKategoriProduk();
        $data['list_produk'] = $this->db->table('product')->where('status', 1)->like('nama', $q)->get()->getResult();
        $data['main_content'] = 'home/produk_kategori';
        return view('template-front/template', $data);
    }

    public function produk_by($id_produk)
    {
        $data['title'] = 'Produk';
        $hashids = new Hashids('53qURe_produk', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        $id = $hashids->decode($id_produk)[0];

        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['produk'] = $this->konfigurasi->getProdukById($id);
        $data['galery_produk'] = $this->db->table('product_gallery')->getWhere(['id_product' => $id])->getResult();
        $data['main_content'] = 'home/produk';
        return view('template-front/template', $data);
    }

    public function produk_kategori($kode_kategori)
    {
        $data['title'] = 'Produk';
        $data['kategori_row'] = $this->db->table('product_category')->getWhere(['kode' => $kode_kategori])->getRow();
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['kategori'] = $this->konfigurasi->getKategoriProduk();
        $data['list_produk'] = $this->konfigurasi->getProdukBy($kode_kategori);
        $data['main_content'] = 'home/produk_kategori';
        return view('template-front/template', $data);
    }

    public function struktur_organisasi()
    {
        $data['produk_unggulan'] = $this->db->table('produk_unggulan')->Select('produk_unggulan.*, merek_dagang.nama as nama_merek')->Join('merek_dagang', 'merek_dagang.id = produk_unggulan.id_merek_dagang')->Where('produk_unggulan.status', 1)->orderBy('produk_unggulan.id', 'DESC')->get()->getResult();
        $data['konfigurasi'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();
        $data['struktur'] = $this->db->table('pengurus')->get()->getResult();
        return view('home/struktur', $data);
    }
}
