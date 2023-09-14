<?php

namespace App\Controllers\Pengaturan;

use App\Controllers\BaseController;
use App\Models\FormasiModel;

class Formasi extends BaseController
{
    public function index()
    {
        $model = new FormasiModel;
        $data['formasi'] = $model->where(['kode_lokasi' => session('lokasi')])->findAll();
        return view('pengaturan/formasi', $data);
    }

    public function saveporsi()
    {
      if (! $this->validate([
          'ids' => "required",
          'nonasn' => "required"
        ])) {
            return $this->response->setJSON(['message'=>'Harap isi jumlah Non ASN.']);
        }

        $id = $this->request->getVar('ids');
        $nonasn = $this->request->getVar('nonasn');

        $model = new FormasiModel;
        $formasi = $model->find($id);

        if($nonasn > $formasi->jumlah){
          return $this->response->setJSON(['message'=>'Jumlah Non ASN lebih dari total alokasi.']);
        }

        $umum = $formasi->jumlah - $nonasn;

        $data = [
            'nonasn' => $this->request->getVar('nonasn'),
            'umum' => $umum
        ];


        $insert = $model->update($id,$data);

        return $this->response->setJSON(['message'=>'Alokasi telah diupdate']);
    }
}
