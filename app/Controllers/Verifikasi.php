<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\CrudModel;

class Verifikasi extends BaseController
{
  public function index()
  {
    $satker = new SatkerModel();
    $data['satker'] = $satker->find(session('idsatker'));
    return view('validasi/index', $data);
  }

  public function epa()
  {
    $data['pegawai'] = false;
    return view('verifikasi/epa', $data);
  }

  public function searchepa()
  {
    // $client = \Config\Services::curlrequest();
    $nik = $this->request->getVar('nik');

    $model = new CrudModel;
    $pegawai = $model->getRow('temp_penyuluh',['nik'=>$nik]);

    // $response = $client->request('GET', 'https://epa.kemenag.go.id/api/nik/'.$nipa);
    $data['pegawai'] = $pegawai;
    // if($pegawai){
    // }else{
    //   $data['pegawai'] = 'notfound';
    // }
    return view('verifikasi/epa', $data);
  }

  public function simpatika()
  {
    $data['pegawai'] = false;
    return view('verifikasi/simpatika', $data);
  }

  public function searchsimpatika()
  {
    $nik = $this->request->getVar('nik');

    $model = new CrudModel;
    $pegawai = $model->getRow('temp_simpatika',['nik'=>$nik]);

    $data['pegawai'] = $pegawai;
    return view('verifikasi/simpatika', $data);
  }

  public function emis()
  {
    $data['pegawai'] = false;
    return view('verifikasi/emis', $data);
  }

  public function searchemis()
  {
    $nik = $this->request->getVar('nik');

    $model = new CrudModel;
    $pegawai = $model->getRow('temp_emis',['nik'=>$nik]);

    $data['pegawai'] = $pegawai;
    return view('verifikasi/emis', $data);
  }

  public function thk2()
  {
    $data['pegawai'] = false;
    return view('verifikasi/thk2', $data);
  }

  public function searchthk2()
  {
    $nik = $this->request->getVar('nik');

    $model = new CrudModel;
    $pegawai = $model->getRow('thk2',['NO_PESERTA'=>$nik]);

    $data['pegawai'] = $pegawai;
    return view('verifikasi/thk2', $data);
  }

  public function nonasn()
  {
    $data['pegawai'] = false;
    return view('verifikasi/nonasn', $data);
  }

  public function searchnonasn()
  {
    $nik = $this->request->getVar('nik');

    $model = new CrudModel;
    $pegawai = $model->getNonAsn($nik);

    $data['pegawai'] = $pegawai;
    return view('verifikasi/nonasn', $data);
  }

}
