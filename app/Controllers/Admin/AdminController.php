<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function loginShow()
    {
        return view('admin/auth/login');
    }

    public function registerShow()
    {
        return view('admin/auth/register');
    }

    public function users()
    {
        return view('admin/users');
    }

    public function settings()
    {
        return view('admin/settings');
    }
}
