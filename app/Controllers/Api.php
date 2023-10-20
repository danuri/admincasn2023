<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelamarModel;

class Api extends BaseController
{
    public function index()
    {
        //
    }

    public function sanggah($page=1)
    {
      $client = \Config\Services::curlrequest();

      $cache = \Config\Services::cache();
      $token = $cache->get('bkn_dispakati_token');
      $token = 'eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiIxOTg3MDcyMjIwMTkwMzEwMDUiLCJpYXQiOjE2OTc4MTM3NTgsImV4cCI6MTY5NzgxNzM1OCwiaWQiOiI4YTAwOGJmMDhhYzUzMmI2MDE4YWRlYjM2Nzg5MDU2OCIsIm5hbWEiOiJEQU5VUkkiLCJ1c2VybmFtZSI6IjE5ODcwNzIyMjAxOTAzMTAwNSIsImluc3RhbnNpSWQiOiJBNUVCMDNFMjNCRkJGNkEwRTA0MDY0MEEwNDAyNTJBRCIsImluc3RhbnNpTmFtYSI6IktlbWVudGVyaWFuIEFnYW1hIiwiamVuaXNQZW5nYWRhYW5zIjpbeyJyb2xlIjoiU1VQRVJWSVNPUl9QUFBLIiwibmFtYSI6IlBQUEsgVGVrbmlzIiwibG9rYXNpcyI6bnVsbCwiaWQiOiIzIiwicGFyYW1ldGVySW5zdGFuc2lJZCI6ImZmNjJhMDM3NDg5NDExZWU4YzA1MDA1MDU2OGZmMTEzIiwibG9rYXNpUHJvdklkcyI6bnVsbH1dLCJhdXRob3JpdGllcyI6W3siYXV0aG9yaXR5IjoiUk9MRV9TVVBFUlZJU09SX1BQUEsifV0sImlzQ3BucyI6ZmFsc2UsImlzUHBwayI6dHJ1ZSwiaXNQcHBrR3VydSI6ZmFsc2UsImlzUHBwa05ha2VzIjpmYWxzZSwiaXNQcHBrRG9zZW4iOmZhbHNlfQ.1cMvKUKFp0a29i2lh2VfC0HDVZ7vLGv5feuX4TKCBJQy2UOJ5_kNbfAcreHNpvVTjuHsV69BqTWC3JtVzFvZ3A';

      $paramx = [
          'byJenisPengadaanId' => '3',
          'byIsSudahJawabSanggah' => false,
          'paginatedRequest' => [
            'tipeResult' => 'SHUFFLE',
            'size' => 100,
            'page' => $page
          ]
      ];

      $param = '{"byJenisPengadaanId":"3","paginatedRequest":{"tipeResult":"SHUFFLE","size":10,"page":1}}';

      $request = $client->request('POST', 'https://apiverifikasi-sscasn.bkn.go.id/api/sanggah/paginate', [
                          'json' => $paramx,
                          'headers' => [
                              'Content-Type' => 'application/json',
                              'Authorization' => 'Bearer '.$token
                          ],
                          'verify' => false,
                          'debug' => true
                      ]);

      $body = json_decode($request->getBody());
      $count = count($body->content);

      $model = new PelamarModel;

      for ($i=0; $i < $count; $i++) {
        $nik = $body->content[$i]->pendaftarId->nik;
        // update db
        $model->where(['nik'=>$nik])->set(['is_sanggah'=>2])->update();
        echo 'update '.$nik;
      }

      // echo 'selesai';

      // sleep(5);

      if($i == $count){
        $newpage = $page+1;

        if($newpage > $body->totalPages){
          echo 'Done';
          return false;
        }else{
          return redirect()->to('api/sanggah/'.$newpage);
        }
      }
    }
}
