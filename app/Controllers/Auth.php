<?php namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    protected $authentication;
    protected $role;

    public function __construct()
    {
        helper(['url', 'form', 'array', 'reCaptcha']);
        $this->authentication = new AuthModel();
        $this->role = \Config\Services::role();
    }

    public function index()
    {
        if (!$this->role->isLoggedIn()) {
            if ($this->request->isAJAX()) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            echo view('template/auth');
        } else {
            return redirect()->to('/cms/home');
        }
    }

    public function p()
    {
        $username      = $this->request->getPost('username');
        $password   = $this->request->getPost('password');
    
        $val = $this->validate(
            [
                'username' => 'required|valid_email',
                'password' => 'required',
                'recaptcha' => 'required'
            ],
            [   // Errors
                'username' => [
                    'required' => 'You must have username',
                    'valid_email' => 'You must have valid email'
                ],
                'password' => [
                    'required' => 'You must have password'
                ],
                'recaptcha' => [
                    'required' => 'You must check it recapctha!'
                ]
            ]
        );

        if ($val) {
            $result = $this->authentication->verify($username, $password);
            if ($result) {
                session()->set($result);
                //echo "berhasil";
                return redirect()->to('/cms/home');
            } else {
                $data['error'] = 'Could not enter, please contact your administrator';
                echo view('template/auth', $data);
            }
        } else {
            $data['validation'] = $this->validator;
            echo view('template/auth', $data);
        }
    }

    public function s()
    {
        session()->destroy();
        return redirect()->route('login');
    }
}
