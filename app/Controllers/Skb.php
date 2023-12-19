<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\SktModel;
use App\Models\PesertaskttModel;

class Skb extends BaseController
{

  public function index()
  {
    $model = new CrudModel;
    $data['peserta'] = $model->getResult('sktt_peserta',['lokasi_jabatan'=>session('satker')]);

    return view('sktt/index', $data);
  }

  public function aksespenguji()
  {
    $model = new CrudModel;
    $data['akses'] = $model->getResult('skb_penguji',['kode_lokasi'=>session('lokasi')]);

    return view('skb/akses', $data);
  }

}
