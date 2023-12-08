<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\SktModel;
use App\Models\PesertaskttModel;

class Sktt extends BaseController
{

  public function index()
  {
    $model = new CrudModel;
    $data['peserta'] = $model->getResult('sktt_peserta',['lokasi_jabatan'=>session('satker')]);

    return view('sktt/index', $data);
  }

  public function akses()
  {
    $model = new CrudModel;
    $data['lokasi'] = $model->getResult('sktt_lokasi',['kode_lokasi'=>session('lokasi')]);

    return view('sktt/akses', $data);
  }

  public function lokasi()
  {
    $model = new CrudModel;
    $data['lokasi'] = $model->getResult('skt_lokasi',['id_provinsi'=>session('lokasi')]);

    return view('sktt/lokasi', $data);
  }

  public function peserta($id)
  {
    $id = decrypt($id);
    $model = new CrudModel;
    $data['lokasi'] = $model->getResult('skt_lokasi',['id_provinsi'=>session('lokasi')]);
    $data['tilok'] = $model->getRow('sktt_tilok',['id'=>$id]);
    $data['peserta'] = $model->getResult('sktt_peserta',['tilok_kode'=>$id]);

    return view('sktt/lokasi', $data);
  }

  public function inserttilokx()
  {
	// return $this->response->setJSON(['message'=>'Sudah ditutup!']);

    if (! $this->validate([
      'lokasi' => "required",
      'alamat' => "required",
      'maps' => "required",
    ])) {
      return redirect()->back()->with('message', 'Pastikan Semua sudah terisi');
    }

    $model = new SktModel();

    $data = [
        'kode_lokasi' => $this->request->getVar('kode_lokasi'),
        'tilok' => $this->request->getVar('lokasi'),
        'alamat' => $this->request->getVar('alamat'),
        'maps' => $this->request->getVar('maps'),
      ];

    $model->insert($data);

    session()->setFlashdata('message', 'Tilok berhasil direkam');

    return redirect()->back();
  }

  public function edittilokx()
  {
    if (! $this->validate([
      'lokasi' => "required",
      'alamat' => "required",
      'maps' => "required",
    ])) {
      return redirect()->back()->with('message', 'Pastikan Semua sudah terisi');
    }

    $model = new SktModel();

    $data = [
        'tilok' => $this->request->getVar('lokasi'),
        'alamat' => $this->request->getVar('alamat'),
        'maps' => $this->request->getVar('maps'),
      ];

    $model->update($this->request->getVar('idtilok'),$data);

    session()->setFlashdata('message', 'Tilok berhasil diupdate');

    return redirect()->back();
  }

  public function editx($id)
  {
    $model = new SktModel();
    $detail = $model->find($id);

    return $this->response->setJSON($detail);
  }

  public function deletetilokx($id)
  {
    $model = new SktModel;
    $id = decrypt($id);
    $model->delete($id);

    session()->setFlashdata('message', 'Tilok berhasil dihapus');
    return redirect()->back();
  }

  public function gettilok($id)
  {
    $model = new SktModel();
    $detail = $model->where('kode_lokasi',$id)->findAll();

    foreach ($detail as $row) {
      echo '<option value="'.$row->id.'">'.$row->tilok.'</option>';
    }
  }

  public function pindahtilokx()
  {
    $model = new PesertaskttModel();
    $peserta = $this->request->getVar('peserta');
    $tilok = $this->request->getVar('titik_lokasi');
    $lokasi = $this->request->getVar('lokasi');
    $sesi = $this->request->getVar('sesi');

    for ($i=0; $i < count($peserta); $i++) {
      $update = $model->where(['nomor_peserta'=>$peserta[$i],'tilok_kabupaten'=>$lokasi])->set(['tilok_kode'=>$tilok,'sesi'=>$sesi])->update();
    }

    return redirect()->back();
  }

  public function generatejadwalx()
  {
    $lokasi = $this->request->getVar('lokasi');
    $sesi = $this->request->getVar('sesi');

    $id = decrypt($lokasi);
    $model = new CrudModel;
    $modelp = new PesertaskttModel;

    $peserta = $model->getResult('sktt_peserta',['tilok_kode'=>$id]);
    $jumlah = count($peserta);
    $persesi = ceil($jumlah/$sesi);
    // echo $persesi;
    $nomor = 1;
    $ses = 1;
    foreach ($peserta as $row) {

      $update = $modelp->where(['nomor_peserta'=>$row->nomor_peserta])->set(['sesi'=>$ses])->update();
      // echo $nomor.'. '.$row->nama.' : '.$ses.'<br>';

      $nomor++;

      if($nomor > $persesi){
        $ses = $ses+1;
        $nomor = 1;
      }
    }

    return redirect()->back();
  }
}
