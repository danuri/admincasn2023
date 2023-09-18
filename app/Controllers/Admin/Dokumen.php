<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DokumenModel;

class Dokumen extends BaseController
{
    public function index()
    {
        $model = new DokumenModel;
        $data['dokumen'] = $model->findAll();

        return view('admin/dokumen/index', $data);
    }
}
