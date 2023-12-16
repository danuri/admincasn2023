<?php

namespace App\Controllers\Pengaturan;

use App\Controllers\BaseController;
use App\Models\PenempatanModel;
use App\Models\UnorModel;

class Penempatan extends BaseController
{
    public function index()
    {
        $model = new PenempatanModel;
        $data['penempatan'] = $model->where(['kode_lokasi' => session('lokasi')])->findAll();
        return view('penempatan', $data);
    }

    public function search()
    {
      $model = new UnorModel;
      $search = $this->request->getVar('search');

      $data = $model->like('nama', $search, 'both')->findAll();
      return $this->response->setJSON($data);
    }

    public function save()
    {
      $model = new PenempatanModel;
      $munor = new UnorModel;

      $id = $this->request->getVar('idformasi');
      $unorid = $this->request->getVar('unor');

      $namaunor = $munor->find($unorid);

      $param = ['unor_nama' => $namaunor->nama,'unor_id'=>$unorid];
      $model->update($id,$param);

      return redirect()->back()->with('message','Unor telah diupdate');
    }
}
