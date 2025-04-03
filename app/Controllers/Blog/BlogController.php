<?php

namespace App\Controllers\Blog;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BlogController extends BaseController
{
    public function index()
    {      
        return view('blog/blog');
    }    
    
}
