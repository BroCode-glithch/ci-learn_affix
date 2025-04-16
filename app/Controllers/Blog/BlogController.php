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
        $model = new Blog();
        $data['blog']  = $model->where('slug', $slug)->first();

        if(!$data['blog'])
        {
            throw PageNotFoundException::forPageNotFound('Blog not found');
        }

        return view('blog/details', $data);
    }
    
}
