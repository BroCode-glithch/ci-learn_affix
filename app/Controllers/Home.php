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

        // Pass the data to the layout
        return view('home', $data);
    }
}
