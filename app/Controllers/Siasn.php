<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelamarModel;

class Siasn extends BaseController
{
    public function role()
    {
        $pegawai = ['197304102006041003','196908172006041006','197606102006041011','197702232006041010','197503122006041017','197711212008011007','197403252008011004','198109212009011014','197911302009011008','197511022009101001','197609072006041004','197402152006041023','197509222006041020','197208072006041015','197806282006041022','197304242006041018','197703022007011017','197911132009121004','198503092011012009','197607162011011004','198505032011012012'];

        $pegawaix = [];

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
      $token = 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJBUWNPM0V3MVBmQV9MQ0FtY2J6YnRLUEhtcWhLS1dRbnZ1VDl0RUs3akc4In0.eyJleHAiOjE2OTg2OTA5MTIsImlhdCI6MTY5ODY0NzcxNCwiYXV0aF90aW1lIjoxNjk4NjQ3NzEyLCJqdGkiOiI2YjU1YzA0OC00MGI0LTQ5ZTItYjRmOC1jNTRkOTg5ZDIzOGYiLCJpc3MiOiJodHRwczovL3Nzby1zaWFzbi5ia24uZ28uaWQvYXV0aC9yZWFsbXMvcHVibGljLXNpYXNuIiwiYXVkIjoiYWNjb3VudCIsInN1YiI6IjcyOTg0MzdiLWVjMTctNGEzNi05N2Q2LTdmYWJjNzMyZjRjOCIsInR5cCI6IkJlYXJlciIsImF6cCI6InNpYXNuLWluc3RhbnNpIiwibm9uY2UiOiI4ZDZlNGQ0My04Nzk3LTQzNDctOWUyNy1iMWM2OTZlNGY1NmYiLCJzZXNzaW9uX3N0YXRlIjoiMWE4MWZlOGItMmExNi00YjliLWIzNWYtMjQ2YjJhYjgwZDFlIiwiYWNyIjoiMSIsImFsbG93ZWQtb3JpZ2lucyI6WyJodHRwczovL3NpYXNuLWluc3RhbnNpLmJrbi5nby5pZCIsImh0dHA6Ly9zaWFzbi1pbnN0YW5zaS5ia24uZ28uaWQiLCJodHRwOi8vbG9jYWxob3N0OjMwMDAiXSwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGk6VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1pbmZvamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlcmVuY2FuYWFuOmluc3RhbnNpLW1vbml0b3ItcGVyZW5jYW5hYW4ta2VwZWdhd2FpYW4iLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbWJlcmhlbnRpYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOnJla29uIiwicm9sZTpkaXNwYWthdGk6aW5zdGFuc2k6dHRlIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6a3A6b3BlcmF0b3IiLCJyb2xlOm1hbmFqZW1lbi13czpkZXZlbG9wZXIiLCJvZmZsaW5lX2FjY2VzcyIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktb3BlcmF0b3ItcGVtZW51aGFuLWtlYi1wZWdhd2FpIiwidW1hX2F1dGhvcml6YXRpb24iLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOlRURSIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1ldmFqYWIiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbmdhZGFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zb3RrIiwicm9sZTpkaXNwYWthdGk6aW5zdGFuc2k6b3BlcmF0b3IiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbmdhZGFhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVtYmVyaGVudGlhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGk6YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmJhdGFsbmlwOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpza2s6VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTppcGFzbjptb25pdG9yaW5nIiwicm9sZTpzaWFzbi1pbnN0YW5zaTprcDpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktb3BlcmF0b3Itc3RhbmRhci1rb21wLWphYiIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVtYmVyaGVudGlhbjphcHByb3ZhbCIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktcGVuZXRhcGFuLXNvdGsiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlcmVtYWphYW46cGFyYWYiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnByb2ZpbGFzbjp2aWV3cHJvZmlsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpza2s6cGFyYWYiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmFkbWluOmFkbWluIl19LCJyZXNvdXJjZV9hY2Nlc3MiOnsiYWNjb3VudCI6eyJyb2xlcyI6WyJtYW5hZ2UtYWNjb3VudCIsIm1hbmFnZS1hY2NvdW50LWxpbmtzIiwidmlldy1wcm9maWxlIl19fSwic2NvcGUiOiJvcGVuaWQgZW1haWwgcHJvZmlsZSIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwibmFtZSI6IllPR0lFIFBSSUJBREkiLCJwcmVmZXJyZWRfdXNlcm5hbWUiOiIxOTgxMDYxODIwMDgwMTEwMDciLCJnaXZlbl9uYW1lIjoiWU9HSUUiLCJmYW1pbHlfbmFtZSI6IlBSSUJBREkiLCJlbWFpbCI6InlvZ2llLnByaWJhZGlAZ21haWwuY29tIn0.GxDNPz77mEWcIrRmSDHMP2Gm3BiN2VgeFAGcSWVS1krhMR8YMacXNUlJ7NMwl1GygsVuNJ0bFIiEanYIPbwGsJlkKBPMg0drJ-Z138_UciLaNA59xmf3ig10DcwsuNLTfNRgW1mktSGjq1qAgzkoyv4j-qCj7JC010dALdMUlN8R2-xJ8F6OOcu_sCLBonlaZJRtPO9v_r6b1O-kbJE44Mfw-3Od9QewgrLwXyTTYSt_MNWdfOPU_p_PLA829-cmxNd6r-n8FEY2Z5cJYTpUh8TDGnBqHT2D08nWiV6C8tDSIPUsv9ASj73U7siI7IBpXLF51KqKHvch7POyp3Cbiw';

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
      $token = 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJBUWNPM0V3MVBmQV9MQ0FtY2J6YnRLUEhtcWhLS1dRbnZ1VDl0RUs3akc4In0.eyJleHAiOjE2OTg2OTA5MTIsImlhdCI6MTY5ODY0NzcxNCwiYXV0aF90aW1lIjoxNjk4NjQ3NzEyLCJqdGkiOiI2YjU1YzA0OC00MGI0LTQ5ZTItYjRmOC1jNTRkOTg5ZDIzOGYiLCJpc3MiOiJodHRwczovL3Nzby1zaWFzbi5ia24uZ28uaWQvYXV0aC9yZWFsbXMvcHVibGljLXNpYXNuIiwiYXVkIjoiYWNjb3VudCIsInN1YiI6IjcyOTg0MzdiLWVjMTctNGEzNi05N2Q2LTdmYWJjNzMyZjRjOCIsInR5cCI6IkJlYXJlciIsImF6cCI6InNpYXNuLWluc3RhbnNpIiwibm9uY2UiOiI4ZDZlNGQ0My04Nzk3LTQzNDctOWUyNy1iMWM2OTZlNGY1NmYiLCJzZXNzaW9uX3N0YXRlIjoiMWE4MWZlOGItMmExNi00YjliLWIzNWYtMjQ2YjJhYjgwZDFlIiwiYWNyIjoiMSIsImFsbG93ZWQtb3JpZ2lucyI6WyJodHRwczovL3NpYXNuLWluc3RhbnNpLmJrbi5nby5pZCIsImh0dHA6Ly9zaWFzbi1pbnN0YW5zaS5ia24uZ28uaWQiLCJodHRwOi8vbG9jYWxob3N0OjMwMDAiXSwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGk6VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1pbmZvamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlcmVuY2FuYWFuOmluc3RhbnNpLW1vbml0b3ItcGVyZW5jYW5hYW4ta2VwZWdhd2FpYW4iLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbWJlcmhlbnRpYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOnJla29uIiwicm9sZTpkaXNwYWthdGk6aW5zdGFuc2k6dHRlIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6a3A6b3BlcmF0b3IiLCJyb2xlOm1hbmFqZW1lbi13czpkZXZlbG9wZXIiLCJvZmZsaW5lX2FjY2VzcyIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktb3BlcmF0b3ItcGVtZW51aGFuLWtlYi1wZWdhd2FpIiwidW1hX2F1dGhvcml6YXRpb24iLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOlRURSIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1ldmFqYWIiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbmdhZGFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zb3RrIiwicm9sZTpkaXNwYWthdGk6aW5zdGFuc2k6b3BlcmF0b3IiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbmdhZGFhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVtYmVyaGVudGlhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGk6YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmJhdGFsbmlwOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpza2s6VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTppcGFzbjptb25pdG9yaW5nIiwicm9sZTpzaWFzbi1pbnN0YW5zaTprcDpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktb3BlcmF0b3Itc3RhbmRhci1rb21wLWphYiIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVtYmVyaGVudGlhbjphcHByb3ZhbCIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktcGVuZXRhcGFuLXNvdGsiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlcmVtYWphYW46cGFyYWYiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnByb2ZpbGFzbjp2aWV3cHJvZmlsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpza2s6cGFyYWYiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmFkbWluOmFkbWluIl19LCJyZXNvdXJjZV9hY2Nlc3MiOnsiYWNjb3VudCI6eyJyb2xlcyI6WyJtYW5hZ2UtYWNjb3VudCIsIm1hbmFnZS1hY2NvdW50LWxpbmtzIiwidmlldy1wcm9maWxlIl19fSwic2NvcGUiOiJvcGVuaWQgZW1haWwgcHJvZmlsZSIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwibmFtZSI6IllPR0lFIFBSSUJBREkiLCJwcmVmZXJyZWRfdXNlcm5hbWUiOiIxOTgxMDYxODIwMDgwMTEwMDciLCJnaXZlbl9uYW1lIjoiWU9HSUUiLCJmYW1pbHlfbmFtZSI6IlBSSUJBREkiLCJlbWFpbCI6InlvZ2llLnByaWJhZGlAZ21haWwuY29tIn0.GxDNPz77mEWcIrRmSDHMP2Gm3BiN2VgeFAGcSWVS1krhMR8YMacXNUlJ7NMwl1GygsVuNJ0bFIiEanYIPbwGsJlkKBPMg0drJ-Z138_UciLaNA59xmf3ig10DcwsuNLTfNRgW1mktSGjq1qAgzkoyv4j-qCj7JC010dALdMUlN8R2-xJ8F6OOcu_sCLBonlaZJRtPO9v_r6b1O-kbJE44Mfw-3Od9QewgrLwXyTTYSt_MNWdfOPU_p_PLA829-cmxNd6r-n8FEY2Z5cJYTpUh8TDGnBqHT2D08nWiV6C8tDSIPUsv9ASj73U7siI7IBpXLF51KqKHvch7POyp3Cbiw';

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

      $token = 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJBUWNPM0V3MVBmQV9MQ0FtY2J6YnRLUEhtcWhLS1dRbnZ1VDl0RUs3akc4In0.eyJleHAiOjE2OTg2OTA5MTIsImlhdCI6MTY5ODY0NzcxNCwiYXV0aF90aW1lIjoxNjk4NjQ3NzEyLCJqdGkiOiI2YjU1YzA0OC00MGI0LTQ5ZTItYjRmOC1jNTRkOTg5ZDIzOGYiLCJpc3MiOiJodHRwczovL3Nzby1zaWFzbi5ia24uZ28uaWQvYXV0aC9yZWFsbXMvcHVibGljLXNpYXNuIiwiYXVkIjoiYWNjb3VudCIsInN1YiI6IjcyOTg0MzdiLWVjMTctNGEzNi05N2Q2LTdmYWJjNzMyZjRjOCIsInR5cCI6IkJlYXJlciIsImF6cCI6InNpYXNuLWluc3RhbnNpIiwibm9uY2UiOiI4ZDZlNGQ0My04Nzk3LTQzNDctOWUyNy1iMWM2OTZlNGY1NmYiLCJzZXNzaW9uX3N0YXRlIjoiMWE4MWZlOGItMmExNi00YjliLWIzNWYtMjQ2YjJhYjgwZDFlIiwiYWNyIjoiMSIsImFsbG93ZWQtb3JpZ2lucyI6WyJodHRwczovL3NpYXNuLWluc3RhbnNpLmJrbi5nby5pZCIsImh0dHA6Ly9zaWFzbi1pbnN0YW5zaS5ia24uZ28uaWQiLCJodHRwOi8vbG9jYWxob3N0OjMwMDAiXSwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGk6VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1pbmZvamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlcmVuY2FuYWFuOmluc3RhbnNpLW1vbml0b3ItcGVyZW5jYW5hYW4ta2VwZWdhd2FpYW4iLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbWJlcmhlbnRpYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOnJla29uIiwicm9sZTpkaXNwYWthdGk6aW5zdGFuc2k6dHRlIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6a3A6b3BlcmF0b3IiLCJyb2xlOm1hbmFqZW1lbi13czpkZXZlbG9wZXIiLCJvZmZsaW5lX2FjY2VzcyIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktb3BlcmF0b3ItcGVtZW51aGFuLWtlYi1wZWdhd2FpIiwidW1hX2F1dGhvcml6YXRpb24iLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOlRURSIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1ldmFqYWIiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbmdhZGFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zb3RrIiwicm9sZTpkaXNwYWthdGk6aW5zdGFuc2k6b3BlcmF0b3IiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbmdhZGFhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVtYmVyaGVudGlhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGk6YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmJhdGFsbmlwOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpza2s6VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTppcGFzbjptb25pdG9yaW5nIiwicm9sZTpzaWFzbi1pbnN0YW5zaTprcDpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktb3BlcmF0b3Itc3RhbmRhci1rb21wLWphYiIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVtYmVyaGVudGlhbjphcHByb3ZhbCIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktcGVuZXRhcGFuLXNvdGsiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlcmVtYWphYW46cGFyYWYiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnByb2ZpbGFzbjp2aWV3cHJvZmlsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpza2s6cGFyYWYiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmFkbWluOmFkbWluIl19LCJyZXNvdXJjZV9hY2Nlc3MiOnsiYWNjb3VudCI6eyJyb2xlcyI6WyJtYW5hZ2UtYWNjb3VudCIsIm1hbmFnZS1hY2NvdW50LWxpbmtzIiwidmlldy1wcm9maWxlIl19fSwic2NvcGUiOiJvcGVuaWQgZW1haWwgcHJvZmlsZSIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwibmFtZSI6IllPR0lFIFBSSUJBREkiLCJwcmVmZXJyZWRfdXNlcm5hbWUiOiIxOTgxMDYxODIwMDgwMTEwMDciLCJnaXZlbl9uYW1lIjoiWU9HSUUiLCJmYW1pbHlfbmFtZSI6IlBSSUJBREkiLCJlbWFpbCI6InlvZ2llLnByaWJhZGlAZ21haWwuY29tIn0.GxDNPz77mEWcIrRmSDHMP2Gm3BiN2VgeFAGcSWVS1krhMR8YMacXNUlJ7NMwl1GygsVuNJ0bFIiEanYIPbwGsJlkKBPMg0drJ-Z138_UciLaNA59xmf3ig10DcwsuNLTfNRgW1mktSGjq1qAgzkoyv4j-qCj7JC010dALdMUlN8R2-xJ8F6OOcu_sCLBonlaZJRtPO9v_r6b1O-kbJE44Mfw-3Od9QewgrLwXyTTYSt_MNWdfOPU_p_PLA829-cmxNd6r-n8FEY2Z5cJYTpUh8TDGnBqHT2D08nWiV6C8tDSIPUsv9ASj73U7siI7IBpXLF51KqKHvch7POyp3Cbiw';

      $client = \Config\Services::curlrequest();
      $request = $client->request('POST', 'https://api-siasn.bkn.go.id:8443/admin-instansi/api/AddUser/New-Step2', [
                          'form_params' => [
                              'id' => $id,
                              'layanan_id' => 16,
                              'group_id' => 5,
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
