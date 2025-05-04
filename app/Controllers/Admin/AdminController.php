<?php

namespace App\Controllers\Admin;

use App\Models\User;
use App\Models\Blog\Tag;
use App\Models\Blog\Blog;
use App\Models\Blog\Category;
use App\Models\Courses\Courses;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function index()
    {
        $courseModel = new Courses();
        $postModel = new Blog();
        $categoryModel = new Category();
        $tagModel = new Tag();
    
        // Basic counts (keep as is)
        $data1 = [
            'courseCount' => $courseModel->countAll(),
            'postCount' => $postModel->countAll(),
            'categoryCount' => $categoryModel->countAll(),
            'tagCount' => $tagModel->countAll(),
        ];

        $data2 = [
            'courses' => $courseModel->findAll(),
        ];

    
        // ✅ Get posts per month (for area chart)
        $postsPerMonth = $postModel->select("COUNT(id) as count, DATE_FORMAT(created_at, '%b') as month")
            ->groupBy('month')
            ->orderBy('created_at', 'ASC')
            ->findAll();
    
        $months = [];
        $postCounts = [];
        foreach ($postsPerMonth as $row) {
            $months[] = $row['month'];
            $postCounts[] = $row['count'];
        }
    
        // ✅ Get posts per category (for bar chart)
        $postsPerCategory = $categoryModel
            ->select('categories.name, COUNT(blogs.id) as post_count')
            ->join('blogs', 'blogs.category_id = categories.id', 'left')
            ->groupBy('categories.id')
            ->findAll();
    
        $categoryNames = [];
        $categoryCounts = [];
        foreach ($postsPerCategory as $row) {
            $categoryNames[] = $row['name'];
            $categoryCounts[] = $row['post_count'];
        }
    
        // ✅ Add to data array
        $data1['months'] = $months;
        $data1['postCounts'] = $postCounts;
        $data1['categoryNames'] = $categoryNames;
        $data1['categoryCounts'] = $categoryCounts;
    
        return view('admin/dashboard', $data1, $data2);
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
