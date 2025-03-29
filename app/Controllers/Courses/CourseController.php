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
        $courses = $courseModel->findAll(); // Fetch all courses
    
        return view("courses/course", ['courses' => $courses]); // Pass courses to view
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
}
