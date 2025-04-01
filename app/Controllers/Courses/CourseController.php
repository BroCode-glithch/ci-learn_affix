<?php

namespace App\Controllers\Courses;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Courses\Courses;
use CodeIgniter\Exceptions\PageNotFoundException;

class CourseController extends BaseController
{
    public function index()
    {
        $courseModel = new Courses();
    
        // Fetch distinct categories
        $data['categories'] = $courseModel->select('DISTINCT(category)')->findAll();
    
        // Fetch distinct topics
        // $data['topics'] = $courseModel->getTopics();
    
        // Fetch all courses
        $data['courses'] = $courseModel->orderBy('id', 'DESC')->findAll(); 
    
        // Fetch featured (highlighted) courses
        $data['highlighted_courses'] = $courseModel->where('is_featured', 1)->orderBy('id', 'DESC')->findAll(6);
    
        return view("courses/course", $data);
    }

    public function category($category)
    {
        helper('text'); // ✅ Load the text helper to enable word_limiter()
    
        $courseModel = new Courses();
    
        // Decode category name from URL
        $category = urldecode($category);
    
        // Fetch courses based on category with correct chaining
        $data['courses'] = $courseModel->where('category', $category)
                                       ->orderBy('id', 'DESC')
                                       ->findAll();
        
        $data['category_name'] = $category;
    
        return view("courses/course-category", $data);
    }    
    
    public function show($id)
    {
        helper(['text']); // Load the text helper

        $courseModel = new Courses();
        $course = $courseModel->find($id);

        if (!$course) {
            throw PageNotFoundException::forPageNotFound("Course not found");
        }

        // Fetch other courses excluding the current one
        $other_courses = $courseModel->where('id !=', $id)->orderBy('id', 'DESC')->findAll(5);

        // Pass data to the view
        return view('courses/course-details', [
            'course' => $course,
            'other_courses' => $other_courses
        ]);
    }

    public function coursePage()
    {
        $model = new Courses();
        
        // Fetch all categories
        $data['categories'] = $model->select('DISTINCT(category)', false)->findAll();
    
        // Fetch featured courses correctly
        $data['highlighted_courses'] = $model->where('is_featured', 1)->orderBy('id', 'DESC')->findAll(6);
    
        // Debugging: Uncomment to check the fetched courses
        dd($data['highlighted_courses']); 
    
        return view('courses/course', $data);
    }     
    
}
