<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CrudModel;

class Pelamar extends BaseController
{
    public function index($jenis)
    {
      $model  = new CrudModel();
      $data['stat']   = $model->getResult('statistik_pelamar',['jenis'=>$jenis]);
      $data['jpendaftar'] = $model->getCount('statistik_pelamar','pendaftar',['jenis'=>$jenis]);
      $data['jsubmit'] = $model->getCount('statistik_pelamar','submit',['jenis'=>$jenis]);
      $data['jms'] = $model->getCount('statistik_pelamar','ms',['jenis'=>$jenis]);
      $data['jtms'] = $model->getCount('statistik_pelamar','tms',['jenis'=>$jenis]);
      return view('admin/pelamar',$data);
    }
}
