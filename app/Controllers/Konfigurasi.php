<?php

namespace App\Controllers;

use App\Libraries\Plugins;
use App\Models\ProfilModel;
use App\Models\ServerSideModel;

class Konfigurasi extends BaseController
{
    protected $id_;
    protected $table;
    protected $select;
    protected $join;
    protected $db;

    public function __construct()
    {
        helper(['url', 'form', 'array']);
        date_default_timezone_set('Asia/Jakarta');
        $this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function visimisi()
    {
        $data['mymenu'] = "PROFIL";
        $data['mysubmenu'] = "VISI-MISI";
        $data['js'] = array("profil/visi-misi.js?r=" . rand());
        $data['vendorcss'] = $this->plugins->cssDataTables();
        $data['vendorjs'] = $this->plugins->jsDataTables();
        $data['main_content'] = 'cms/profil/visi-misi';
        echo view('template/template', $data);
    }

    public function visimisi_()
    {
        $encrypter = \Config\Services::encrypter();
        $column_order = array('kategori', 'deskripsi', 'status', NULL);
        $column_search = array('kategori', 'deskripsi');
        $order = array('kategori' => 'asc');

        $table = 'visimisi';
        $select = '*';
        $list = $this->serverside->limitRows($table, $select, $column_order, $column_search, $order);
        $data = array();

        foreach ($list as $field) {
            $id_encrypt = bin2hex($encrypter->encrypt($field->id));
            $row = array();

            $row[]  = $field->kategori;
            $row[]  = '<span style="white-space: normal;">' . $field->deskripsi . '</span>';
            $row[]  = ($field->status == 1) ? '<span class="badge bg-success-transparent-2 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Active</span>' : '<span class="badge bg-danger-transparent-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Inactive</span>';
            $row[]  = '<div class="d-flex justify-content-center align-items-center">
                        <span class="badge bg-info-transparent-2 ms-2 text-info px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center edit" data-id="' . $id_encrypt . '" data-kategori="' . $field->kategori . '" data-deskripsi="' . $field->deskripsi . '" data-status="' . $field->status . '" role="button">Edit</span>
                        <span class="badge bg-danger-transparent-2 ms-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center delete" role="button" data-id="' . $id_encrypt . '" data-kategori="' . $field->kategori . '" data-deskripsi="' . $field->deskripsi . '"> Delete</span>
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

    public function create_visimisi()
    {
        $data['kategori'] = htmlspecialchars($this->request->getPost('kategori'), ENT_QUOTES);
        $data['deskripsi'] = htmlspecialchars($this->request->getPost('deskripsi'), ENT_QUOTES);
        $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);

        $table = 'visimisi';
        $result = $this->serverside->createRows($data, $table);
        $r['result'] = true;

        if (!$result) {
            $r['result'] = false;
            $r['title'] = 'Maaf Gagal Menyimpan!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
        }
        echo json_encode($r);
    }

    public function update_visimisi()
    {
        $data['kategori'] = htmlspecialchars($this->request->getPost('kategori'), ENT_QUOTES);
        $data['deskripsi'] = htmlspecialchars($this->request->getPost('deskripsi'), ENT_QUOTES);
        $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
        $id_ = htmlspecialchars($this->request->getPost('id'), ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id = $encrypter->decrypt(hex2bin($id_));

        $table = 'visimisi';
        $result = $this->serverside->updateRows($id, $data, $table);
        $r['result'] = true;

        if (!$result) {
            $r['result'] = false;
            $r['title'] = 'Maaf Gagal Menyimpan!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
        }
        echo json_encode($r);
    }

    function delete_visimisi($id)
    {
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id_dec = $encrypter->decrypt(hex2bin($id_));
        $table = 'visimisi';
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

    public function index()
    {
        $page['mymenu'] = "KONFIGURASI";
        $page['mysubmenu'] = "WEB";
        $page['js'] = array("profil/konfigurasi.js?r=" . rand());
        $page['main_content'] = 'cms/konfigurasi';
        $page['data'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();

        echo view('template/template', $page);
    }

    public function update_konfigurasi()
    {
        if ($this->request->getPost()) {
            $val = $this->validate(
                [
                    'nama_company' => 'required',
                    'nama_populer' => 'required',
                    'tagline' => 'required',
                    'deskripsi' => 'required',
                    'alamat' => 'required',
                    'kota' => 'required',
                    'google_maps' => 'required',
                    'email' => 'required',
                    'telephone' => 'required',
                    'whatsapp' => 'required',
                    'status_blog' => 'required',
                ]
            );

            if (!$val) {
                $page['validation'] = $this->validator;
                $page['mymenu'] = "KONFIGURASI";
                $page['mysubmenu'] = "WEB";
                $page['js'] = array("profil/konfigurasi.js?r=" . rand());
                $page['main_content'] = 'cms/konfigurasi';
                $page['data'] = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow();

                echo view('template/template', $page);
            } else {
                $table = 'konfigurasi';
                $id = 'SET';

                $logo = $this->request->getFile('logo_url');

                if ($logo->isValid()) {
                    $src = $this->db->table('konfigurasi')->getWhere(['id' => 'SET'])->getRow()->logo_url;
                    $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
                    $a = explode("/", $file_name);
            
                    if (file_exists('./assets-cms/img/konfigurasi/' . end($a))) {
                        unlink('./assets-cms/img/konfigurasi/' . end($a));
                    }

                    $logo->move(WRITEPATH . '../public/assets-cms/img/konfigurasi/');
                    $file = $logo->getName();
                    $data['logo_url'] = base_url('/assets-cms/img/konfigurasi/' . $file);
                }

                $data['create_user'] = session()->get('admin_name');

                $data['nama_company'] = htmlspecialchars($this->request->getPost('nama_company'), ENT_QUOTES);
                $data['nama_populer'] = htmlspecialchars($this->request->getPost('nama_populer'), ENT_QUOTES);
                $data['tagline'] = htmlspecialchars($this->request->getPost('tagline'), ENT_QUOTES);
                $data['deskripsi'] = $this->request->getPost('deskripsi');
                $data['alamat'] = htmlspecialchars($this->request->getPost('alamat'), ENT_QUOTES);
                $data['kota'] = htmlspecialchars($this->request->getPost('kota'), ENT_QUOTES);
                $data['google_maps'] = $this->request->getPost('google_maps');
                $data['email'] = htmlspecialchars($this->request->getPost('email'), ENT_QUOTES);
                $data['telephone'] = htmlspecialchars($this->request->getPost('telephone'), ENT_QUOTES);
                $data['whatsapp'] = htmlspecialchars($this->request->getPost('whatsapp'), ENT_QUOTES);
                $data['status_blog'] = $this->request->getPost('status_blog');
                $data['instagram'] = htmlspecialchars($this->request->getPost('instagram'), ENT_QUOTES);
                $data['facebook'] = htmlspecialchars($this->request->getPost('facebook'), ENT_QUOTES);
                $data['youtube'] = htmlspecialchars($this->request->getPost('youtube'), ENT_QUOTES);
                $data['linkedin'] = htmlspecialchars($this->request->getPost('linkedin'), ENT_QUOTES);

                $result = $this->serverside->updateRows($id, $data, $table);

                if ($result) {
                    return redirect()->to('/cms/konfigurasi');
                } else {
                    return redirect()->to('/cms/konfigurasi');
                }
            };
        } else {
            session_destroy();
            return redirect()->route('login');
        }
    }

    public function struktur_organisasi()
    {
        $data['mymenu'] = "PROFIL";
        $data['mysubmenu'] = "STRUKTUR ORGANISASI";
        $data['js'] = array("profil/struktur-organisasi.js?r=" . rand());
        $data['vendorcss'] = $this->plugins->cssDataTables();
        $data['vendorjs'] = $this->plugins->jsDataTables();
        $data['main_content'] = 'cms/profil/struktur-organisasi';
        echo view('template/template', $data);
    }

    public function struktur_organisasi_()
    {
        $encrypter = \Config\Services::encrypter();
        $column_order = array(NULL, 'nama', 'jabatan', NULL, NULL);
        $column_search = array('nama', 'jabatan');
        $order = array('nama' => 'asc');

        $table = 'pengurus';
        $select = '*';
        $list = $this->serverside->limitRows($table, $select, $column_order, $column_search, $order);
        $data = array();

        $no = $this->request->getPost("start");
        foreach ($list as $field) {
            $id_encrypt = bin2hex($encrypter->encrypt($field->id));
            $no++;
            $row = array();

            $sosmed = '<div class="d-flex">';
            if ($field->link_fb != '') {
                $sosmed .= '<a href="#" class="btn btn-default p-2"><i class="fab fa-facebook-f"></i></a>';
            }
            if ($field->link_ig != '') {
                $sosmed .= '<a href="#" class="btn btn-default p-2"><i class="fab fa-instagram"></i></a>';
            }
            if ($field->link_linkedin != '') {
                $sosmed .= '<a href="#" class="btn btn-default p-2"><i class="fab fa-linkedin"></i></a>';
            }
            $sosmed .= '</div>';

            // $row[]  = $no;
            $row[]  = ($field->foto != null) ? '<img src=' . $field->foto . ' class="img-fluid">' : '<img src="/assets/img/laz-no-image.png">';
            $row[]  = $field->nama;
            $row[]  = $field->jabatan;
            $row[]  = $sosmed;
            $row[]  = '<div class="d-flex justify-content-center align-items-center">
                            <span class="badge bg-info-transparent-2 ms-2 text-info px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center edit" role="button" data-id="' . $id_encrypt . '" data-nama="' . $field->nama . '" data-jabatan="' . $field->jabatan . '" data-foto="' . $field->foto . '" data-link_ig="' . $field->link_ig . '" data-link_fb="' . $field->link_fb . '" data-link_linkedin="' . $field->link_linkedin . '">Edit</span>
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

    public function create_struktur_organisasi()
    {
        $data['nama']   = htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES);
        $data['jabatan']   = htmlspecialchars($this->request->getPost('jabatan'), ENT_QUOTES);
        $data['link_ig']   = htmlspecialchars($this->request->getPost('link_ig'), ENT_QUOTES);
        $data['link_fb']   = htmlspecialchars($this->request->getPost('link_fb'), ENT_QUOTES);
        $data['link_linkedin']   = htmlspecialchars($this->request->getPost('link_linkedin'), ENT_QUOTES);
        $data['create_user'] = session()->get('admin_name');

        $r['result'] = true;
        $gambar = $this->request->getFile("foto");

        if ($gambar->isValid()) {
            $file = $gambar->getTempName();
            $path = $gambar->getName();
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                $gambar->move(WRITEPATH . '../public/assets-cms/img/user/');
                $data['foto'] = base_url('/assets-cms/img/user/' . $path);
            } else {

                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = 'Format File Tidak Diijinkan!';
            }
        } else {
            $data['photo_url'] = base_url('/assets-cms/img/no-image.jpg');
        }

        $table = 'pengurus';
        $result = $this->serverside->createRows($data, $table);

        if (!$result) {
            $r['result'] = false;
            $r['title'] = 'Maaf Gagal Menyimpan!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
        }
        echo json_encode($r);
        return;
    }

    public function update_struktur_organisasi()
    {
        $id_ = htmlspecialchars($this->request->getPost('id'), ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id = $encrypter->decrypt(hex2bin($id_));
        $data['nama']   = htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES);
        $data['jabatan']   = htmlspecialchars($this->request->getPost('jabatan'), ENT_QUOTES);
        $data['link_ig']   = htmlspecialchars($this->request->getPost('link_ig'), ENT_QUOTES);
        $data['link_fb']   = htmlspecialchars($this->request->getPost('link_fb'), ENT_QUOTES);
        $data['link_linkedin']   = htmlspecialchars($this->request->getPost('link_linkedin'), ENT_QUOTES);

        $data['edit_user'] = session()->get('admin_name');
        $data['edit_date'] = date('Y-m-d H:i:s');

        $gambar_ = htmlspecialchars($this->request->getPost('foto_'), ENT_QUOTES);
        $r['result'] = true;

        $image = $this->request->getFile("foto");
        if ($image->isValid()) {
            $file = $image->getTempName();
            $path = $image->getName();
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                
                $src = $this->db->table('pengurus')->getWhere(['id' => $id])->getRow()->foto;
                $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
                $a = explode("/", $file_name);
        
                if (file_exists('./assets-cms/img/user/' . end($a))) {
                    unlink('./assets-cms/img/user/' . end($a));
                }

                $image->move(WRITEPATH . '../public/assets-cms/img/user/');
                $data['foto'] = base_url('/assets-cms/img/user/' . $path);
            } else {
                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = 'Format File Tidak Diijinkan!';
            }
        } else {
            if ($gambar_ != '') {
                $data['foto'] = $gambar_;
            } else {
                $data['foto'] = base_url('/assets-cms/img/no-image.jpg');
            }
        }

        $table = 'pengurus';
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

    public function delete_struktur_organisasi($id)
    {
        $table = 'pengurus';
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id_dec = $encrypter->decrypt(hex2bin($id_));

        $src = $this->db->table('pengurus')->getWhere(['id' => $id_dec])->getRow()->foto;
        $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
        $a = explode("/", $file_name);

        if (file_exists('./assets-cms/img/user/' . end($a))) {
            unlink('./assets-cms/img/user/' . end($a));
        }

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

    public function user()
    {
        if (session()->get('admin_role') == 'SUPERADMIN') {
            $data['mymenu'] = "USER";
            $data['mysubmenu'] = "USER ADMIN";
            $data['js'] = array("profil/user.js?r=" . rand());
            $data['vendorcss'] = $this->plugins->cssDataTables();
            $data['vendorjs'] = $this->plugins->jsDataTables();
            $data['main_content'] = 'cms/profil/user';
            echo view('template/template', $data);
        } else {
            redirect()->to('admin/visi-misi');
        }
    }

    public function profil()
    {
        $page['mymenu'] = "KONFIGURASI";
        $page['mysubmenu'] = "PROFIL";
        $page['main_content'] = 'cms/profil/index';
        echo view('template/template', $page);
    }

    public function update_profil()
    {
        if ($this->request->getPost()) {
            $val = $this->validate(
                [
                    'name' => 'required',
                    'myphoto' => [
                        'mime_in[myphoto,image/jpg,image/jpeg,image/png]',
                        'max_size[myphoto,1024]',
                    ],
                    'repassword' => 'matches[password]'
                ],
                [   // Errors
                    'name' => [
                        'required' => 'You must have name'
                    ],
                    'myphoto' => [
                        'mime_in' => 'You must have a picture',
                        'max_size' => 'File size no more than 1mb'
                    ],
                    'repassword' => [
                        'matches' => 'Your new password should match with confirmation password'
                    ]
                ]
            );

            if (!$val) {
                $page['mymenu'] = "KONFIGURASI";
                $page['mysubmenu'] = "PROFIL";
                $page['validation'] = $this->validator;
                $page['main_content'] = 'cms/profil/index';
                echo view('template/template', $page);
            } else {
                $table = 'user';
                $id = session()->get('admin_id');

                $gambar = $this->request->getFile('myphoto');
                $changePassword = false;

                if (
                    $this->request->getPost('oldpassword') <> "" &&
                    $this->konfigurasi->checkUserPassword(session()->get('admin_id'), $this->request->getPost('oldpassword')) &&
                    ($this->request->getPost('password') == $this->request->getPost('repassword'))
                ) {
                    $changePassword = true;
                } else {
                    $changePassword = false;
                }

                if ($gambar->isValid()) {
                    $gambar->move(WRITEPATH . '../public/assets-cms/img/user/');
                    $file = $gambar->getName();
                    $photo_url = base_url('/assets-cms/img/user/' . $file);

                    if ($changePassword) {
                        $data = [
                            'name'  => htmlspecialchars($this->request->getPost('name'), ENT_QUOTES),
                            'photo_url' => $photo_url,
                            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT, array('cost' => 10)),
                            'edit_date' => date('Y-m-d H:i:s'),
                            'edit_user' => 'admin:' . session()->get('admin_name')
                        ];
                    } else {
                        $data = [
                            'name'  => $this->request->getPost('name'),
                            'photo_url' => $photo_url,
                            'edit_date' => date('Y-m-d H:i:s'),
                            'edit_user' => 'admin:' . session()->get('admin_name')
                        ];
                    }

                    $result = $this->serverside->updateRows($id, $data, $table);

                    if ($result) {
                        session_destroy();
                        return redirect()->route('login');
                    } else {
                        $page['error'] = "Gagal melakukan update profil.";
                        $page['main_content']    = 'cms/profile/index';    // page name
                        echo view('template/template', $page);
                    }
                } else {
                    if ($changePassword) {
                        $data = [
                            'name'  => $this->request->getPost('name'),
                            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT, array('cost' => 10)),
                            'edit_date' => date('Y-m-d H:i:s'),
                            'edit_user' => 'admin:' . session()->get('admin_name')
                        ];
                    } else {
                        $data = [
                            'name'  => $this->request->getPost('name'),
                            'edit_date' => date('Y-m-d H:i:s'),
                            'edit_user' => 'admin:' . session()->get('admin_name')
                        ];
                    }

                    $result = $this->serverside->updateRows($id, $data, $table);

                    if ($result) {
                        session_destroy();
                        return redirect()->route('login');
                    } else {
                        $page['error'] = "Gagal melakukan update profil." . (($changePassword) ? "Pastikan Password lama yang anda masukkan sesuai !" : "");
                        $page['main_content']    = 'cms/profil/index';    // page name
                        echo view('template/template', $page);
                    }
                }
            };
        } else {
            session_destroy();
            return redirect()->route('login');
        }
    }

    public function user_()
    {
        if (session()->get('admin_role') == 'SUPERADMIN') {
            $encrypter = \Config\Services::encrypter();
            $column_order = array(NULL, NULL, 'name', 'email', 'role', 'status', NULL);
            $column_search = array('name', 'email');
            $order = array('name' => 'asc');

            $table = 'user';
            $select = '*';
            $list = $this->serverside->limitRows($table, $select, $column_order, $column_search, $order);
            $data = array();

            $no = $this->request->getPost("start");
            foreach ($list as $field) {
                $no++;
                $row = array();

                $id_encrypt = bin2hex($encrypter->encrypt($field->id));
                $row[]  = $no;
                $row[]  = '<img src="' . $field->photo_url . '" class="img-thumbnail" width="100">';
                $row[]  = $field->name;
                $row[]  = $field->email;
                $row[]  = $field->role;
                $row[]  = ($field->status == 1) ? '<span class="badge bg-success-transparent-2 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Active</span>' : '<span class="badge bg-danger-transparent-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Inactive</span>';
                $row[]  = '<div class="d-flex justify-content-center align-items-center">
                            <span class="badge bg-info-transparent-2 ms-2 text-info px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center edit" data-id="' . $id_encrypt . '" data-nama="' . $field->name . '" data-email="' . $field->email . '" data-status="' . $field->status . '" data-gambar="' . $field->photo_url . '" data-role="' . $field->role . '" role="button">Edit</span>
                            <span class="badge bg-danger-transparent-2 ms-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center delete" role="button" data-id="' . $id_encrypt . '" data-name="' . $field->name . '"> Delete</span>
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
    }

    public function create_user()
    {
        if (session()->get('admin_role') == 'SUPERADMIN') {
            $data['name'] = htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES);
            $data['email'] = htmlspecialchars($this->request->getPost('email'), ENT_QUOTES);
            $data['role'] = htmlspecialchars($this->request->getPost('role'), ENT_QUOTES);
            $data['password'] = password_hash(htmlspecialchars($this->request->getPost('password'), ENT_QUOTES), PASSWORD_BCRYPT, array('cost' => 10));
            $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
            $data['create_user'] = session()->get('admin_name');

            $gambar = $this->request->getFile("gambar");
            $r['result'] = true;

            if ($gambar->isValid()) {
                $file = $gambar->getTempName();
                $path = $gambar->getName();
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                    $gambar->move(WRITEPATH . '../public/assets-cms/img/user/');
                    $data['photo_url'] = base_url('/assets-cms/img/user/' . $path);
                } else {
                    $r['result'] = false;
                    $r['title'] = 'Gagal!';
                    $r['icon'] = 'error';
                    $r['status'] = 'Format File Tidak Diijinkan!';
                }
            } else {
                $data['photo_url'] = base_url('/assets-cms/img/no-image.jpg');
            }

            $table = 'user';
            $result = $this->serverside->createRows($data, $table);
            $r['result'] = true;

            if (!$result) {
                $r['result'] = false;
                $r['title'] = 'Maaf Gagal Menyimpan!';
                $r['icon'] = 'error';
                $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
            }
            echo json_encode($r);
        }
    }

    public function update_user()
    {
        $id_ = htmlspecialchars($this->request->getPost('id'), ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id = $encrypter->decrypt(hex2bin($id_));
        $data['name'] = htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES);
        $data['email'] = htmlspecialchars($this->request->getPost('email'), ENT_QUOTES);
        $data['role'] = htmlspecialchars($this->request->getPost('role'), ENT_QUOTES);
        if ($this->request->getPost('password') != '') {
            $data['password'] = password_hash(htmlspecialchars($this->request->getPost('password'), ENT_QUOTES), PASSWORD_BCRYPT, array('cost' => 10));
        }
        $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
        $data['create_user'] = session()->get('admin_name');

        $gambar = $this->request->getFile("gambar");
        $gambar_ = htmlspecialchars($this->request->getPost('gambar_'), ENT_QUOTES);
        $r['result'] = true;

        if ($gambar->isValid()) {
            $file = $gambar->getTempName();
            $path = $gambar->getName();
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                $src = $this->db->table('user')->getWhere(['id' => $id])->getRow()->photo_url;
                $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
                $a = explode("/", $file_name);

                if (file_exists('./assets-cms/img/user/' . end($a))) {
                    unlink('./assets-cms/img/user/' . end($a));
                }

                $gambar->move(WRITEPATH . '../public/assets-cms/img/user/');
                $data['photo_url'] = base_url('/assets-cms/img/user/' . $path);
            } else {
                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = 'Format File Tidak Diijinkan!';
            }
        } else {
            if ($gambar_ != '') {
                $data['photo_url'] = $gambar_;
            } else {
                $data['photo_url'] = base_url('/assets-cms/img/no-image.jpg');
            }
        }

        $table = 'user';
        $result = $this->serverside->updateRows($id, $data, $table);

        if (!$result) {
            $r['result'] = false;
            $r['title'] = 'Maaf Gagal Menyimpan!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
        }
        echo json_encode($r);
    }


    function delete_user($id)
    {
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id_dec = $encrypter->decrypt(hex2bin($id_));
        $table = 'user';

        $src = $this->db->table('user')->getWhere(['id' => $id])->getRow()->photo_url;
        $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
        $a = explode("/", $file_name);

        if (file_exists('./assets-cms/img/user/' . end($a))) {
            unlink('./assets-cms/img/user/' . end($a));
        }

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

    public function slider()
    {
        $data['mymenu'] = "HOME PAGE";
        $data['mysubmenu'] = "SLIDER";
        $data['js'] = array("profil/slider.js?r=" . rand());
        $data['vendorcss'] = $this->plugins->cssDataTables();
        $data['vendorjs'] = $this->plugins->jsDataTables();
        $data['main_content'] = 'cms/profil/slider';
        echo view('template/template', $data);
    }

    public function slider_()
    {
        $encrypter = \Config\Services::encrypter();
        $column_order = array('no_urut', 'photo_url', NULL, 'keterangan', 'status', NULL);
        $column_search = array('title_normal', 'keterangan', 'title_bold');
        $order = array('no_urut' => 'asc');

        $table = 'slider';
        $select = '*';
        $list = $this->serverside->limitRows($table, $select, $column_order, $column_search, $order);
        $data = array();

        $no = $this->request->getPost("start");
        foreach ($list as $field) {
            $id_encrypt = bin2hex($encrypter->encrypt($field->id));
            $no++;
            $row = array();

            $row[]  = $field->no_urut;
            $row[]  = '<img src="' . $field->photo_url . '" class="img-thumbnail" width="100">';
            $row[]  = $field->title_normal . ' <b>' . $field->title_bold . '</b>';
            $row[]  = $field->keterangan;
            $row[]  = ($field->status == 1) ? '<span class="badge bg-success-transparent-2 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Active</span>' : '<span class="badge bg-danger-transparent-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Inactive</span>';
            $row[]  = '<div class="d-flex justify-content-center align-items-center">
                        <span class="badge bg-info-transparent-2 ms-2 text-info px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center edit" 
                            data-id="' . $id_encrypt . '" 
                            data-urutan="' . $field->no_urut . '" 
                            data-title="' . $field->title_normal . '" 
                            data-title_bold="' . $field->title_bold . '" 
                            data-keterangan="' . $field->keterangan . '" 
                            data-status="' . $field->status . '" 
                            data-gambar="' . $field->photo_url . '" role="button">Edit</span>
                        <span class="badge bg-danger-transparent-2 ms-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center delete" role="button" data-id="' . $id_encrypt . '"> Delete</span>
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

    public function create_slider()
    {
        $data['title_normal'] = htmlspecialchars($this->request->getPost('title_normal'), ENT_QUOTES);
        $data['title_bold'] = htmlspecialchars($this->request->getPost('title_bold'), ENT_QUOTES);
        $data['no_urut'] = htmlspecialchars($this->request->getPost('no_urut'), ENT_QUOTES);
        $data['keterangan'] = htmlspecialchars($this->request->getPost('keterangan'), ENT_QUOTES);
        $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
        $data['create_user'] = session()->get('admin_name');
        $data['create_date'] = date('Y-m-d H:i:s');

        $gambar = $this->request->getFile("gambar");
        $r['result'] = true;

        if ($gambar->isValid()) {
            $file = $gambar->getTempName();
            $path = $gambar->getName();
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                $gambar->move(WRITEPATH . '../public/assets-cms/slider/');
                $data['photo_url'] = base_url('/assets-cms/slider/' . $path);
            } else {
                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = 'Format File Tidak Diijinkan!';
            }
        } else {
            $data['photo_url'] = base_url('/assets-cms/img/no-image.jpg');
        }

        $table = 'slider';
        $result = $this->serverside->createRows($data, $table);

        if (!$result) {
            $r['result'] = false;
            $r['title'] = 'Maaf Gagal Menyimpan!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
        }
        echo json_encode($r);
    }

    public function update_slider()
    {
        $id_ = htmlspecialchars($this->request->getPost('id'), ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id = $encrypter->decrypt(hex2bin($id_));
        $data['title_normal'] = htmlspecialchars($this->request->getPost('title_normal'), ENT_QUOTES);
        $data['title_bold'] = htmlspecialchars($this->request->getPost('title_bold'), ENT_QUOTES);
        $data['no_urut'] = htmlspecialchars($this->request->getPost('no_urut'), ENT_QUOTES);
        $data['keterangan'] = htmlspecialchars($this->request->getPost('keterangan'), ENT_QUOTES);
        $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
        $data['edit_user'] = session()->get('admin_name');
        $data['edit_date'] = date('Y-m-d H:i:s');

        $gambar = $this->request->getFile("gambar");
        $gambar_ = htmlspecialchars($this->request->getPost('gambar_'), ENT_QUOTES);
        $r['result'] = true;

        if ($gambar->isValid()) {
            $file = $gambar->getTempName();
            $path = $gambar->getName();
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                $src = $this->db->table('slider')->getWhere(['id' => $id])->getRow()->photo_url;
                $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
                $a = explode("/", $file_name);
        
                if (file_exists('./assets-cms/img/slider/' . end($a))) {
                    unlink('./assets-cms/img/slider/' . end($a));
                }

                $gambar->move(WRITEPATH . '../public/assets-cms/slider/');
                $data['photo_url'] = base_url('/assets-cms/slider/' . $path);
            } else {
                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = 'Format File Tidak Diijinkan!';
            }
        } else {
            if ($gambar_ != '') {
                $data['photo_url'] = $gambar_;
            } else {
                $data['photo_url'] = base_url('/assets-cms/img/no-image.jpg');
            }
        }

        $table = 'slider';
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

    function delete_slider($id)
    {
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id_dec = $encrypter->decrypt(hex2bin($id_));
        $table = 'slider';

        $src = $this->db->table('slider')->getWhere(['id' => $id_dec])->getRow()->photo_url;
        $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
        $a = explode("/", $file_name);

        if (file_exists('./assets-cms/img/slider/' . end($a))) {
            unlink('./assets-cms/img/slider/' . end($a));
        }

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
