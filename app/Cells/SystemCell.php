<?php

namespace App\Cells;

use App\Models\System;
use CodeIgniter\View\Cells\Cell;

class SystemCell extends Cell
{
    public function footerInfo()
    {
        $system = (new System())->first();
        return view('layouts/app', ['systems' => $system]);
    }
}
