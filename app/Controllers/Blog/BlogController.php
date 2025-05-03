<?php

namespace App\Controllers\Blog;

use App\Models\Blog\Tag;
use App\Models\Blog\Blog;
use App\Models\Blog\Category;
use App\Models\CategoryModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;

class BlogController extends BaseController
{
    public function index()
    {     
        helper('text');
        
        // You can later modify this condition to check if the blog is under development
        $isUnderDevelopment = false; // Set to false to enable the blog
    
        if ($isUnderDevelopment) {
            return view('under_development'); // Show the under development page
        }
    
        $model = new Blog();

        $data['blogs'] = $model->orderBy('created_at', 'DESC')->findAll();
        $data['recentPosts'] = $model->orderBy('created_at', 'DESC')->findAll(4);

        // Get unique categories from the blogs table
        $categoryModel = new Category();
        $data['categories'] = $categoryModel->select('categories.name, categories.slug')
            ->join('blogs', 'blogs.category_id = categories.id')
            ->groupBy('categories.id')
            ->selectCount('blogs.id', 'post_count')
            ->findAll();

        $tagModel = new Tag();
        $data['tags'] = $tagModel->findAll();

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
