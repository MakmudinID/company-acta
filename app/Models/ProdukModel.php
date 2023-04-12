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
}