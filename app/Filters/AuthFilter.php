<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    protected $r;
    
    public function __construct()
    {
        $this->r = \Config\Services::role();
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        if (! $this->r->isLoggedIn()) {
            if ($request->isAJAX()) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            return redirect()->route('login');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        if ($this->r->forbidden) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
