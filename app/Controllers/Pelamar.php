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
        $data['jpendaftar'] = $model->getCount('statistik_pelamar','pendaftar',['ins_nm'=>session('lokasi_nama')]);
        $data['jsubmit'] = $model->getCount('statistik_pelamar','submit',['ins_nm'=>session('lokasi_nama')]);
        $data['jms'] = $model->getCount('statistik_pelamar','ms',['ins_nm'=>session('lokasi_nama')]);
        $data['jtms'] = $model->getCount('statistik_pelamar','tms',['ins_nm'=>session('lokasi_nama')]);
        return view('pelamar',$data);
    }
}
