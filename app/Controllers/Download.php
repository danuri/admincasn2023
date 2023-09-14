<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Download extends BaseController
{
    public function index()
    {
        return view('download');
    }
}
