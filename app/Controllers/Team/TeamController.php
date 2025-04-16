<?php

namespace App\Controllers\Team;


use App\Models\Team\TeamModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TeamController extends BaseController
{
    public function index()
    {
        $teamModel = new TeamModel();
        
        // Fetch all teams
        $teams = $teamModel->orderBy('id', 'DESC')->findAll();
    
        $data['teams'] = $teams;
    
        return view('home', $data);
    }
    
}
