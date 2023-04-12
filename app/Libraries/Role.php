<?php namespace App\Libraries;

use CodeIgniter\Config\BaseService;

class Role extends BaseService
{
    public $forbidden = false;
    public $active = "";
    public $module = "";
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    
    public function isLoggedIn()
    {
        if ((! session()->get('admin_status'))) {
            return false;
        } else {
            return true;
        }
    }
}
