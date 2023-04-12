<?php

namespace App\Models;
use CodeIgniter\Model;

class KonfigurasiModel extends Model
{
    protected $q;
    protected $dt;

    protected $table      = 'blog';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';
    protected $allowedFields = ['edisi', 'judul', 'cover', 'file_pdf', 'is_url', 'status'];
    protected $useTimestamps = true;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function resetLog(){
        $q = $this->db->table('log_token');
        $q->emptyTable('log_token');

        $data=array(
            'access_token'  => 'IGQVJWaExGc1RtWVNEV1BINHNaMExYQnYzUUFOUUpnaUVacFA3NFk1VTRjcnRfcjlzYnkxOEhnQVB4cXFTd08zOXFpWktPamNFaEIyeWxsby1ZASGNxUk83RTNkMnlScnF3MHFERWJB',
            'token_type'    => 'bearer',
            'expires_in'    => 5181097,
            'berakhir'      => '2022-10-14 18:47:58'
        );
        $qi = $this->db->table('log_token');
        $qi->insert($data);

        return 1;
    }
    
    public function refreshToken($new_token){
        $q = $this->db->table('log_token');
        $q->insert($new_token);

        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUserPassword($id, $password)
    {
        $builder =  $this->db->table('user');
        $builder->select('*');
        $builder->where('id', $id);
        $builder->where('status', 1);
        $num = $builder->countAllResults(false);
        $row = $builder->get()->getRow();

        if ($num == 1 && password_verify($password, $row->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function getSlider(){
        return $this->db->query('SELECT * FROM slider WHERE `status`=1 ORDER BY no_urut ASC')->getResult();
    }

    public function getData(){
        return $this->db->query('SELECT * FROM konfigurasi WHERE id="SET" ')->getRow();
    }
    
    public function getVisiMisiBy($by){
        return $this->db->query('SELECT * FROM visimisi WHERE kategori=?', array($by))->getResult();
    }

    public function getStrukturOrganisasi(){
        $q = $this->db->table('struktur_organisasi');
        $get = $q->get()->getLastRow();
        if(!isset($get->image)){
            return base_url('/assets/img/laz-no-image.png');
        }
        return $get->image;
    }
}