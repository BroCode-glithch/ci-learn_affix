<?php

namespace App\Controllers;
use App\Models\System;
use App\Models\About\About;
use App\Models\Team\TeamModel;
use App\Models\Courses\Courses;

class Home extends BaseController
{
    public function index(): string
    {
        $system = new System();
        $data['systems '] = $system->findAll();

        $courses = new Courses();
        // Fetch courses from the database
        $data['courses_data'] = $courses->orderBy('id', 'DESC')->findAll();  

        // Fetch distinct categories with images
        $data['categories'] = $courses->select('DISTINCT(category), image')->findAll(3);

        $aboutModel = new About();
        $data['about'] = $aboutModel->first();

        $teamModel = new TeamModel();
        // Fetch all teams from the db orderBy id
        $teams = $teamModel->orderBy('id', 'DESC')->findAll();
        $data['teams'] = $teams;

        // Pass data to the view
        return view('home', $data);
    }
}
