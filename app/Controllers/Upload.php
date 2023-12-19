<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CrudModel;
use App\Models\DokumenModel;
use App\Models\UploadModel;
use Aws\S3\S3Client;

class Upload extends BaseController
{
    public function index()
    {
        $model = new CrudModel;
        $data['dokumen'] = $model->dokumen();
        return view('upload', $data);
    }

    public function save()
    {
        $validationRule = [
          'lampiran' => [
              'label' => 'Lampiran',
              'rules' => 'uploaded[lampiran]'
                  . '|ext_in[lampiran,pdf,PDF]'
                  . '|max_size[lampiran,20000]',
          ],
      ];

    if (! $this->validate($validationRule)) {
          session()->setFlashdata('message', $this->validator->getErrors()['lampiran']);
          return redirect()->to('upload');
    }

    // $file = $this->request->getFile('lampiran');
    // $name = $file->getRandomName();
    // $file->move('download', $name);

    $iddokumen = $this->request->getVar('id');

    $file_name = $_FILES['lampiran']['name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);

    $file_name = 'sptjm.'.$iddokumen.'.'.session('lokasi').'.'.$ext;
    $temp_file_location = $_FILES['lampiran']['tmp_name'];

    $s3 = new S3Client([
      'region'  => 'us-east-1',
      'endpoint' => 'https://ropeg.kemenag.go.id:9000/',
      'use_path_style_endpoint' => true,
      'version' => 'latest',
      'credentials' => [
        'key'    => "118ZEXFCFS0ICPCOLIEJ",
        'secret' => "9xR+TBkYyzw13guLqN7TLvxhfuOHSW++g7NCEdgP",
      ],
      'http'    => [
          'verify' => false
      ]
    ]);

    $result = $s3->putObject([
      'Bucket' => 'sscasn',
      'Key'    => '2023/surat/'.$file_name,
      'SourceFile' => $temp_file_location,
      'ContentType' => 'application/pdf'
    ]);

    $up = new UploadModel;
      $data = [
        'id_dokumen' => $iddokumen,
        'kode_lokasi' => session('lokasi'),
        'created_by' => session('nip'),
        'attachment' => $file_name,
      ];

    // $insert = $up->save($data);

    if(!$this->request->getVar('idlampiran')){
        $up->insert($data);
    }


    session()->setFlashdata('message', 'Dokumen telah diunggah');
    return redirect()->to('upload');
    }
}
