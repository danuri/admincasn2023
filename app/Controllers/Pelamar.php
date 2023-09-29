<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CrudModel;

class Pelamar extends BaseController
{
    public function index(): string
    {
        $model  = new CrudModel();
        $data['stat']   = $model->getResult('statistik_pelamar',['ins_nm'=>session('lokasi_nama')]);
        return view('pelamar',$data);
    }
}
