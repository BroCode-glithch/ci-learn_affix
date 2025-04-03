<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;
use Config\Services;

class UserController extends BaseController
{
    protected $auth;

    public function __construct()
    {
        $this->auth = Services::auth();
    }

    // Method to view the profile
    public function profile()
    {
        // Get the logged-in user
        $user = $this->auth->user();

        // If user is authenticated, pass the user data to the view
        if ($user) {
            return view('user/profile', ['user' => $user]);
        }

        // If not authenticated, redirect to login
        return redirect()->to('/login')->with('error', 'Please log in to view your profile.');
    }   
    public function editProfile()
    {
        $user = auth()->user(); // Get authenticated user
    
        if (!$user) {
            return redirect()->to('/user/profile')->with('error', 'User not found.');
        }
    
        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'username' => 'required|min_length[3]',
                'email'    => 'required|valid_email|is_unique[users.email,id,' . $user->id . ']',
            ]);
    
            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
    
            // Get updated data from the form
            $data = [
                'id'       => $user->id, // Make sure ID is passed for update
                'username' => $this->request->getPost('username'),
                'email'    => $this->request->getPost('email'),
            ];
    
            // Update user entity
            $userEntity = new User($data);
            $users = new UserModel();
            $users->save($userEntity);
    
            // Refresh user session data
            auth()->login($users->find($user->id));
    
            return redirect()->to('/user/profile')->with('success', 'Profile updated successfully!');
        }
    
        return view('user/profile-edit', ['user' => $user]);
    }  
    
}
