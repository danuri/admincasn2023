<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelamarModel;
use App\Models\CrudModel;
use App\Libraries\Notifikasi;

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
      $token = 'eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiIxOTg3MDcyMjIwMTkwMzEwMDUiLCJpYXQiOjE2OTc5NDkyNzUsImV4cCI6MTY5Nzk1Mjg3NSwiaWQiOiI4YTAwOGJmMDhhYzUzMmI2MDE4YWRlYjM2Nzg5MDU2OCIsIm5hbWEiOiJEQU5VUkkiLCJ1c2VybmFtZSI6IjE5ODcwNzIyMjAxOTAzMTAwNSIsImluc3RhbnNpSWQiOiJBNUVCMDNFMjNCRkJGNkEwRTA0MDY0MEEwNDAyNTJBRCIsImluc3RhbnNpTmFtYSI6IktlbWVudGVyaWFuIEFnYW1hIiwiamVuaXNQZW5nYWRhYW5zIjpbeyJyb2xlIjoiU1VQRVJWSVNPUl9DUE5TIiwibmFtYSI6IkNQTlMiLCJsb2thc2lzIjpudWxsLCJpZCI6IjIiLCJwYXJhbWV0ZXJJbnN0YW5zaUlkIjoiZmY2MjRjNDA0ODk0MTFlZThjMDUwMDUwNTY4ZmYxMTMiLCJsb2thc2lQcm92SWRzIjpudWxsfSx7InJvbGUiOiJTVVBFUlZJU09SX1BQUEtfTkFLRVMiLCJuYW1hIjoiUFBQSyBUZW5hZ2EgS2VzZWhhdGFuIiwibG9rYXNpcyI6bnVsbCwiaWQiOiI0IiwicGFyYW1ldGVySW5zdGFuc2lJZCI6ImZmNjJmNjA1NDg5NDExZWU4YzA1MDA1MDU2OGZmMTEzIiwibG9rYXNpUHJvdklkcyI6bnVsbH0seyJyb2xlIjoiU1VQRVJWSVNPUl9QUFBLIiwibmFtYSI6IlBQUEsgVGVrbmlzIiwibG9rYXNpcyI6bnVsbCwiaWQiOiIzIiwicGFyYW1ldGVySW5zdGFuc2lJZCI6ImZmNjJhMDM3NDg5NDExZWU4YzA1MDA1MDU2OGZmMTEzIiwibG9rYXNpUHJvdklkcyI6bnVsbH1dLCJhdXRob3JpdGllcyI6W3siYXV0aG9yaXR5IjoiUk9MRV9TVVBFUlZJU09SX1BQUEtfTkFLRVMifSx7ImF1dGhvcml0eSI6IlJPTEVfU1VQRVJWSVNPUl9QUFBLIn0seyJhdXRob3JpdHkiOiJST0xFX1NVUEVSVklTT1JfQ1BOUyJ9XSwiaXNDcG5zIjp0cnVlLCJpc1BwcGsiOnRydWUsImlzUHBwa0d1cnUiOmZhbHNlLCJpc1BwcGtOYWtlcyI6dHJ1ZSwiaXNQcHBrRG9zZW4iOmZhbHNlfQ.8FXiEArg4PNUK6iHRbzK0eQ5ajsOxHU1QiCNvO_kYYF5NoucfhB_HwMLnF7lbrxCxlzmiMQvftnqlFrHTFYNrA';

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
        // echo 'update '.$nik;
      }

      // echo 'selesai';

      // sleep(5);

      $newpage = $page+1;

      if($newpage > $body->totalPages){
        echo 'executing '.$body->totalElements;
        echo '<br>';
        ?>
        <div>This page will reload in <span id="cnt" style="color:red;">300</span> Seconds</div>
        <script>
          var counter = 300;

          // The countdown method.
          window.setInterval(function () {
              counter--;
              if (counter >= 0) {
                  var span;
                  span = document.getElementById("cnt");
                  span.innerHTML = counter;
              }
              if (counter === 0) {
                  clearInterval(counter);
              }

          }, 1000);

          window.setInterval('refresh()', 300000);

          function refresh() {
              window.location.reload();
          }
      </script>
        <?php
      }else{
        return redirect()->to('api/sanggah/'.$jenis.'/'.$type.'/'.$newpage);
      }
    }

    public function whatsapp()
    {
      $model = new CrudModel;
      $peserta = $model->getResult('notifwa',['status'=>0]);

      foreach ($peserta as $row) {
        $text = '📑 *Info PPPK Kementerian Agama RI 2023*

Kepada. *'.$row->nama.'*

Kami Informasikan bahwa terdapat penyesuaian Jadwal Seleksi Kompetensi.

Jadwal:
*Universitas Islam Makassar Auditorium Drs. KH. Muhyddin M. Zain, 28 November 2023 sesi 1*

Kunjungi https://casn.kemenag.go.id/informasi untuk melihat daftar peserta penyesuaian jadwal.

Terima Kasih

*Nomor ini tidak menerima balasan atau telepon*

*Biro Kepegawaian*' ;
        $hp   = hp($row->phone);

        $notif = new Notifikasi();
        $notif->sendWhatsapp($hp,$text);
      }
    }
}
