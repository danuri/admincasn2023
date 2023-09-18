<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DownloadModel;

class Download extends BaseController
{
    public function index()
    {
        $model = new DownloadModel;
        $data['download'] = $model->findAll();

        return view('admin/download/index', $data);
    }
}
