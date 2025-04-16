<?php

namespace App\Controllers;
use App\Models\System;
use App\Controllers\BaseController;

class SystemController extends BaseController
{
    public function index(){

        $system = new System();

        $data['systems'] = $system->first();
        return view('home', $data);
    }
}