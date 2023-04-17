<?php

namespace App\Controllers;

use Hashids\Hashids;

class CmsProduk extends BaseController
{
    protected $db;

    public function __construct()
    {
        helper(['url', 'form', 'array']);
        date_default_timezone_set('Asia/Jakarta');
        $this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    //PRODUK
    public function product_price()
    {
        $data['mymenu'] = "PRODUK";
        $data['mysubmenu'] = "PILIHAN HARGA";
        $data['vendorcss'] = $this->plugins->cssDataTables();
        $data['vendorjs'] = $this->plugins->jsDataTables();
        $data['product_price'] = $this->db->table('price_product')->orderBy('harga')->get()->getResult();
        $data['main_content']  = 'cms/produk/product_price';
        $data['js'] = array("produk/product_price.js?r=" . uniqid());
        echo view('template/template', $data);
    }

    public function fetch_modal_fitur()
    {
        $hashids = new Hashids('53qURe_produk_price', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        $id_produk = $hashids->decode($this->request->getPost('id'))[0];

        if ($id_produk != '') {
            $data['produk'] = $this->db->table('price_product')->getWhere(['id' => $id_produk])->getRow();
            $data['fitur'] = $this->db->table('price_feature')->getWhere(['id_product_price' => $id_produk])->getResult();
            echo view('cms/produk/modal', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update_product_price()
    {
        $val = $this->validate(
            [
                'judul' => 'required',
                'ringkasan' => 'required',
                'harga' => 'required',
            ],
        );

        if (!$val) {
            $r['result'] = false;
            $r['title'] = 'Gagal!';
            $r['icon'] = 'error';
            $r['status'] = \Config\Services::validation()->listErrors();
            echo json_encode($r);
            return;
        } else {
            $hashids = new Hashids('53qURe_produk_price', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');

            $id = $hashids->decode($this->request->getPost('id'))[0];

            $data['judul']   = htmlspecialchars($this->request->getPost('judul'), ENT_QUOTES);
            $data['keterangan']   = htmlspecialchars($this->request->getPost('ringkasan'), ENT_QUOTES);
            $data['harga']   = $this->request->getPost('harga');
            $data['edit_user'] = session()->get('admin_name');
            $data['edit_date'] = date('Y-m-d H:i:s');

            $r['result'] = true;
            $table = 'price_product';
            $result = $this->serverside->updateRows($id, $data, $table);

            if (!$result) {
                $r['result'] = false;
                $r['title'] = 'Maaf Gagal Menyimpan!';
                $r['icon'] = 'error';
                $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
            } else {
                $this->serverside->deleteRowsBy('id_product_price', $id, 'price_feature');

                $fitur = $this->request->getPost('fitur');
                foreach ($fitur as $key => $val) {
                    $fitur_['id_product_price'] = $id;
                    $fitur_['no_urut'] = $key + 1;
                    $fitur_['deskripsi'] = $val;
                    $fitur_["create_user"] = session()->get('admin_name');
                    $fitur_['create_date'] = date('Y-m-d H:i:s');

                    $this->serverside->createRows($fitur_, 'price_feature');
                }
            }
            echo json_encode($r);
            return;
        }
    }

    public function product()
    {
        $data['mymenu'] = "PRODUK";
        $data['mysubmenu'] = "DAFTAR PRODUK";
        $data['vendorcss'] = $this->plugins->cssDataTables();
        $data['vendorjs'] = $this->plugins->jsDataTables();
        $data['product_category'] = $this->db->table('product_category')->getWhere(['status' => 1])->getResult();
        $data['js'] = array("produk/product.js?r=" . uniqid());
        $data['main_content']  = 'cms/produk/product';
        echo view('template/template', $data);
    }

    public function product_()
    {
        $encrypter = \Config\Services::encrypter();
        $column_order = array(NULL, 'photo_url', 'product.nama', 'product_category.nama', 'status', NULL);
        $column_search = array('product.nama', 'product_category.nama');
        $order = array('product.nama' => 'asc');

        $table = 'product';
        $select = 'product.*, product_category.nama as merek';
        $join = array(
            array('product_category', 'product_category.id = product.id_product_category')
        );

        $list = $this->serverside->limitRows($table, $select, $column_order, $column_search, $order, $join);
        $data = array();

        $no = $this->request->getPost("start");
        $hashids = new Hashids('53qURe_produk', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');

        foreach ($list as $field) {
            $id_encrypt = $hashids->encode($field->id);
            $id_kategori = $hashids->encode($field->id_product_category);
            $no++;
            $row = array();

            $row[]  = $no;
            $row[]  = '<img src="' . $field->photo_url . '" class="img-thumbnail" width="150">';
            $row[]  = '<h5>' . $field->nama . '</h5>Kategori: ' . $field->merek . '<br><b>Rp ' . number_format($field->harga_jasa, 0, ',', '.') . '</b>';
            $row[]  = $field->ringkasan;
            $row[]  = ($field->status == 1) ? '<span class="badge bg-success-transparent-2 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Active</span>' : '<span class="badge bg-danger-transparent-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Inactive</span>';
            $row[]  = '<div class="d-flex justify-content-center align-items-center">
                            <span class="badge bg-info-transparent-2 ms-2 text-info px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center edit" role="button" 
                                data-id="' . $id_encrypt . '" 
                                data-kategori="' . $id_kategori . '" 
                                data-deskripsi="' . $field->deskripsi . '" 
                                data-nama="' . $field->nama . '" 
                                data-flag="' . $field->flag . '" 
                                data-ringkasan="' . $field->ringkasan . '" 
                                data-harga_jasa="' . $field->harga_jasa . '" 
                                data-photo_url="' . $field->photo_url . '" 
                                data-status="' . $field->status . '">Edit</span>
                            <span class="badge bg-danger-transparent-2 ms-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center delete" role="button" 
                                data-id="' . $id_encrypt . '" 
                                data-nama="' . $field->nama . '">Delete</span>
                        </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->serverside->countAll($table),
            "recordsFiltered" => $this->serverside->countFiltered($table, $select, $column_order, $column_search, $order, $join),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function create_product()
    {
        if ($this->request->getPost()) {
            $val = $this->validate(
                [
                    'harga_jasa' => 'required',
                    'ringkasan' => 'required',
                    'flag' => 'required',
                    'kategori' => 'required',
                    'nama' => 'required',
                    'deskripsi' => 'required',
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
                $hashids = new Hashids('53qURe_produk', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');

                $data['id_product_category']   = $hashids->decode($this->request->getPost('kategori'))[0];
                $data['nama']   = htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES);
                $data['deskripsi']   = $this->request->getPost('deskripsi');
                $data['ringkasan']   = htmlspecialchars($this->request->getPost('ringkasan'), ENT_QUOTES);
                $data['harga_jasa']   = htmlspecialchars($this->request->getPost('harga_jasa'), ENT_QUOTES);
                $data['flag']   = htmlspecialchars($this->request->getPost('flag'), ENT_QUOTES);
                $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
                $data['create_user'] = session()->get('admin_name');
                $data['create_date'] = date('Y-m-d H:i:s');

                $photo = $this->request->getFile("photo");

                if ($photo->isValid()) {
                    $path = $photo->getName();
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                        $photo->move('assets-cms/img/product/');
                        $data['photo_url'] = base_url('/assets-cms/img/product/' . $path);
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

                $table = 'product';
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
            $page['main_content'] = 'cms/produk/product';
            echo view('template/template', $page);
        }
    }

    public function update_product()
    {
        if ($this->request->getPost()) {
            $val = $this->validate(
                [
                    'kategori' => 'required',
                    'nama' => 'required',
                    'deskripsi' => 'required',
                    'status' => 'required',
                ],
            );

            if (!$val) {
                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = \Config\Services::validation()->listErrors();
                echo json_encode($r);
                return;
            } else {
                $hashids = new Hashids('53qURe_produk', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');

                $id = $hashids->decode($this->request->getPost('id'))[0];

                $data['id_product_category']   = $hashids->decode($this->request->getPost('kategori'))[0];
                $data['nama']   = htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES);
                $data['deskripsi']   = $this->request->getPost('deskripsi');
                $data['ringkasan']   = htmlspecialchars($this->request->getPost('ringkasan'), ENT_QUOTES);
                $data['harga_jasa']   = htmlspecialchars($this->request->getPost('harga_jasa'), ENT_QUOTES);
                $data['flag']   = htmlspecialchars($this->request->getPost('flag'), ENT_QUOTES);
                $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
                $data['create_user'] = session()->get('admin_name');
                $data['create_date'] = date('Y-m-d H:i:s');

                $photo = $this->request->getFile("photo");

                if ($photo->isValid()) {
                    $path = $photo->getName();
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                        $src = $this->db->table('product')->getWhere(['id' => $id])->getRow()->photo_url;
                        $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
                        $a = explode("/", $file_name);

                        if (file_exists('./assets-cms/img/product/' . end($a))) {
                            unlink('./assets-cms/img/product/' . end($a));
                        }

                        $photo->move('assets-cms/img/product/');
                        $data['photo_url'] = base_url('/assets-cms/img/product/' . $path);
                    } else {
                        $r['result'] = false;
                        $r['title'] = 'Gagal!';
                        $r['icon'] = 'error';
                        $r['status'] = 'Format File Tidak Diijinkan!';
                        echo json_encode($r);
                        return;
                    }
                }

                $r['result'] = true;

                $table = 'product';
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
        } else {
            $page['main_content'] = 'cms/produk/product';
            echo view('template/template', $page);
        }
    }

    function delete_product($id)
    {
        $hashids = new Hashids('53qURe_produk', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        $id_dec = $hashids->decode($id)[0];

        $src = $this->db->table('product')->getWhere(['id' => $id_dec])->getRow()->photo_url;
        $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
        $a = explode("/", $file_name);

        if (file_exists('./assets-cms/img/product/' . end($a))) {
            unlink('./assets-cms/img/product/' . end($a));
        }

        $table = 'product';
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

    //PRODUK KATEGORI
    public function product_category()
    {
        $data['mymenu'] = "PRODUK";
        $data['mysubmenu'] = "PRODUK KATEGORI";
        $data['vendorcss'] = $this->plugins->cssDataTables();
        $data['vendorjs'] = $this->plugins->jsDataTables();
        $data['js'] = array("produk/product_category.js?r=" . uniqid());
        $data['main_content']  = 'cms/produk/product_category';
        echo view('template/template', $data);
    }

    public function product_category_()
    {
        $encrypter = \Config\Services::encrypter();
        $column_order = array(NULL, 'kode', 'photo_url', 'nama', 'status', NULL);
        $column_search = array('kode', 'nama');
        $order = array('nama' => 'asc');

        $table = 'product_category';
        $select = '*';
        $list = $this->serverside->limitRows($table, $select, $column_order, $column_search, $order);
        $data = array();

        $no = $this->request->getPost("start");
        foreach ($list as $field) {
            $id_encrypt = bin2hex($encrypter->encrypt($field->id));
            $no++;
            $row = array();

            $row[]  = $no;
            $row[]  = $field->kode;
            $row[]  = '<img src="' . $field->photo_url . '" class="img-thumbnail" width="150px">';
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

    public function create_product_category()
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
                        $photo->move('assets-cms/img/product_category/');
                        $data['photo_url'] = base_url('/assets-cms/img/product_category/' . $path);
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

                $table = 'product_category';
                $id = $this->serverside->createRowsReturnID($data, $table);

                if ($id == false) {
                    $r['result'] = false;
                    $r['title'] = 'Maaf Gagal Menyimpan!';
                    $r['icon'] = 'error';
                    $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
                } else {
                    //update kode
                    $hashids = new Hashids('53qURe', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
                    $data_update['kode'] = $hashids->encode($id);
                    $result = $this->serverside->updateRows($id, $data_update, $table);

                    if (!$result) {
                        $r['result'] = false;
                        $r['title'] = 'Maaf Gagal Menyimpan!';
                        $r['icon'] = 'error';
                        $r['status'] = '<br><b>Tidak dapat di Simpan! <br> Silakan hubungi Administrator.</b>';
                    } else {
                        $r['result'] = true;
                        $r['status'] = '<br><b>Berhasil di Simpan!</b>';
                    }
                }

                echo json_encode($r);
                return;
            }
        } else {
            $page['main_content'] = 'cms/produk/product_category';
            echo view('template/template', $page);
        }
    }

    public function update_product_category()
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
                $src = $this->db->table('product_category')->getWhere(['id' => $id])->getRow()->photo_url;
                $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
                $a = explode("/", $file_name);

                if (file_exists('./assets-cms/img/product_category/' . end($a))) {
                    unlink('./assets-cms/img/product_category/' . end($a));
                }

                $photo->move('assets-cms/img/product_category/');
                $data['photo_url'] = base_url('/assets-cms/img/product_category/' . $path);
            } else {
                $r['result'] = false;
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = 'Format File Tidak Diijinkan!';
                echo json_encode($r);
                return;
            }
        }

        $r['result'] = true;

        $table = 'product_category';
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

    function delete_product_category($id)
    {
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id_dec = $encrypter->decrypt(hex2bin($id_));

        $check_product = $this->db->table('product')->getWhere(['id_product_category' => $id_dec])->getNumRows();
        if ($check_product > 0) {
            $r['title'] = 'Perhatian!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Kategori tidak dapat di hapus karena masih terdapat produk didalam kategori ini.</b>';

            echo json_encode($r);
            return;
        } else {
            //Delete Kategori
            $src = $this->db->table('product_category')->getWhere(['id' => $id_dec])->getRow()->photo_url;
            $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
            $a = explode("/", $file_name);

            if (file_exists('./assets-cms/img/product_category/' . end($a))) {
                unlink('./assets-cms/img/product_category/' . end($a));
            }

            $table = 'product_category';

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
            return;
        }
    }

    //GALERI PRODUK
    public function produk_gallery()
    {
        $data['mymenu'] = "PRODUK";
        $data['mysubmenu'] = "GALERI PRODUK";
        $data['vendorcss'] = $this->plugins->cssDataTables();
        $data['vendorjs'] = $this->plugins->jsDataTables();
        $data['produk'] = $this->db->table('product')->getWhere(['status' => 1])->getResult();
        $data['js'] = array("produk/produk_gallery.js?r=" . uniqid());
        $data['main_content']  = 'cms/produk/produk_gallery';
        echo view('template/template', $data);
    }

    public function produk_gallery_()
    {
        $column_order = array(NULL, 'product.nama', 'photo_url', 'title', 'caption', 'status', NULL);
        $column_search = array('product.nama', 'title', 'caption');
        $order = array('product.nama' => 'asc');

        $table = 'product_gallery';
        $select = 'product_gallery.*, product.nama as nama_produk, product.id as id_product';
        $join = array(
            array('product', 'product.id = product_gallery.id_product'),
        );

        $list = $this->serverside->limitRows($table, $select, $column_order, $column_search, $order, $join);
        $data = array();

        $no = $this->request->getPost("start");
        $hashids = new Hashids('53qURe_gallery', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        foreach ($list as $field) {
            $no++;

            $id_encrypt = $hashids->encode($field->id);
            $id_product = $hashids->encode($field->id_product);
            $row = array();

            $row[]  = $no;
            $row[]  = $field->nama_produk;
            $row[]  = '<img src="' . $field->photo_url . '" class="img-thumbnail" width="150">';
            $row[]  = $field->title;
            $row[]  = ($field->caption != '') ? $field->caption : '-';
            $row[]  = ($field->status == 1) ? '<span class="badge bg-success-transparent-2 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Active</span>' : '<span class="badge bg-danger-transparent-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Inactive</span>';
            $row[]  = '<div class="d-flex justify-content-center align-items-center">
                            <span class="badge bg-info-transparent-2 ms-2 text-info px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center edit" role="button" 
                                data-id="' . $id_encrypt . '" 
                                data-id_produk="' . $id_product . '" 
                                data-photo_url="' . $field->photo_url . '" 
                                data-title="' . $field->title . '" 
                                data-caption="' . $field->caption . '" 
                                data-status="' . $field->status . '">Edit</span>
                            <span class="badge bg-danger-transparent-2 ms-2 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center delete" role="button" 
                                data-id="' . $id_encrypt . '">Delete</span>
                        </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->serverside->countAll($table),
            "recordsFiltered" => $this->serverside->countFiltered($table, $select, $column_order, $column_search, $order, $join),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function create_produk_gallery()
    {
        if ($this->request->getPost()) {
            $val = $this->validate(
                [
                    'produk' => 'required',
                    'title' => 'required',
                    'caption' => 'required',
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
                $hashids = new Hashids('53qURe_gallery', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');

                $data['id_product']   = $hashids->decode($this->request->getPost('produk'))[0];
                $data['title'] = htmlspecialchars($this->request->getPost('title'), ENT_QUOTES);
                $data['caption'] = htmlspecialchars($this->request->getPost('caption'), ENT_QUOTES);
                $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
                $data['create_user'] = session()->get('admin_name');
                $data['create_date'] = date('Y-m-d H:i:s');

                $photo = $this->request->getFile("photo");

                if ($photo->isValid()) {
                    $path = $photo->getName();
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {
                        $photo->move('assets-cms/img/gallery/');
                        $data['photo_url'] = base_url('/assets-cms/img/gallery/' . $path);
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

                $table = 'product_gallery';
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

    public function update_produk_gallery()
    {
        $hashids = new Hashids('53qURe_gallery', 5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        $id_ = htmlspecialchars($this->request->getPost('id'), ENT_QUOTES);
        $id = $hashids->decode($id_)[0];

        $data['id_product']   = $hashids->decode($this->request->getPost('produk'))[0];
        $data['title'] = htmlspecialchars($this->request->getPost('title'), ENT_QUOTES);
        $data['caption'] = htmlspecialchars($this->request->getPost('caption'), ENT_QUOTES);
        $data['status'] = htmlspecialchars($this->request->getPost('status'), ENT_QUOTES);
        $data['edit_user'] = session()->get('admin_name');
        $data['edit_date'] = date('Y-m-d H:i:s');

        $photo = $this->request->getFile("photo");

        if ($photo->isValid()) {
            $file = $photo->getTempName();
            $path = $photo->getName();
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'svg' || $ext == 'gif') {

                $src = $this->db->table('product_gallery')->getWhere(['id' => $id])->getRow()->photo_url;
                $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
                $a = explode("/", $file_name);

                if (file_exists('./assets-cms/img/gallery/' . end($a))) {
                    unlink('./assets-cms/img/gallery/' . end($a));
                }

                $photo->move('assets-cms/img/gallery/');
                $data['photo_url'] = base_url('/assets-cms/img/gallery/' . $path);
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

        $table = 'product_gallery';
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

    function delete_produk_gallery($id)
    {
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        $encrypter = \Config\Services::encrypter();
        $id_dec = $encrypter->decrypt(hex2bin($id_));

        $src = $this->db->table('product_gallery')->getWhere(['id' => $id_dec])->getRow()->photo_url;
        $file_name = '.' . str_replace(base_url('/'), '', $src); // striping host to get relative path
        $a = explode("/", $file_name);

        if (file_exists('./assets-cms/img/gallery/' . end($a))) {
            unlink('./assets-cms/img/gallery/' . end($a));
        }

        $table = 'product_gallery';
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
