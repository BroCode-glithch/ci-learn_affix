<?php

namespace App\Controllers\About;

use App\Controllers\BaseController;
use App\Models\About\About;
use App\Models\Services\Services;
use App\Models\Topic\Topic;
use App\Models\Team\Team;

class AboutController extends BaseController
{
    public function index()
    {
        // Load the About, Service, and Topic models
        $aboutModel = new About();
        $serviceModel = new Services();
        $topicModel = new Topic(); // Load the Topic model
        $teamModel = new Team(); // Load the TeamModel

        // Fetch about data from the database
        $aboutData = $aboutModel->findAll();
        $about = [];
        if (!empty($aboutData)) {
            $about = $aboutData[0]; // Assuming the about data is stored in the first row
        }

        // Fetch all services from the services table
        $services = $serviceModel->findAll();

        // Fetch all topics from the topics table
        $topics = $topicModel->findAll();

        // Fetch all team members from the team table
        $team = $teamModel->findAll();

        // Pass the data to the view
        return view('about/about', [
            'about' => $about,
            'services' => $services,
            'topics' => $topics, // Pass the topics to the view
            'team' => $team,
        ]);
    }
}
