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

    public function sanggah($jenis,$type,$page=1)
    {
      $client = \Config\Services::curlrequest();

      $cache = \Config\Services::cache();
      $token = $cache->get('bkn_dispakati_token');
      $token = 'eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiIxOTg3MDcyMjIwMTkwMzEwMDUiLCJpYXQiOjE2OTc4MTcxMDEsImV4cCI6MTY5NzgyMDcwMSwiaWQiOiI4YTAwOGJmMDhhYzUzMmI2MDE4YWRlYjM2Nzg5MDU2OCIsIm5hbWEiOiJEQU5VUkkiLCJ1c2VybmFtZSI6IjE5ODcwNzIyMjAxOTAzMTAwNSIsImluc3RhbnNpSWQiOiJBNUVCMDNFMjNCRkJGNkEwRTA0MDY0MEEwNDAyNTJBRCIsImluc3RhbnNpTmFtYSI6IktlbWVudGVyaWFuIEFnYW1hIiwiamVuaXNQZW5nYWRhYW5zIjpbeyJyb2xlIjoiU1VQRVJWSVNPUl9DUE5TIiwibmFtYSI6IkNQTlMiLCJsb2thc2lzIjpudWxsLCJpZCI6IjIiLCJwYXJhbWV0ZXJJbnN0YW5zaUlkIjoiZmY2MjRjNDA0ODk0MTFlZThjMDUwMDUwNTY4ZmYxMTMiLCJsb2thc2lQcm92SWRzIjpudWxsfSx7InJvbGUiOiJTVVBFUlZJU09SX1BQUEtfTkFLRVMiLCJuYW1hIjoiUFBQSyBUZW5hZ2EgS2VzZWhhdGFuIiwibG9rYXNpcyI6bnVsbCwiaWQiOiI0IiwicGFyYW1ldGVySW5zdGFuc2lJZCI6ImZmNjJmNjA1NDg5NDExZWU4YzA1MDA1MDU2OGZmMTEzIiwibG9rYXNpUHJvdklkcyI6bnVsbH0seyJyb2xlIjoiU1VQRVJWSVNPUl9QUFBLIiwibmFtYSI6IlBQUEsgVGVrbmlzIiwibG9rYXNpcyI6bnVsbCwiaWQiOiIzIiwicGFyYW1ldGVySW5zdGFuc2lJZCI6ImZmNjJhMDM3NDg5NDExZWU4YzA1MDA1MDU2OGZmMTEzIiwibG9rYXNpUHJvdklkcyI6bnVsbH1dLCJhdXRob3JpdGllcyI6W3siYXV0aG9yaXR5IjoiUk9MRV9TVVBFUlZJU09SX1BQUEtfTkFLRVMifSx7ImF1dGhvcml0eSI6IlJPTEVfU1VQRVJWSVNPUl9QUFBLIn0seyJhdXRob3JpdHkiOiJST0xFX1NVUEVSVklTT1JfQ1BOUyJ9XSwiaXNDcG5zIjp0cnVlLCJpc1BwcGsiOnRydWUsImlzUHBwa0d1cnUiOmZhbHNlLCJpc1BwcGtOYWtlcyI6dHJ1ZSwiaXNQcHBrRG9zZW4iOmZhbHNlfQ.4rOAmVz88vlftNEI8FLJEcTpMuPxL1Lq0LRacigD2gOkFYW5oQgsbqUkyosmRbn9QhNUcLqRdNCmtmRWqMrp5w';

      $paramx = [
          'byJenisPengadaanId' => $jenis,
          'byIsSudahJawabSanggah' => $type,
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

      $newpage = $page+1;

      if($newpage > $body->totalPages){
        echo 'Done';
        return false;
      }else{
        return redirect()->to('api/sanggah/'.$jenis.'/'.$type.'/'.$newpage);
      }
    }
}
