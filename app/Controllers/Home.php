<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data['content'] = view('home'); // Load home.php content into $content
        return view('layouts/app', $data); // Pass it to the layout
    }
}
