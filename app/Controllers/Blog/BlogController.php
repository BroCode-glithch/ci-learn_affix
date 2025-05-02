<?php

namespace App\Controllers\Blog;

use App\Models\Blog\Blog;
use App\Controllers\BaseController;
use App\Models\Blog\Category;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class BlogController extends BaseController
{
    public function index()
    {     
        helper('text');
        
        // You can later modify this condition to check if the blog is under development
        $isUnderDevelopment = true; // Change this based on your requirement
    
        if ($isUnderDevelopment) {
            return view('under_development'); // Show the under development page
        }

        $model = new Blog();

        $data['blogs'] = $model->orderBy('created_at', 'DESC')->findAll();
        $data['recentPosts'] = $model->orderBy('created_at', 'DESC')->findAll(4); // Last 4 posts
        // $categoryModel = new Category();  // Assuming you have a CategoryModel to get categories

        // // Fetching all categories from the database
        // $data['categories'] = $categoryModel->findAll();  // This will get all the categories

        return view('blog/blog', $data);
    }  
    
    public function detail($slug)
    {
        // You can later modify this condition to check if the blog is under development
        $isUnderDevelopment = true; // Change this based on your requirement
    
        if ($isUnderDevelopment) {
            return view('under_development'); // Show the under development page
        }
    
        $model = new Blog();
        $data['blog']  = $model->where('slug', $slug)->first();
    
        if (!$data['blog']) {
            throw PageNotFoundException::forPageNotFound('Blog not found');
        }
    
        // If the page is not under development, show the details page
        return view('blog/details', $data);
    }
    
}