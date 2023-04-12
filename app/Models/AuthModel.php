<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class AuthModel extends Model
{
    protected $db;
    
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        $this->db = db_connect();
    }
    
    public function verify($username, $password)
    {
        $builder =  $this->db->table('user');
        $builder->select('*');
        $builder->where('email', $username);
        $builder->where('status', 1);
        $num = $builder->countAllResults(false);
        $row = $builder->get()->getRow();

        if ($num == 1 && password_verify($password, $row->password)) {
            $myid = $row->id;
            $this->db->query("update user set last_login = NOW() where id = ?", array($myid));

            $data = [
                'admin_id'  => $row->id,
                'admin_email' => $row->email,
                'admin_name'  => $row->name,
                'admin_photo'  => $row->photo_url,
                'admin_role' => $row->role,
                'admin_status' => true,
                'admin_last_login' => $row->last_login
            ];
            return $data;
        } else {
            return 0;
        }
    }
    
    public function verify_pusdiklat($username, $password, $id_kelas)
    {
        $builder =  $this->db->table('user_pusdiklat');
        $builder->select('*');
        $builder->where('email', $username);
        $builder->where('status', 1);
        $num = $builder->countAllResults(false);
        $row = $builder->get()->getRow();

        if ($num == 1 && password_verify($password, $row->password)) {
            $myid = $row->id;

            $session = [
                's_id_pengguna'  => $myid,
            ];
            session()->set($session);

            $this->db->query("update user_pusdiklat set last_login = NOW() where email = ?", array($myid));

            $table = 'pusdiklat_log';
            $data = [
                'id_kelas'  => $id_kelas,
                'id_user' => $row->id,
                'access_date'  => date('Y-m-d H:i:s')
            ];
            $q = $this->db->table($table);
            $q->insert($data);

            if ($this->db->affectedRows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return 0;
        }
    }
}
