<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DokumenModel;
use App\Models\UploadModel;

class Dokumen extends BaseController
{
    public function index()
    {
        $model = new DokumenModel;
        $data['dokumen'] = $model->findAll();

        return view('admin/dokumen/index', $data);
    }

    public function unggahan($id)
    {
        $model = new DokumenModel;
        $data['dokumen'] = $model->find($id);
        $data['unggahan'] = $model->unggahan($id);

        return view('admin/dokumen/unggahan', $data);
    }

    public function deleteunggahan($id)
    {
      $model = new UploadModel;
      $model->delete($id);

      return redirect()->back()->with('message', 'Unggahan telah dihapus');
    }
}
