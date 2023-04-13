<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk_unggulan';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';
    protected $allowedFields = ['id', 'nama_produk', 'deskripsi', 'photo_url', 'create_date'];
    protected $useTimestamps = true;

    public function fitur_produk($id_product){
        return $this->db->query('SELECT * FROM price_feature WHERE `id_product_price`=? ORDER BY no_urut ASC', array($id_product))->getResult();
    }
}