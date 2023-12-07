<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelamarModel;

class Siasn extends BaseController
{
    public function role()
    {
        $pegawaix = ['199007222019031011','198602072011011009','198404142009101003','198110152009012009','198007292009011009','198606192020121007','198211012009012008','198012242003121003','198504302019032009','199212042019031019','198512302011011010','198502212019031005','199002022022031002','197903262011011005','198107152009012016','197806112005012005','197804112009012006','198307122009012009','198312312009011031','198310012014111002','199612022019031002','198905152019031020','198002222003121003','199505072020122008'];
        $pegawaif = ['197305202002121003','198606082009011004','198505062019032011','198805192019031007','199601172020122009','199704212022032006','197412152006041021','198803292014031003','199008032015051002','198907012020121014','198306022009122003','198009162005012007','199309112020122006','198202252009011011','199303142022032002','198009102006041003','199203082020121018','197310182009011006','198708112019031003','198611172009011005','197907292003122001','197707272002121003','198505122009121005'];
        $pegawai = ['198806162011011008','196707152005011002','198408132009011001','199805092022031001','199401272019031010','199008142019032012','198008192001121002','198711082015031003','198409042011012017'];

        for ($i=0; $i < count($pegawai); $i++) {
          $step1 = $this->step1($pegawai[$i]);
          // print_r($step1->status);
          if($step1->status == 'success'){
            $user = $this->viewuser($pegawai[$i]);
            if($user->data->id_keycloack){
              $this->step2($user->data->id_keycloack);
            }
          }
        }
    }

    public function step1($nip)
    {
      $token = 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJBUWNPM0V3MVBmQV9MQ0FtY2J6YnRLUEhtcWhLS1dRbnZ1VDl0RUs3akc4In0.eyJleHAiOjE3MDE5MTg2NjgsImlhdCI6MTcwMTg3NTQ2OCwiYXV0aF90aW1lIjoxNzAxODc1NDY4LCJqdGkiOiJmNjk1ZDg0MC0xNDFhLTRmODQtYWE0NS04MDE3ZmM3OTVkN2MiLCJpc3MiOiJodHRwczovL3Nzby1zaWFzbi5ia24uZ28uaWQvYXV0aC9yZWFsbXMvcHVibGljLXNpYXNuIiwiYXVkIjoiYWNjb3VudCIsInN1YiI6IjcyOTg0MzdiLWVjMTctNGEzNi05N2Q2LTdmYWJjNzMyZjRjOCIsInR5cCI6IkJlYXJlciIsImF6cCI6InNpYXNuLWluc3RhbnNpIiwibm9uY2UiOiIxOWVhYjYwNS05ODAxLTQ2YTctOGE3Yi1lN2YyNjYyZDY5NjQiLCJzZXNzaW9uX3N0YXRlIjoiODk3MDU5NjMtYzNhOS00ODk5LWE5NTctMTRlN2YxYjFhYWNmIiwiYWNyIjoiMSIsImFsbG93ZWQtb3JpZ2lucyI6WyJodHRwczovL3NpYXNuLWluc3RhbnNpLmJrbi5nby5pZCIsImh0dHA6Ly9zaWFzbi1pbnN0YW5zaS5ia24uZ28uaWQiLCJodHRwOi8vbG9jYWxob3N0OjMwMDAiXSwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGk6VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1pbmZvamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlcmVuY2FuYWFuOmluc3RhbnNpLW1vbml0b3ItcGVyZW5jYW5hYW4ta2VwZWdhd2FpYW4iLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbWJlcmhlbnRpYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOnJla29uIiwicm9sZTpkaXNwYWthdGk6aW5zdGFuc2k6dHRlIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6a3A6b3BlcmF0b3IiLCJyb2xlOmRhc2hib2FyZC1rZWJpamFrYW46aW5zdGFuc2kiLCJyb2xlOm1hbmFqZW1lbi13czpkZXZlbG9wZXIiLCJvZmZsaW5lX2FjY2VzcyIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktb3BlcmF0b3ItcGVtZW51aGFuLWtlYi1wZWdhd2FpIiwidW1hX2F1dGhvcml6YXRpb24iLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOlRURSIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1ldmFqYWIiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbmdhZGFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zb3RrIiwicm9sZTpkYXNoYm9hcmQtb3BlcmFzaW9uYWw6aW5zdGFuc2kiLCJyb2xlOmRpc3Bha2F0aTppbnN0YW5zaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVuZ2FkYWFuOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTphcHByb3ZhbCIsInJvbGU6c2lhc24taW5zdGFuc2k6YmF0YWxuaXA6YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnNrazpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmlwYXNuOm1vbml0b3JpbmciLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zdGFuZGFyLWtvbXAtamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1wZW5ldGFwYW4tc290ayIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6cHJvZmlsYXNuOnZpZXdwcm9maWwiLCJyb2xlOmRhc2hib2FyZC1vcGVyYXNpb25hbDppbnN0YW5zaS1waW1waW5hbiIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVtYmVyaGVudGlhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTphZG1pbjphZG1pbiJdfSwicmVzb3VyY2VfYWNjZXNzIjp7ImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJtYW5hZ2UtYWNjb3VudC1saW5rcyIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoib3BlbmlkIGVtYWlsIHByb2ZpbGUiLCJlbWFpbF92ZXJpZmllZCI6ZmFsc2UsIm5hbWUiOiJZT0dJRSBQUklCQURJIiwicHJlZmVycmVkX3VzZXJuYW1lIjoiMTk4MTA2MTgyMDA4MDExMDA3IiwiZ2l2ZW5fbmFtZSI6IllPR0lFIiwiZmFtaWx5X25hbWUiOiJQUklCQURJIiwiZW1haWwiOiJ5b2dpZS5wcmliYWRpQGdtYWlsLmNvbSJ9.Z25989B75DodjHWR-f85v8icz5bz2hIC2_fTWj9gLycFonBxZNyp8JFKrUSAHlsBrxvBoLr6jmnohrJyGWn-qnP9YGh_G-3xUUZVnOwkCPltY9-UNYst89q3IwlFxDtNEcFQ9ltNsART8r6aOrJKpdHDo_L86UKfel_41quhxJmYD5SbMDvtKOOEhiO3qWJgDO0bfAMipOK2UtEuA5xMf63jKJ4vz4pnPUFQbdV5GIA4PQfGIoR6aeul3wtIkDLxp85KDGuJW50zWagmOEpF4bBme2MUcGG2s6FXa0xKSUkrvt6EZJylnf9Uvxhtr6w7yn9qaaGfr8g4DHGLKX-Lnw';

      $client = \Config\Services::curlrequest();
      $request = $client->request('POST', 'https://api-siasn.bkn.go.id:8443/admin-instansi/api/AddUser/Step1', [
                          'form_params' => [
                              'username' => $nip
                          ],
                          'headers' => [
                              'Authorization' => 'Bearer '.$token
                          ],
                          'verify' => false,
                          'debug' => true
                      ]);

      $body = json_decode($request->getBody());

      return $body;
    }

    public function viewuser($nip)
    {
      $token = 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJBUWNPM0V3MVBmQV9MQ0FtY2J6YnRLUEhtcWhLS1dRbnZ1VDl0RUs3akc4In0.eyJleHAiOjE3MDE5MTg2NjgsImlhdCI6MTcwMTg3NTQ2OCwiYXV0aF90aW1lIjoxNzAxODc1NDY4LCJqdGkiOiJmNjk1ZDg0MC0xNDFhLTRmODQtYWE0NS04MDE3ZmM3OTVkN2MiLCJpc3MiOiJodHRwczovL3Nzby1zaWFzbi5ia24uZ28uaWQvYXV0aC9yZWFsbXMvcHVibGljLXNpYXNuIiwiYXVkIjoiYWNjb3VudCIsInN1YiI6IjcyOTg0MzdiLWVjMTctNGEzNi05N2Q2LTdmYWJjNzMyZjRjOCIsInR5cCI6IkJlYXJlciIsImF6cCI6InNpYXNuLWluc3RhbnNpIiwibm9uY2UiOiIxOWVhYjYwNS05ODAxLTQ2YTctOGE3Yi1lN2YyNjYyZDY5NjQiLCJzZXNzaW9uX3N0YXRlIjoiODk3MDU5NjMtYzNhOS00ODk5LWE5NTctMTRlN2YxYjFhYWNmIiwiYWNyIjoiMSIsImFsbG93ZWQtb3JpZ2lucyI6WyJodHRwczovL3NpYXNuLWluc3RhbnNpLmJrbi5nby5pZCIsImh0dHA6Ly9zaWFzbi1pbnN0YW5zaS5ia24uZ28uaWQiLCJodHRwOi8vbG9jYWxob3N0OjMwMDAiXSwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGk6VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1pbmZvamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlcmVuY2FuYWFuOmluc3RhbnNpLW1vbml0b3ItcGVyZW5jYW5hYW4ta2VwZWdhd2FpYW4iLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbWJlcmhlbnRpYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOnJla29uIiwicm9sZTpkaXNwYWthdGk6aW5zdGFuc2k6dHRlIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6a3A6b3BlcmF0b3IiLCJyb2xlOmRhc2hib2FyZC1rZWJpamFrYW46aW5zdGFuc2kiLCJyb2xlOm1hbmFqZW1lbi13czpkZXZlbG9wZXIiLCJvZmZsaW5lX2FjY2VzcyIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktb3BlcmF0b3ItcGVtZW51aGFuLWtlYi1wZWdhd2FpIiwidW1hX2F1dGhvcml6YXRpb24iLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOlRURSIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1ldmFqYWIiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbmdhZGFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zb3RrIiwicm9sZTpkYXNoYm9hcmQtb3BlcmFzaW9uYWw6aW5zdGFuc2kiLCJyb2xlOmRpc3Bha2F0aTppbnN0YW5zaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVuZ2FkYWFuOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTphcHByb3ZhbCIsInJvbGU6c2lhc24taW5zdGFuc2k6YmF0YWxuaXA6YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnNrazpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmlwYXNuOm1vbml0b3JpbmciLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zdGFuZGFyLWtvbXAtamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1wZW5ldGFwYW4tc290ayIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6cHJvZmlsYXNuOnZpZXdwcm9maWwiLCJyb2xlOmRhc2hib2FyZC1vcGVyYXNpb25hbDppbnN0YW5zaS1waW1waW5hbiIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVtYmVyaGVudGlhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTphZG1pbjphZG1pbiJdfSwicmVzb3VyY2VfYWNjZXNzIjp7ImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJtYW5hZ2UtYWNjb3VudC1saW5rcyIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoib3BlbmlkIGVtYWlsIHByb2ZpbGUiLCJlbWFpbF92ZXJpZmllZCI6ZmFsc2UsIm5hbWUiOiJZT0dJRSBQUklCQURJIiwicHJlZmVycmVkX3VzZXJuYW1lIjoiMTk4MTA2MTgyMDA4MDExMDA3IiwiZ2l2ZW5fbmFtZSI6IllPR0lFIiwiZmFtaWx5X25hbWUiOiJQUklCQURJIiwiZW1haWwiOiJ5b2dpZS5wcmliYWRpQGdtYWlsLmNvbSJ9.Z25989B75DodjHWR-f85v8icz5bz2hIC2_fTWj9gLycFonBxZNyp8JFKrUSAHlsBrxvBoLr6jmnohrJyGWn-qnP9YGh_G-3xUUZVnOwkCPltY9-UNYst89q3IwlFxDtNEcFQ9ltNsART8r6aOrJKpdHDo_L86UKfel_41quhxJmYD5SbMDvtKOOEhiO3qWJgDO0bfAMipOK2UtEuA5xMf63jKJ4vz4pnPUFQbdV5GIA4PQfGIoR6aeul3wtIkDLxp85KDGuJW50zWagmOEpF4bBme2MUcGG2s6FXa0xKSUkrvt6EZJylnf9Uvxhtr6w7yn9qaaGfr8g4DHGLKX-Lnw';

      $client = \Config\Services::curlrequest();
      $request = $client->request('get', 'https://api-siasn.bkn.go.id:8443/admin-instansi/api/ViewUser?username='.$nip, [
                          'headers' => [
                              'Authorization' => 'Bearer '.$token
                          ],
                          'verify' => false
                      ]);

      $body = json_decode($request->getBody());

      return $body;
    }

    public function step2($id)
    {

      $token = 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJBUWNPM0V3MVBmQV9MQ0FtY2J6YnRLUEhtcWhLS1dRbnZ1VDl0RUs3akc4In0.eyJleHAiOjE3MDE5MTg2NjgsImlhdCI6MTcwMTg3NTQ2OCwiYXV0aF90aW1lIjoxNzAxODc1NDY4LCJqdGkiOiJmNjk1ZDg0MC0xNDFhLTRmODQtYWE0NS04MDE3ZmM3OTVkN2MiLCJpc3MiOiJodHRwczovL3Nzby1zaWFzbi5ia24uZ28uaWQvYXV0aC9yZWFsbXMvcHVibGljLXNpYXNuIiwiYXVkIjoiYWNjb3VudCIsInN1YiI6IjcyOTg0MzdiLWVjMTctNGEzNi05N2Q2LTdmYWJjNzMyZjRjOCIsInR5cCI6IkJlYXJlciIsImF6cCI6InNpYXNuLWluc3RhbnNpIiwibm9uY2UiOiIxOWVhYjYwNS05ODAxLTQ2YTctOGE3Yi1lN2YyNjYyZDY5NjQiLCJzZXNzaW9uX3N0YXRlIjoiODk3MDU5NjMtYzNhOS00ODk5LWE5NTctMTRlN2YxYjFhYWNmIiwiYWNyIjoiMSIsImFsbG93ZWQtb3JpZ2lucyI6WyJodHRwczovL3NpYXNuLWluc3RhbnNpLmJrbi5nby5pZCIsImh0dHA6Ly9zaWFzbi1pbnN0YW5zaS5ia24uZ28uaWQiLCJodHRwOi8vbG9jYWxob3N0OjMwMDAiXSwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGk6VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1pbmZvamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlcmVuY2FuYWFuOmluc3RhbnNpLW1vbml0b3ItcGVyZW5jYW5hYW4ta2VwZWdhd2FpYW4iLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbWJlcmhlbnRpYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOnJla29uIiwicm9sZTpkaXNwYWthdGk6aW5zdGFuc2k6dHRlIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6a3A6b3BlcmF0b3IiLCJyb2xlOmRhc2hib2FyZC1rZWJpamFrYW46aW5zdGFuc2kiLCJyb2xlOm1hbmFqZW1lbi13czpkZXZlbG9wZXIiLCJvZmZsaW5lX2FjY2VzcyIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktb3BlcmF0b3ItcGVtZW51aGFuLWtlYi1wZWdhd2FpIiwidW1hX2F1dGhvcml6YXRpb24iLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOlRURSIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1ldmFqYWIiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbmdhZGFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zb3RrIiwicm9sZTpkYXNoYm9hcmQtb3BlcmFzaW9uYWw6aW5zdGFuc2kiLCJyb2xlOmRpc3Bha2F0aTppbnN0YW5zaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVuZ2FkYWFuOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTphcHByb3ZhbCIsInJvbGU6c2lhc24taW5zdGFuc2k6YmF0YWxuaXA6YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnNrazpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmlwYXNuOm1vbml0b3JpbmciLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zdGFuZGFyLWtvbXAtamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1wZW5ldGFwYW4tc290ayIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6cHJvZmlsYXNuOnZpZXdwcm9maWwiLCJyb2xlOmRhc2hib2FyZC1vcGVyYXNpb25hbDppbnN0YW5zaS1waW1waW5hbiIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVtYmVyaGVudGlhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTphZG1pbjphZG1pbiJdfSwicmVzb3VyY2VfYWNjZXNzIjp7ImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJtYW5hZ2UtYWNjb3VudC1saW5rcyIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoib3BlbmlkIGVtYWlsIHByb2ZpbGUiLCJlbWFpbF92ZXJpZmllZCI6ZmFsc2UsIm5hbWUiOiJZT0dJRSBQUklCQURJIiwicHJlZmVycmVkX3VzZXJuYW1lIjoiMTk4MTA2MTgyMDA4MDExMDA3IiwiZ2l2ZW5fbmFtZSI6IllPR0lFIiwiZmFtaWx5X25hbWUiOiJQUklCQURJIiwiZW1haWwiOiJ5b2dpZS5wcmliYWRpQGdtYWlsLmNvbSJ9.Z25989B75DodjHWR-f85v8icz5bz2hIC2_fTWj9gLycFonBxZNyp8JFKrUSAHlsBrxvBoLr6jmnohrJyGWn-qnP9YGh_G-3xUUZVnOwkCPltY9-UNYst89q3IwlFxDtNEcFQ9ltNsART8r6aOrJKpdHDo_L86UKfel_41quhxJmYD5SbMDvtKOOEhiO3qWJgDO0bfAMipOK2UtEuA5xMf63jKJ4vz4pnPUFQbdV5GIA4PQfGIoR6aeul3wtIkDLxp85KDGuJW50zWagmOEpF4bBme2MUcGG2s6FXa0xKSUkrvt6EZJylnf9Uvxhtr6w7yn9qaaGfr8g4DHGLKX-Lnw';

      $client = \Config\Services::curlrequest();
      $request = $client->request('POST', 'https://api-siasn.bkn.go.id:8443/admin-instansi/api/AddUser/New-Step2', [
                          'form_params' => [
                              'id' => $id,
                              'layanan_id' => 16,
                              'group_id' => 2,
                          ],
                          'headers' => [
                              'Authorization' => 'Bearer '.$token
                          ],
                          'verify' => false
                      ]);
      $body = json_decode($request->getBody());

      echo $body->messages;
    }

    public function token()
    {

      $code = '609f43f4-eadd-4cc3-9d66-5fe61073001f.1d2129c9-25b0-45f3-baf7-4b9aa09faeb8.6975ad27-6356-4d22-b9db-f999f608f99e';

      $client = \Config\Services::curlrequest();
      $request = $client->request('POST', 'https://sso-siasn.bkn.go.id/auth/realms/public-siasn/protocol/openid-connect/token', [
                          'form_params' => [
                              'code' => $code,
                              'grant_type' => 'authorization_code',
                              'client_id' => 'siasn-instansi',
                          ],
                          'headers' => [
                              'Authorization' => 'Bearer '.$token
                          ],
                          'verify' => false
                      ]);
      $body = json_decode($request->getBody());

      echo $body->messages;
    }
}
