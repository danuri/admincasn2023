<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CrudModel;
use App\Models\UploadModel;

class Upload extends BaseController
{
    public function index()
    {
        return view('upload');
    }

    public function upload()
    {
        $validationRule = [
          'lampiran' => [
              'label' => 'Surat Pengantar',
              'rules' => 'uploaded[lampiran]'
                  . '|ext_in[lampiran,pdf,PDF]'
                  . '|max_size[lampiran,20000]',
          ],
      ];

    if (! $this->validate($validationRule)) {
          session()->setFlashdata('message', $this->validator->getErrors()['lampiran']);
          return redirect()->to('dokumen');
    }

    // $file = $this->request->getFile('lampiran');
    // $name = $file->getRandomName();
    // $file->move('download', $name);

    $iddokumen = $this->request->getVar('id');

    $file_name = $_FILES['pengantar']['name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);

    $file_name = 'casn.'.session('kelola').'-'.$iddokumen.'.'.$ext;
    $temp_file_location = $_FILES['pengantar']['tmp_name'];

    $s3 = new S3Client([
      'region'  => 'us-east-1',
      'endpoint' => 'https://docu.kemenag.go.id:9000/',
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

    $url = $result->get('ObjectURL');

    $doc = new DokumenModel();

    $data = [
        'id_dokumen'   => $this->request->getVar('id'),
        'id_satker'  => session('idsatker'),
        'lampiran'  => $name,
    ];

    if($this->request->getVar('idlampiran')){
        $doc->where(['id_dokumen'=>$this->request->getVar('id'),'id_satker'=>session('idsatker')])->set(['lampiran'=>$name])->update();
    }else{
        $doc->save($data);
    }


    session()->setFlashdata('message', 'Dokumen telah diupdate');
    return redirect()->to('dokumen');
    }
}
