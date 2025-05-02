<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class AdminAuthController extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        helper(['url', 'form', 'session']);
    }

    // Admin Register (GET)
    public function register()
    {
        return view('admin/auth/register');
    }

    // Admin Register (POST)
    public function registerPost()
    {
        $request = service('request');

        $firstName = $request->getPost('first_name');
        $lastName = $request->getPost('last_name');
        $userName = $firstName . ' ' . $lastName;
        $email = $request->getPost('email');
        $password = $request->getPost('password');
        $passwordConfirm = $request->getPost('password_confirm');

        // Validate password confirmation
        if ($password !== $passwordConfirm) {
            return redirect()->to('/admin/register')->withInput()->with('error', 'Passwords do not match.');
        }

        // Check if user already exists
        if ($this->adminModel->where('email', $email)->first()) {
            return redirect()->to('/admin/register')->withInput()->with('error', 'Email already registered.');
        }

        try {
            // Save new admin
            $this->adminModel->save([
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'username'   => $userName,
                'email'      => $email,
                'password'   => password_hash($password, PASSWORD_DEFAULT),
                'is_admin'   => 1, // Flag to mark as admin
            ]);

            return redirect()->to('/admin/login')->with('success', 'Admin registered successfully. Login to continue.');
        } catch (\Exception $e) {
            return redirect()->to('/admin/register')->withInput()->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }

    // Admin Login (GET)
    public function login()
    {
        if (session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/auth/login');
    }

    // Admin Login (POST)
    public function loginPost(): RedirectResponse
    {
        $validation = Services::validation();
        $validation->setRules([
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('error', 'Invalid input.');
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Find admin
        $admin = $this->adminModel->where('email', $email)->first();

        if (!$admin || !password_verify($password, $admin['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid credentials.');
        }

        // Save session data
        session()->set([
            'admin_id'          => $admin['id'],
            'admin_name'        => $admin['first_name'] . ' ' . $admin['last_name'],
            'is_admin'          => true,
            'isAdminLoggedIn'   => true,  // New session flag
        ]);

        return redirect()->to('/admin/dashboard')->with('success', 'Login successful! Welcome back.');
    }

    // Admin Logout
    public function logout()
    {
        session()->remove(['admin_id', 'admin_name', 'is_admin', 'isAdminLoggedIn']);
        return redirect()->to('/admin/login')->with('success', 'Logged out successfully.');
    }
}
