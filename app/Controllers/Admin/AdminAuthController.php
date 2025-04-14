<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Validation\ValidationRules;
use Config\Services;

class AdminAuthController extends BaseController
{
    protected $auth;
    protected $adminModel;

    public function __construct()
    {
        $this->auth = Services::auth();
        $this->adminModel = new AdminModel();
        helper(['url', 'form']);
    }

    public function register()
    {
        return view('admin/auth/register');
    }

    public function registerPost()
    {
        $request = service('request');
    
        $firstName = $request->getPost('first_name');
        $lastName = $request->getPost('last_name');
        $email = $request->getPost('email');
        $password = $request->getPost('password');
        $passwordConfirm = $request->getPost('password_confirm');
    
        // Simple validation
        if ($password !== $passwordConfirm) {
            return redirect()->to('/admin/register')->with('error', 'Passwords do not match.');
        }
    
        if ($this->adminModel->where('email', $email)->first()) {
            return redirect()->to('/admin/register')->with('error', 'Email already registered.');
        }
    
        try {
            $this->adminModel->save([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'is_admin' => 1,
            ]);
            return redirect()->to('/admin/login')->with('success', 'Admin registered successfully. Login to continue.');
        } catch (\Exception $e) {
            return redirect()->to('/admin/register')->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }
    

    // Admin Login
    public function login()
    {
        // Check if user is already logged in
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/auth/login');
    }

    // Admin Login Post
    public function loginPost(): RedirectResponse
    {
        // Validate input
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

        // Attempt login using Shield's authentication
        $credentials = [
            'email'    => $email,
            'password' => $password,
        ];

        $authenticator = auth('session')->getAuthenticator();
        $result = $authenticator->attempt($credentials);

        if (!$result->isOK()) {
            return redirect()->route('admin/login')
                ->withInput()
                ->with('error', $result->reason()); // Flash error message
        }

        // Check if the user is an admin
        $user = $this->auth->user();
        if (!$user->is_admin) {
            // If not an admin, logout and redirect
            $this->auth->logout();
            return redirect()->route('admin/login')
                ->with('error', 'You are not authorized to access this area.');
        }

        // Redirect to the admin dashboard
        return redirect()->to('/admin/dashboard')
            ->with('success', 'Login successful! Welcome back.')
            ->withCookies();
    }

    // Admin Logout
    public function logout()
    {
        $this->auth->logout();
        return redirect()->to('/admin/login')->with('success', 'Logged out successfully.');
    }
}
