<?php

namespace App\Controllers;

use Hashids\Hashids;

class CmsData extends BaseController
{
    protected $db;

    public function __construct()
    {
        helper(['url', 'form', 'array']);
        date_default_timezone_set('Asia/Jakarta');
        $this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function blog()
    {
        $data['mymenu'] = "DATA";
        $data['mysubmenu'] = "BLOG";
        $data['js'] = array("blog/list.js?r=" . uniqid());
        $data['vendorcss'] = $this->plugins->cssDataTables();
        $data['vendorjs'] = $this->plugins->jsDataTables();
        $data['tag'] = $this->serverside->listTag();
        $data['main_content']   = 'cms/blog/index';
        echo view('template/template', $data);
    }

    public function blog_()
    {
        $encrypter = \Config\Services::encrypter();
        $column_order = array(NULL, NULL, 'judul', 'ringkasan', 'blog.status', NULL);
        $column_search = array('judul');
        $order = array('judul' => 'asc');

        $table = 'blog';
        $select = '*';

        $list = $this->serverside->limitRows($table, $select, $column_order, $column_search, $order);
        $data = array();
        $no = $this->request->getPost('start');
        foreach ($list as $field) {
            $id_encrypt = bin2hex($encrypter->encrypt($field->id));
            $row = array();
            $no++;

            $selected_tag = $this->selected_tag($field->id);

            $row[]  = $no;
            $row[]  = '<img src="' . $field->photo_url . '" class="img-thumbnail" width="150">';
            $row[]  = $field->judul;
            $row[]  = $field->ringkasan;
            $row[]  = ($field->status == 1) ? '<span class="badge bg-success-transparent-2 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Publish</span>' : '<span class="badge bg-warning-transparent-2 text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Draft</span>';
            $row[]  = '<div class="d-flex justify-content-center align-items-center">
                        <span class="badge bg-info-transparent-2 ms-2 text-info px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center edit" 
                            data-id="' . $id_encrypt . '" 
                            data-judul="' . $field->judul . '"
                            data-photo="' . $field->photo_url . '"
                            data-ringkasan="' . $field->ringkasan . '"
                            data-status="' . $field->status . '"
                            data-konten="' . $field->konten . '"
                            data-tag="' . $selected_tag . '"
                            role="button">Edit</span>
                        <span class="badge bg-danger-transparent-2 ms-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center delete" role="button" data-id="' . $id_encrypt . '" data-judul="' . $field->judul . '">Delete</span>
                      </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->serverside->countAll($table),
            "recordsFiltered" => $this->serverside->countFiltered($table, $select, $column_order, $column_search, $order),
            "data" => $data,
        );
        echo json_encode($output);
    }

    private function selected_tag($id)
    {
        $query = $this->db->query("SELECT DISTINCT(`name`) FROM blog_tag WHERE blog_id=?", array($id));
        $list = $query->getResult();
        $tag = "";
        foreach ($list as $ls) {
            $tag .= $ls->name . ',';
        }

        return rtrim($tag, ", ");
    }

    private function selected_tag_portfolio($id)
    {
        $query = $this->db->query("SELECT DISTINCT(`nama`) FROM portfolio_tag WHERE id_portfolio=?", array($id));
        $list = $query->getResult();
        $tag = "";
        foreach ($list as $ls) {
            $tag .= $ls->nama . ',';
        }

        return rtrim($tag, ", ");
    }

    public function create_blog()
    {
        $blog['judul'] = htmlspecialchars($this->request->getPost('judul'), ENT_QUOTES);

        $photo = $this->request->getFile("photo");
        if ($photo->isValid()) {
            $file = $photo->getTempName();
            $path = $photo->getName();
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                $photo->move(WRITEPATH . '../public/assets-cms/img/blog/');
                $blog['photo_url'] = base_url('/assets-cms/img/blog/' . $path);
            } else {
                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = 'Format File Tidak Diijinkan!';
            }
        } else {
            $blog['photo_url'] = base_url('/assets-cms/img/no-image.jpg');
        }

        $slug = strtolower(url_title($blog['judul']));
        $blog['slug'] = $slug;
        $blog['ringkasan'] = htmlspecialchars($this->request->getPost('ringkasan'), ENT_QUOTES);
        $blog['konten'] = htmlspecialchars($this->request->getPost('konten'), ENT_QUOTES);
        $blog['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
        $blog['create_user'] = session()->get('admin_name');

        if (!empty($_POST['tag'])) {
            $im_tag = implode(', ', array_column(json_decode($_POST['tag']), 'value'));
            $ex_tag = explode(', ', $im_tag);
            $blog_tag['listTag'] = $ex_tag;
        } else {
            $blog_tag = NULL;
        }

        $result = $this->serverside->createBlog($blog, $blog_tag);

        if ($result) {
            $r['result'] = true;
        } else {
            $r['result'] = false;
            $r['title'] = 'Maaf Gagal Menyimpan!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
        }

        return json_encode($r);
    }

    public function update_blog()
    {
        $id_ = htmlspecialchars($this->request->getPost('id'), ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id = $encrypter->decrypt(hex2bin($id_));

        $blog['judul'] = htmlspecialchars($this->request->getPost('judul'), ENT_QUOTES);

        $photo = $this->request->getFile("photo");
        if ($photo->isValid()) {
            $file = $photo->getTempName();
            $path = $photo->getName();
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                $src = $this->db->table('blog')->getWhere(['id' => $id])->getRow()->photo_url;

                $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
                $a = explode("/", $file_name);

                if (file_exists('./assets-cms/img/blog/' . end($a))) {
                    unlink('./assets-cms/img/blog/' . end($a));
                }

                $photo->move(WRITEPATH . '../public/assets-cms/img/blog/');
                $blog['photo_url'] = base_url('/assets-cms/img/blog/' . $path);
            } else {
                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = 'Format File Tidak Diijinkan!';
            }
        } else {
            $blog['photo_url'] = htmlspecialchars($this->request->getPost('photo_url'), ENT_QUOTES);
        }

        $slug = strtolower(url_title($blog['judul']));
        $blog['slug'] = $slug;
        $blog['ringkasan'] = htmlspecialchars($this->request->getPost('ringkasan'), ENT_QUOTES);
        $blog['konten'] = htmlspecialchars($this->request->getPost('konten'), ENT_QUOTES);
        $blog['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
        $blog['create_user'] = session()->get('admin_name') . ':' . session()->get('admin_id');

        if (!empty($_POST['tags'])) {
            $im_tag = implode(', ', array_column(json_decode($_POST['tags']), 'value'));
            $ex_tag = explode(', ', $im_tag);
            $blog_tag['listTag'] = $ex_tag;
        } else {
            $blog_tag = NULL;
        }

        $r['result'] = true;

        $result = $this->serverside->updateBlog($id, $blog, $blog_tag);

        if (!$result) {
            $r['result'] = false;
            $r['title'] = 'Maaf Gagal Menyimpan!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
        } else {
            $r['result'] = true;
        }

        echo json_encode($r);
        return;
    }

    function delete_blog($id)
    {
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id_dec = $encrypter->decrypt(hex2bin($id_));
        if ($this->serverside->deleteBlog($id_dec)) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        echo json_encode($r);
    }

    //MITRA
    public function mitra()
    {
        $data['mymenu'] = "DATA";
        $data['mysubmenu'] = "MITRA";
        $data['vendorcss'] = $this->plugins->cssDataTables();
        $data['vendorjs'] = $this->plugins->jsDataTables();
        $data['js'] = array("mitra/index.js?r=" . uniqid());
        $data['main_content']  = 'cms/mitra/index';
        echo view('template/template', $data);
    }

    public function mitra_()
    {
        $encrypter = \Config\Services::encrypter();
        $column_order = array(NULL, 'photo_url', 'nama', 'status', NULL);
        $column_search = array('nama');
        $order = array('nama' => 'asc');

        $table = 'mitra';
        $select = '*';

        $list = $this->serverside->limitRows($table, $select, $column_order, $column_search, $order);
        $data = array();

        $no = $this->request->getPost("start");
        foreach ($list as $field) {
            $id_encrypt = bin2hex($encrypter->encrypt($field->id));
            $no++;
            $row = array();

            $row[]  = $no;
            $row[]  = '<img src="' . $field->photo_url . '" class="img-thumbnail" width="150">';
            $row[]  = $field->nama;
            $row[]  = ($field->status == 1) ? '<span class="badge bg-success-transparent-2 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Active</span>' : '<span class="badge bg-danger-transparent-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Inactive</span>';
            $row[]  = '<div class="d-flex justify-content-center align-items-center">
                            <span class="badge bg-info-transparent-2 ms-2 text-info px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center edit" role="button" data-id="' . $id_encrypt . '" data-nama="' . $field->nama . '" data-photo_url="' . $field->photo_url . '" data-status="' . $field->status . '">Edit</span>
                            <span class="badge bg-danger-transparent-2 ms-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center delete" role="button" data-id="' . $id_encrypt . '" data-nama="' . $field->nama . '">Delete</span>
                        </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->serverside->countAll($table),
            "recordsFiltered" => $this->serverside->countFiltered($table, $select, $column_order, $column_search, $order),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function create_mitra()
    {
        if ($this->request->getPost()) {
            $val = $this->validate(
                [
                    'nama' => 'required',
                    'status' => 'required',
                    'photo' => [
                        'mime_in[photo,image/jpg,image/jpeg,image/png]',
                        'max_size[photo,2024]',
                    ],
                ],
                [   // Errors  
                    'photo' => [
                        'mime_in' => 'You must have a picture',
                        'max_size' => 'File size no more than 2mb'
                    ],
                ]
            );

            if (!$val) {
                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = \Config\Services::validation()->listErrors();
                echo json_encode($r);
                return;
            } else {
                $data['nama']   = htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES);
                $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
                $data['create_user'] = session()->get('admin_name');
                $data['create_date'] = date('Y-m-d H:i:s');

                $photo = $this->request->getFile("photo");

                if ($photo->isValid()) {
                    $path = $photo->getName();
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                        $photo->move(WRITEPATH . '../public/assets-cms/img/mitra/');
                        $data['photo_url'] = base_url('/assets-cms/img/mitra/' . $path);
                    } else {
                        $r['result'] = false;
                        $r['title'] = 'Gagal!';
                        $r['icon'] = 'error';
                        $r['status'] = 'Format File Tidak Diijinkan!';
                        echo json_encode($r);
                        return;
                    }
                } else {
                    $data['photo_url'] = base_url('/assets/img/no-image.jpg');
                }

                $table = 'mitra';
                $result = $this->serverside->createRows($data, $table);

                if (!$result) {
                    $r['result'] = false;
                    $r['title'] = 'Maaf Gagal Menyimpan!';
                    $r['icon'] = 'error';
                    $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
                } else {
                    $r['result'] = true;
                    $r['status'] = '<br><b>Berhasil di Simpan!</b>';
                }

                echo json_encode($r);
                return;
            }
        } else {
            $r['result'] = false;
            $r['title'] = '404!';
            echo json_encode($r);
            return;
        }
    }

    public function update_mitra()
    {
        $id_ = htmlspecialchars($this->request->getPost('id'), ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id = $encrypter->decrypt(hex2bin($id_));

        $data['nama']   = htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES);
        $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
        $data['edit_user'] = session()->get('admin_name');
        $data['edit_date'] = date('Y-m-d H:i:s');

        $photo = $this->request->getFile("photo");

        if ($photo->isValid()) {
            $file = $photo->getTempName();
            $path = $photo->getName();
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                $src = $this->db->table('mitra')->getWhere(['id' => $id])->getRow()->photo_url;
                $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
                $a = explode("/", $file_name);

                if (file_exists('./assets-cms/img/mitra/' . end($a))) {
                    unlink('./assets-cms/img/mitra/' . end($a));
                }

                $photo->move(WRITEPATH . '../public/assets-cms/img/mitra/');
                $data['photo_url'] = base_url('/assets-cms/img/mitra/' . $path);
            } else {
                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = 'Format File Tidak Diijinkan!';
                echo json_encode($r);
                return;
            }
        } else {
            $data['photo_url'] = htmlspecialchars($this->request->getPost('photo_url'), ENT_QUOTES);
        }

        $r['result'] = true;

        $table = 'mitra';
        $result = $this->serverside->updateRows($id, $data, $table);

        if (!$result) {
            $r['result'] = false;
            $r['title'] = 'Maaf Gagal Menyimpan!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
        }
        echo json_encode($r);
        return;
    }

    function delete_mitra($id)
    {
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id_dec = $encrypter->decrypt(hex2bin($id_));

        $src = $this->db->table('mitra')->getWhere(['id' => $id_dec])->getRow()->photo_url;
        $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
        $a = explode("/", $file_name);

        if (file_exists('./assets-cms/img/mitra/' . end($a))) {
            unlink('./assets-cms/img/mitra/' . end($a));
        }

        $table = 'mitra';
        if ($this->serverside->deleteRows($id_dec, $table)) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        echo json_encode($r);
    }

    //PORTFOLIO
    public function portfolio()
    {
        $data['mymenu'] = "DATA";
        $data['mysubmenu'] = "PORTFOLIO";
        $data['vendorcss'] = $this->plugins->cssDataTables();
        $data['vendorjs'] = $this->plugins->jsDataTables();
        $data['js'] = array("data/portfolio.js?r=" . uniqid());
        $data['tag'] = $this->serverside->listTagPortfolio();
        $data['main_content']  = 'cms/data/portfolio';
        echo view('template/template', $data);
    }

    public function portfolio_()
    {
        $encrypter = \Config\Services::encrypter();
        $column_order = array(NULL, 'photo_url', 'client', 'title', 'keterangan', 'status', NULL);
        $column_search = array('client', 'title', 'keterangan');
        $order = array('title' => 'asc');

        $table = 'portfolio';
        $select = '*';

        $list = $this->serverside->limitRows($table, $select, $column_order, $column_search, $order);
        $data = array();
        $no = $this->request->getPost('start');
        foreach ($list as $field) {
            $id_encrypt = bin2hex($encrypter->encrypt($field->id));
            $row = array();
            $no++;

            $selected_tag = $this->selected_tag_portfolio($field->id);

            $row[]  = $no;
            $row[]  = '<img src="' . $field->photo_url . '" class="img-thumbnail" width="150">';
            $row[]  = $field->client;
            $row[]  = $field->title;
            $row[]  = $field->keterangan;
            $row[]  = ($field->status == 1) ? '<span class="badge bg-success-transparent-2 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Publish</span>' : '<span class="badge bg-warning-transparent-2 text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Draft</span>';
            $row[]  = '<div class="d-flex justify-content-center align-items-center">
                        <span class="badge bg-info-transparent-2 ms-2 text-info px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center edit" 
                            data-id="' . $id_encrypt . '" 
                            data-title="' . $field->title . '"
                            data-keterangan="' . $field->keterangan . '"
                            data-status="' . $field->status . '"
                            data-client="' . $field->client . '"
                            data-location_project="' . $field->location_project . '"
                            data-date_project="' . $field->date_project . '"
                            data-photo_url="' . $field->photo_url . '"
                            data-tag="' . $selected_tag . '"
                            role="button">Edit</span>
                        <span class="badge bg-danger-transparent-2 ms-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center delete" role="button" data-id="' . $id_encrypt . '" data-title="' . $field->title . '">Delete</span>
                      </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->serverside->countAll($table),
            "recordsFiltered" => $this->serverside->countFiltered($table, $select, $column_order, $column_search, $order),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function create_portfolio()
    {
        if ($this->request->getPost()) {
            $val = $this->validate(
                [
                    'title' => 'required',
                    'status' => 'required',
                    'photo' => [
                        'mime_in[photo,image/jpg,image/jpeg,image/png]',
                        'max_size[photo,2024]',
                    ],
                ],
                [   // Errors  
                    'photo' => [
                        'mime_in' => 'You must have a picture',
                        'max_size' => 'File size no more than 2mb'
                    ],
                ]
            );

            if (!$val) {
                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = \Config\Services::validation()->listErrors();
                echo json_encode($r);
                return;
            } else {
                $data['title']   = htmlspecialchars($this->request->getPost('title'), ENT_QUOTES);
                $data['keterangan'] = htmlspecialchars($this->request->getPost('keterangan'), ENT_QUOTES);
                $data['deskripsi']  = $this->request->getPost('deskripsi');
                $data['client'] = htmlspecialchars($this->request->getPost('client'), ENT_QUOTES);
                $data['location_project'] = htmlspecialchars($this->request->getPost('location_project'), ENT_QUOTES);
                $data['date_project'] = htmlspecialchars($this->request->getPost('date_project'), ENT_QUOTES);
                $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
                $data['create_user'] = session()->get('admin_name');
                $data['create_date'] = date('Y-m-d H:i:s');

                $photo = $this->request->getFile("photo");

                if ($photo->isValid()) {
                    $path = $photo->getName();
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                        $photo->move(WRITEPATH . '../public/assets-cms/img/portfolio/');
                        $data['photo_url'] = base_url('/assets-cms/img/portfolio/' . $path);
                    } else {
                        $r['result'] = false;
                        $r['title'] = 'Gagal!';
                        $r['icon'] = 'error';
                        $r['status'] = 'Format File Tidak Diijinkan!';
                        echo json_encode($r);
                        return;
                    }
                } else {
                    $data['photo_url'] = base_url('/assets/img/no-image.jpg');
                }

                if (!empty($_POST['tag'])) {
                    $im_tag = implode(', ', array_column(json_decode($_POST['tag']), 'value'));
                    $ex_tag = explode(', ', $im_tag);
                    $portfolio_tag['listTag'] = $ex_tag;
                } else {
                    $portfolio_tag = NULL;
                }

                $result = $this->serverside->createPortfolio($data, $portfolio_tag);

                if (!$result) {
                    $r['result'] = false;
                    $r['title'] = 'Maaf Gagal Menyimpan!';
                    $r['icon'] = 'error';
                    $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
                } else {
                    $r['result'] = true;
                    $r['status'] = '<br><b>Berhasil di Simpan!</b>';
                }

                echo json_encode($r);
                return;
            }
        } else {
            $r['result'] = false;
            $r['title'] = '404!';
            echo json_encode($r);
            return;
        }
    }

    public function update_portfolio()
    {
        $id_ = htmlspecialchars($this->request->getPost('id'), ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id = $encrypter->decrypt(hex2bin($id_));

        $data['title']   = htmlspecialchars($this->request->getPost('title'), ENT_QUOTES);
        $data['keterangan']   = htmlspecialchars($this->request->getPost('keterangan'), ENT_QUOTES);
        $data['deskripsi']  = $this->request->getPost('deskripsi');
        $data['client'] = htmlspecialchars($this->request->getPost('client'), ENT_QUOTES);
        $data['location_project'] = htmlspecialchars($this->request->getPost('location_project'), ENT_QUOTES);
        $data['date_project'] = htmlspecialchars($this->request->getPost('date_project'), ENT_QUOTES);
        $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
        $data['edit_user'] = session()->get('admin_name');
        $data['edit_date'] = date('Y-m-d H:i:s');

        $photo = $this->request->getFile("photo");

        if ($photo->isValid()) {
            $file = $photo->getTempName();
            $path = $photo->getName();
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                $src = $this->db->table('portfolio')->getWhere(['id' => $id])->getRow()->photo_url;
                $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
                $a = explode("/", $file_name);

                if (file_exists('./assets-cms/img/portfolio/' . end($a))) {
                    unlink('./assets-cms/img/portfolio/' . end($a));
                }

                $photo->move(WRITEPATH . '../public/assets-cms/img/portfolio/');
                $data['photo_url'] = base_url('/assets-cms/img/portfolio/' . $path);
            } else {
                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = 'Format File Tidak Diijinkan!';
                echo json_encode($r);
                return;
            }
        }

        $this->serverside->deleteRowsBy('id_portfolio', $id, 'portfolio_tag');

        if (!empty($_POST['tags'])) {
            $im_tag = implode(', ', array_column(json_decode($_POST['tags']), 'value'));
            $ex_tag = explode(', ', $im_tag);
            $portfolio_tag['listTag'] = $ex_tag;
        } else {
            $portfolio_tag = NULL;
        }

        $r['result'] = true;

        $result = $this->serverside->updatePortfolio($id, $data, $portfolio_tag);
        if (!$result) {
            $r['result'] = false;
            $r['title'] = 'Maaf Gagal Menyimpan!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
        }
        echo json_encode($r);
        return;
    }

    function delete_portfolio($id)
    {
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id_dec = $encrypter->decrypt(hex2bin($id_));

        $src = $this->db->table('portfolio')->getWhere(['id' => $id_dec])->getRow()->photo_url;
        $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
        $a = explode("/", $file_name);

        if (file_exists('./assets-cms/img/portfolio/' . end($a))) {
            unlink('./assets-cms/img/portfolio/' . end($a));
        }

        $table = 'portfolio';
        if ($this->serverside->deleteRows($id_dec, $table)) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        echo json_encode($r);
    }

    //TESTIMONI
    public function testimoni()
    {
        $data['mymenu'] = "DATA";
        $data['mysubmenu'] = "TESTIMONI";
        $data['vendorcss'] = $this->plugins->cssDataTables();
        $data['vendorjs'] = $this->plugins->jsDataTables();
        $data['js'] = array("produk/testimoni.js?r=" . uniqid());
        $data['main_content']  = 'cms/produk/testimoni';
        echo view('template/template', $data);
    }

    public function testimoni_()
    {
        $encrypter = \Config\Services::encrypter();
        $column_order = array(NULL, 'photo_url', 'nama', 'title', 'deskripsi', 'status', NULL);
        $column_search = array('nama', 'title',);
        $order = array('nama' => 'asc');

        $table = 'testimoni';
        $select = '*';

        $list = $this->serverside->limitRows($table, $select, $column_order, $column_search, $order);
        $data = array();

        $no = $this->request->getPost("start");
        foreach ($list as $field) {
            $id_encrypt = bin2hex($encrypter->encrypt($field->id));
            $no++;
            $row = array();

            if ($field->youtube_url != '') {
                $deskripsi =
                    '<p>' . $field->deskripsi . '</p>
                        <div class="d-flex">
                            <a href="' . $field->youtube_url . '" target="blank_" class="btn btn-default btn-sm"><i class="fab fa-youtube"></i> Video Testimoni</a>
                        </div>';
            } else {
                $deskripsi = $field->deskripsi;
            }

            $row[]  = $no;
            $row[]  = '<img src="' . $field->photo_url . '" class="img-thumbnail" width="150">';
            $row[]  = $field->nama;
            $row[]  = $field->title;
            $row[]  = $deskripsi;
            $row[]  = ($field->status == 1) ? '<span class="badge bg-success-transparent-2 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Active</span>' : '<span class="badge bg-danger-transparent-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Inactive</span>';
            $row[]  = '<div class="d-flex justify-content-center align-items-center">
                            <span class="badge bg-info-transparent-2 ms-2 text-info px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center edit" role="button" data-id="' . $id_encrypt . '" data-nama="' . $field->nama . '" data-title="' . $field->title . '" data-youtube_url="' . $field->youtube_url . '" data-deskripsi="' . $field->deskripsi . '"  data-photo_url="' . $field->photo_url . '" data-status="' . $field->status . '">Edit</span>
                            <span class="badge bg-danger-transparent-2 ms-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center delete" role="button" data-id="' . $id_encrypt . '" data-nama="' . $field->nama . '">Delete</span>
                        </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->serverside->countAll($table),
            "recordsFiltered" => $this->serverside->countFiltered($table, $select, $column_order, $column_search, $order),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function create_testimoni()
    {
        if ($this->request->getPost()) {
            $val = $this->validate(
                [
                    'nama' => 'required',
                    'title' => 'required',
                    'deskripsi' => 'required',
                    'youtube_url' => 'required',
                    'status' => 'required',
                    'photo' => [
                        'mime_in[photo,image/jpg,image/jpeg,image/png]',
                        'max_size[photo,2024]',
                    ],
                ],
                [   // Errors  
                    'photo' => [
                        'mime_in' => 'You must have a picture',
                        'max_size' => 'File size no more than 2mb'
                    ],
                ]
            );

            if (!$val) {
                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = \Config\Services::validation()->listErrors();
                echo json_encode($r);
                return;
            } else {
                $data['nama']   = htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES);
                $data['title']   = htmlspecialchars($this->request->getPost('title'), ENT_QUOTES);
                $data['deskripsi']   = htmlspecialchars($this->request->getPost('deskripsi'), ENT_QUOTES);
                $data['youtube_url']   = htmlspecialchars($this->request->getPost('youtube_url'), ENT_QUOTES);
                $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
                $data['create_user'] = session()->get('admin_name');
                $data['create_date'] = date('Y-m-d H:i:s');

                $photo = $this->request->getFile("photo");

                if ($photo->isValid()) {
                    $path = $photo->getName();
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                        $photo->move(WRITEPATH . '../public/assets-cms/img/testimoni/');
                        $data['photo_url'] = base_url('/assets-cms/img/testimoni/' . $path);
                    } else {
                        $r['result'] = false;
                        $r['title'] = 'Gagal!';
                        $r['icon'] = 'error';
                        $r['status'] = 'Format File Tidak Diijinkan!';
                        echo json_encode($r);
                        return;
                    }
                } else {
                    $data['photo_url'] = base_url('/assets/img/no-image.jpg');
                }

                $table = 'testimoni';
                $result = $this->serverside->createRows($data, $table);

                if (!$result) {
                    $r['result'] = false;
                    $r['title'] = 'Maaf Gagal Menyimpan!';
                    $r['icon'] = 'error';
                    $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
                } else {
                    $r['result'] = true;
                    $r['status'] = '<br><b>Berhasil di Simpan!</b>';
                }

                echo json_encode($r);
                return;
            }
        } else {
            $r['result'] = false;
            $r['title'] = '404!';
            echo json_encode($r);
            return;
        }
    }

    public function update_testimoni()
    {
        $id_ = htmlspecialchars($this->request->getPost('id'), ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id = $encrypter->decrypt(hex2bin($id_));

        $data['nama']   = htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES);
        $data['title']   = htmlspecialchars($this->request->getPost('title'), ENT_QUOTES);
        $data['deskripsi']   = htmlspecialchars($this->request->getPost('deskripsi'), ENT_QUOTES);
        $data['youtube_url']   = htmlspecialchars($this->request->getPost('youtube_url'), ENT_QUOTES);
        $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
        $data['edit_user'] = session()->get('admin_name');
        $data['edit_date'] = date('Y-m-d H:i:s');

        $photo = $this->request->getFile("photo");

        if ($photo->isValid()) {
            $file = $photo->getTempName();
            $path = $photo->getName();
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                $src = $this->db->table('testimoni')->getWhere(['id' => $id])->getRow()->photo_url;
                $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
                $a = explode("/", $file_name);

                if (file_exists('./assets-cms/img/testimoni/' . end($a))) {
                    unlink('./assets-cms/img/testimoni/' . end($a));
                }

                $photo->move(WRITEPATH . '../public/assets-cms/img/testimoni/');
                $data['photo_url'] = base_url('/assets-cms/img/testimoni/' . $path);
            } else {
                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = 'Format File Tidak Diijinkan!';
                echo json_encode($r);
                return;
            }
        } else {
            $data['photo_url'] = htmlspecialchars($this->request->getPost('photo_url'), ENT_QUOTES);
        }

        $r['result'] = true;

        $table = 'testimoni';
        $result = $this->serverside->updateRows($id, $data, $table);

        if (!$result) {
            $r['result'] = false;
            $r['title'] = 'Maaf Gagal Menyimpan!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
        }
        echo json_encode($r);
        return;
    }

    function delete_testimoni($id)
    {
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id_dec = $encrypter->decrypt(hex2bin($id_));

        $src = $this->db->table('testimoni')->getWhere(['id' => $id_dec])->getRow()->photo_url;
        $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
        $a = explode("/", $file_name);

        if (file_exists('./assets-cms/img/testimoni/' . end($a))) {
            unlink('./assets-cms/img/testimoni/' . end($a));
        }

        $table = 'testimoni';
        if ($this->serverside->deleteRows($id_dec, $table)) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        echo json_encode($r);
    }
}
