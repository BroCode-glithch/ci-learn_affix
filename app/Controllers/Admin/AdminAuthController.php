<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Models\UserModel;
use Config\Services;

class AdminAuthController extends BaseController
{
    protected $auth;
    protected $userModel;

    public function __construct()
    {
        $this->auth = Services::auth();
        $this->userModel = new UserModel();
    }

    // Admin Registration Form
    public function register()
    {
        return view('admin/auth/register');
    }

    // Handle Admin Registration
    public function registerPost()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        if ($password !== $passwordConfirm) {
            return redirect()->back()->with('error', 'Passwords do not match.');
        }

        // Prepare user data
        $data = [
            'email'    => $email,
            'password' => $password, // CodeIgniter Shield will automatically hash the password
            'is_admin' => true, // You can define a custom field here to mark the user as an admin
        ];

        // Try to create a new user
        try {
            $user = $this->userModel->save($data); // Use save() instead of createUser()
            
            if ($user) {
                return redirect()->to('/admin/login')->with('success', 'Account created successfully. Please log in.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong. Please try again.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Admin Logout
    public function logout()
    {
        $this->auth->logout();
        return redirect()->to('/admin/login')->with('success', 'Logged out successfully.');
    }
}
