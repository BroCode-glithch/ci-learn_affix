<?php

namespace App\Controllers;
use App\Models\Courses\Courses;

class Home extends BaseController
{
    public function index(): string
    {
        $courses = new Courses();

        // Fetch 2 courses from the database
        $data['courses_data'] = $courses->orderBy('id', 'DESC')->findAll(); 

        // Load the home.php view into 'content'
        $data['content'] = view('home', $data);

        // Pass the data to the layout
        return view('layouts/app', $data);
    }
}
