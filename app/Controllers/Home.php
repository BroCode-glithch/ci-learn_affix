<?php

namespace App\Controllers;
use App\Models\Courses\Courses;
use App\Models\About\About;

class Home extends BaseController
{
    public function index(): string
    {
        $courses = new Courses();

        // Fetch courses from the database
        $data['courses_data'] = $courses->orderBy('id', 'DESC')->findAll();  

        // Fetch distinct categories with images
        $data['categories'] = $courses->select('DISTINCT(category), image')->findAll();

        $aboutModel = new About();
        $data['about'] = $aboutModel->first();

        // Pass data to the view
        return view('home', $data);
    }
}
