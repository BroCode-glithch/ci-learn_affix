<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
// use CodeIgniter\Shield\Models\UserModel;
use App\Models\Admin\AdminModel;
use Config\Services;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Traits\Viewable;
use CodeIgniter\Shield\Validation\ValidationRules;

class AdminAuthController extends BaseController
{
    protected $auth;
    protected $adminModel;

    public function __construct()
    {
        $this->auth = Services::auth();
        $this->adminModel = new AdminModel();
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
        $firstname = $this->request->getPost('first_name');
        $lastname = $this->request->getPost('last_name');
        $username = $firstname . ' '. $lastname;
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        if ($password !== $passwordConfirm) {
            return redirect()->back()->with('error', 'Passwords do not match.');
        }

        // Prepare user data
        $data = [
            'email'    => $email,
            'username' => $username,
            'password' => $password, // CodeIgniter Shield will automatically hash the password
            'is_admin' => true, // You can define a custom field here to mark the user as an admin
        ];

        // Try to create a new user
        try {
            $admin = $this->adminModel->save($data); // Use save() instead of createUser()
            
            if ($admin) {
                return redirect()->to('/admin/login')->with('success', 'Account created successfully. Please log in.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.' . $e);
        }
    }

    // Admin Login
    public function login()
    {
        return view('admin/auth/login');
    }
    protected function getValidationRules(): array
    {
        $rules = new ValidationRules();

        return $rules->getLoginRules();
    }

    // public function loginPost()
    // {
    //     $email = $this->request->getPost('email');
    //     $password = $this->request->getPost('password');

    //     if (!$email && !$password) {
    //         return redirect()->back()->with('error', 'Email or Passwords do not match.');
    //     }

    //     // Prepare user data
    //     $data = [
    //         'email'    => $email,
    //         'password' => $password, // CodeIgniter Shield will automatically hash the password
    //         'is_admin' => true, // You can define a custom field here to mark the user as an admin
    //     ];

    //     // Try to create a new user
    //     try {
    //         $admin = $this->adminModel->save($data); // Use save() instead of createUser()
            
    //         if ($admin) {
    //             return redirect()->to('/admin/dashboard')->with('success', 'Account created successfully. Please log in.');
    //         } else {
    //             return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    //     }
        
    // }

    
    public function loginPost(): RedirectResponse
    {
        // Validate here first
        $rules = $this->getValidationRules();
    
        if (! $this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        /** @var array $credentials */
        $credentials             = $this->request->getPost(setting('Auth.validFields')) ?? [];
        $credentials             = array_filter($credentials);
        $credentials['password'] = $this->request->getPost('password');
        // $remember                = (bool) $this->request->getPost('remember');
    
        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();
    
        // Attempt to login
        $result = $authenticator->attempt($credentials);
    
        if (! $result->isOK()) {
            return redirect()->route('admin/login')
                ->withInput()
                ->with('error', $result->reason());  // Flash error message
        }
    
        // If an action has been defined for login, start it up.
        if ($authenticator->hasAction()) {
            return redirect()->route('auth-action-show')->withCookies();
        }
    
        // ✅ Add success message
        return redirect()->to(config('admin/dashboard')->loginRedirect())
            ->with('success', 'Login successful! Welcome back.') // Flash success message
            ->withCookies();
    }
    

    // Admin Logout
    public function logout()
    {
        $this->auth->logout();
        return redirect()->to('/admin/login')->with('success', 'Logged out successfully.');
    }
}
