<?php

namespace App\Controllers\Pengaturan;

use App\Controllers\BaseController;
use App\Models\FormasiModel;
use App\Models\UploadModel;
use Aws\S3\S3Client;

class Formasi extends BaseController
{
    public function index()
    {
        $model = new FormasiModel;
        $dokumen = new UploadModel;
        $dok = $dokumen->where(['kode_lokasi'=>session('lokasi')])->find();

        $data['formasi'] = $model->where(['kode_lokasi' => session('lokasi')])->findAll();

        if($dok){
          return view('pengaturan/formasi_final', $data);
        }else{
          return view('pengaturan/formasi', $data);
        }

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

    public function final()
    {
      // Upload to S3
      // $file_name = $_FILES['lampiran']['name'];
      // $ext = pathinfo($file_name, PATHINFO_EXTENSION);
      //
      // $file_name = 'sptjm.1.'.session('lokasi').'.'.$ext;
      // $temp_file_location = $_FILES['lampiran']['tmp_name'];
      //
      // $s3 = new S3Client([
      //   'region'  => 'us-east-1',
      //   'endpoint' => 'https://docu.kemenag.go.id:9000/',
      //   'use_path_style_endpoint' => true,
      //   'version' => 'latest',
      //   'credentials' => [
      //     'key'    => "118ZEXFCFS0ICPCOLIEJ",
      //     'secret' => "9xR+TBkYyzw13guLqN7TLvxhfuOHSW++g7NCEdgP",
      //   ],
      //   'http'    => [
      //       'verify' => false
      //   ]
      // ]);
      //
      // $result = $s3->putObject([
      //   'Bucket' => 'sscasn',
      //   'Key'    => '2023/'.$file_name,
      //   'SourceFile' => $temp_file_location,
      //   'ContentType' => 'application/pdf'
      // ]);
      //
      // $model = new UploadModel;
      //   $data = [
      //     'id_dokumen' => 1,
      //     'kode_lokasi' => session('lokasi'),
      //     'created_by' => session('nip'),
      //     'attachment' => $file_name,
      //   ];
      //
      // $insert = $model->insert($data);

      return redirect()->back()->with('message','SPTJM telah diunggah');
    }
}
