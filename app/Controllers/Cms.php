<?php

namespace App\Controllers;
use Hashids\Hashids;
class Cms extends BaseController
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
        $data['mymenu'] = "Admin";
        $data['mysubmenu'] = "Home";
        $data['main_content']   = 'cms/home';
        echo view('template/template', $data);
    }

    public function upload_image_content()
    {
        $gambar = $this->request->getFile("image");
        if ($gambar->isValid()) {
            $file = $gambar->getTempName();
            $path = $gambar->getName();
            $gambar->move(WRITEPATH . '../public/assets-cms/img/blog/');
            echo base_url('/assets-cms/img/blog/' . $path);
        }
    }

    public function delete_image_content()
    {
        $src = $this->request->getPost("src");

        $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path

        if (file_exists('./assets-cms/img/blog/' . end($a))) {
            unlink('./assets-cms/img/blog/' . end($a));
            echo 'File Delete Successfully';
        } else {
            echo 'gagal-' . $src;
        }
    }
}
