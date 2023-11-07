<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelamarModel;

class Siasn extends BaseController
{
    public function role()
    {
        $pegawai = ['197906272005011008','197806172009012006','198209262009012013','198510022011011006','198204042009012010','198310232014112003','198107292009012011','198410202011012017','197006172006041001','197512032006041001','198808132020121004','199601192020121011','198401102011011010'];

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
      $token = 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJBUWNPM0V3MVBmQV9MQ0FtY2J6YnRLUEhtcWhLS1dRbnZ1VDl0RUs3akc4In0.eyJleHAiOjE2OTg3ODYwNTEsImlhdCI6MTY5ODc0Mjg1MSwiYXV0aF90aW1lIjoxNjk4NzQyODUxLCJqdGkiOiI5MmM4ODQxOS03YmQ3LTQxZWYtOTZmMi05OWI1ZWE3NmM0OGYiLCJpc3MiOiJodHRwczovL3Nzby1zaWFzbi5ia24uZ28uaWQvYXV0aC9yZWFsbXMvcHVibGljLXNpYXNuIiwiYXVkIjoiYWNjb3VudCIsInN1YiI6IjcyOTg0MzdiLWVjMTctNGEzNi05N2Q2LTdmYWJjNzMyZjRjOCIsInR5cCI6IkJlYXJlciIsImF6cCI6InNpYXNuLWluc3RhbnNpIiwibm9uY2UiOiIxOGQ4NjRlYy03YzBiLTRjZjktOTZkYS02MDNjY2ZlYWRjNjAiLCJzZXNzaW9uX3N0YXRlIjoiMWQyMTI5YzktMjViMC00NWYzLWJhZjctNGI5YWEwOWZhZWI4IiwiYWNyIjoiMSIsImFsbG93ZWQtb3JpZ2lucyI6WyJodHRwczovL3NpYXNuLWluc3RhbnNpLmJrbi5nby5pZCIsImh0dHA6Ly9zaWFzbi1pbnN0YW5zaS5ia24uZ28uaWQiLCJodHRwOi8vbG9jYWxob3N0OjMwMDAiXSwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGk6VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1pbmZvamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlcmVuY2FuYWFuOmluc3RhbnNpLW1vbml0b3ItcGVyZW5jYW5hYW4ta2VwZWdhd2FpYW4iLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbWJlcmhlbnRpYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOnJla29uIiwicm9sZTpkaXNwYWthdGk6aW5zdGFuc2k6dHRlIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6a3A6b3BlcmF0b3IiLCJyb2xlOmRhc2hib2FyZC1rZWJpamFrYW46aW5zdGFuc2kiLCJyb2xlOm1hbmFqZW1lbi13czpkZXZlbG9wZXIiLCJvZmZsaW5lX2FjY2VzcyIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktb3BlcmF0b3ItcGVtZW51aGFuLWtlYi1wZWdhd2FpIiwidW1hX2F1dGhvcml6YXRpb24iLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOlRURSIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1ldmFqYWIiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbmdhZGFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zb3RrIiwicm9sZTpkYXNoYm9hcmQtb3BlcmFzaW9uYWw6aW5zdGFuc2kiLCJyb2xlOmRpc3Bha2F0aTppbnN0YW5zaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVuZ2FkYWFuOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTphcHByb3ZhbCIsInJvbGU6c2lhc24taW5zdGFuc2k6YmF0YWxuaXA6YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnNrazpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmlwYXNuOm1vbml0b3JpbmciLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zdGFuZGFyLWtvbXAtamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1wZW5ldGFwYW4tc290ayIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6cHJvZmlsYXNuOnZpZXdwcm9maWwiLCJyb2xlOmRhc2hib2FyZC1vcGVyYXNpb25hbDppbnN0YW5zaS1waW1waW5hbiIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVtYmVyaGVudGlhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTphZG1pbjphZG1pbiJdfSwicmVzb3VyY2VfYWNjZXNzIjp7ImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJtYW5hZ2UtYWNjb3VudC1saW5rcyIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoib3BlbmlkIGVtYWlsIHByb2ZpbGUiLCJlbWFpbF92ZXJpZmllZCI6ZmFsc2UsIm5hbWUiOiJZT0dJRSBQUklCQURJIiwicHJlZmVycmVkX3VzZXJuYW1lIjoiMTk4MTA2MTgyMDA4MDExMDA3IiwiZ2l2ZW5fbmFtZSI6IllPR0lFIiwiZmFtaWx5X25hbWUiOiJQUklCQURJIiwiZW1haWwiOiJ5b2dpZS5wcmliYWRpQGdtYWlsLmNvbSJ9.GkdA1FyZ2Y7KNmYBvTSpXj30Vp137Q5Sn-OTkNt70WaowBHNZ9PthmjkJtr3TlykA_VJdTX2SeVnBeRKDYhUczK9-bj8hIruackb0LNeKku2zDG5TJG2YyTc42Qme63LLnRJYIrl7ZyliQqCq43-P5fOewa4hnYjR9PuUXpPfQBGmqvyPIkK9eHmGzSy8m1M5kmbBUclqxGVrJJCgGU6IF8HLM-Wu2GUGE2gCLoGipjmehDhX8kewBXaI7tmWcC0huxw5CWJEEbfU4zXl9Q3KkUwnRvxlFeqEOfW0TF29P-d4Na2VOi-gxqBLAWRTIckxsFzZeo40_a5u1tg_iDZQQ';

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
      $token = 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJBUWNPM0V3MVBmQV9MQ0FtY2J6YnRLUEhtcWhLS1dRbnZ1VDl0RUs3akc4In0.eyJleHAiOjE2OTg3ODYwNTEsImlhdCI6MTY5ODc0Mjg1MSwiYXV0aF90aW1lIjoxNjk4NzQyODUxLCJqdGkiOiI5MmM4ODQxOS03YmQ3LTQxZWYtOTZmMi05OWI1ZWE3NmM0OGYiLCJpc3MiOiJodHRwczovL3Nzby1zaWFzbi5ia24uZ28uaWQvYXV0aC9yZWFsbXMvcHVibGljLXNpYXNuIiwiYXVkIjoiYWNjb3VudCIsInN1YiI6IjcyOTg0MzdiLWVjMTctNGEzNi05N2Q2LTdmYWJjNzMyZjRjOCIsInR5cCI6IkJlYXJlciIsImF6cCI6InNpYXNuLWluc3RhbnNpIiwibm9uY2UiOiIxOGQ4NjRlYy03YzBiLTRjZjktOTZkYS02MDNjY2ZlYWRjNjAiLCJzZXNzaW9uX3N0YXRlIjoiMWQyMTI5YzktMjViMC00NWYzLWJhZjctNGI5YWEwOWZhZWI4IiwiYWNyIjoiMSIsImFsbG93ZWQtb3JpZ2lucyI6WyJodHRwczovL3NpYXNuLWluc3RhbnNpLmJrbi5nby5pZCIsImh0dHA6Ly9zaWFzbi1pbnN0YW5zaS5ia24uZ28uaWQiLCJodHRwOi8vbG9jYWxob3N0OjMwMDAiXSwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGk6VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1pbmZvamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlcmVuY2FuYWFuOmluc3RhbnNpLW1vbml0b3ItcGVyZW5jYW5hYW4ta2VwZWdhd2FpYW4iLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbWJlcmhlbnRpYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOnJla29uIiwicm9sZTpkaXNwYWthdGk6aW5zdGFuc2k6dHRlIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6a3A6b3BlcmF0b3IiLCJyb2xlOmRhc2hib2FyZC1rZWJpamFrYW46aW5zdGFuc2kiLCJyb2xlOm1hbmFqZW1lbi13czpkZXZlbG9wZXIiLCJvZmZsaW5lX2FjY2VzcyIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktb3BlcmF0b3ItcGVtZW51aGFuLWtlYi1wZWdhd2FpIiwidW1hX2F1dGhvcml6YXRpb24iLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOlRURSIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1ldmFqYWIiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbmdhZGFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zb3RrIiwicm9sZTpkYXNoYm9hcmQtb3BlcmFzaW9uYWw6aW5zdGFuc2kiLCJyb2xlOmRpc3Bha2F0aTppbnN0YW5zaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVuZ2FkYWFuOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTphcHByb3ZhbCIsInJvbGU6c2lhc24taW5zdGFuc2k6YmF0YWxuaXA6YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnNrazpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmlwYXNuOm1vbml0b3JpbmciLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zdGFuZGFyLWtvbXAtamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1wZW5ldGFwYW4tc290ayIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6cHJvZmlsYXNuOnZpZXdwcm9maWwiLCJyb2xlOmRhc2hib2FyZC1vcGVyYXNpb25hbDppbnN0YW5zaS1waW1waW5hbiIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVtYmVyaGVudGlhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTphZG1pbjphZG1pbiJdfSwicmVzb3VyY2VfYWNjZXNzIjp7ImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJtYW5hZ2UtYWNjb3VudC1saW5rcyIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoib3BlbmlkIGVtYWlsIHByb2ZpbGUiLCJlbWFpbF92ZXJpZmllZCI6ZmFsc2UsIm5hbWUiOiJZT0dJRSBQUklCQURJIiwicHJlZmVycmVkX3VzZXJuYW1lIjoiMTk4MTA2MTgyMDA4MDExMDA3IiwiZ2l2ZW5fbmFtZSI6IllPR0lFIiwiZmFtaWx5X25hbWUiOiJQUklCQURJIiwiZW1haWwiOiJ5b2dpZS5wcmliYWRpQGdtYWlsLmNvbSJ9.GkdA1FyZ2Y7KNmYBvTSpXj30Vp137Q5Sn-OTkNt70WaowBHNZ9PthmjkJtr3TlykA_VJdTX2SeVnBeRKDYhUczK9-bj8hIruackb0LNeKku2zDG5TJG2YyTc42Qme63LLnRJYIrl7ZyliQqCq43-P5fOewa4hnYjR9PuUXpPfQBGmqvyPIkK9eHmGzSy8m1M5kmbBUclqxGVrJJCgGU6IF8HLM-Wu2GUGE2gCLoGipjmehDhX8kewBXaI7tmWcC0huxw5CWJEEbfU4zXl9Q3KkUwnRvxlFeqEOfW0TF29P-d4Na2VOi-gxqBLAWRTIckxsFzZeo40_a5u1tg_iDZQQ';

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

      $token = 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJBUWNPM0V3MVBmQV9MQ0FtY2J6YnRLUEhtcWhLS1dRbnZ1VDl0RUs3akc4In0.eyJleHAiOjE2OTg3ODYwNTEsImlhdCI6MTY5ODc0Mjg1MSwiYXV0aF90aW1lIjoxNjk4NzQyODUxLCJqdGkiOiI5MmM4ODQxOS03YmQ3LTQxZWYtOTZmMi05OWI1ZWE3NmM0OGYiLCJpc3MiOiJodHRwczovL3Nzby1zaWFzbi5ia24uZ28uaWQvYXV0aC9yZWFsbXMvcHVibGljLXNpYXNuIiwiYXVkIjoiYWNjb3VudCIsInN1YiI6IjcyOTg0MzdiLWVjMTctNGEzNi05N2Q2LTdmYWJjNzMyZjRjOCIsInR5cCI6IkJlYXJlciIsImF6cCI6InNpYXNuLWluc3RhbnNpIiwibm9uY2UiOiIxOGQ4NjRlYy03YzBiLTRjZjktOTZkYS02MDNjY2ZlYWRjNjAiLCJzZXNzaW9uX3N0YXRlIjoiMWQyMTI5YzktMjViMC00NWYzLWJhZjctNGI5YWEwOWZhZWI4IiwiYWNyIjoiMSIsImFsbG93ZWQtb3JpZ2lucyI6WyJodHRwczovL3NpYXNuLWluc3RhbnNpLmJrbi5nby5pZCIsImh0dHA6Ly9zaWFzbi1pbnN0YW5zaS5ia24uZ28uaWQiLCJodHRwOi8vbG9jYWxob3N0OjMwMDAiXSwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGk6VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1pbmZvamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlcmVuY2FuYWFuOmluc3RhbnNpLW1vbml0b3ItcGVyZW5jYW5hYW4ta2VwZWdhd2FpYW4iLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbWJlcmhlbnRpYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW5nYWRhYW46VFRFIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOnJla29uIiwicm9sZTpkaXNwYWthdGk6aW5zdGFuc2k6dHRlIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6a3A6b3BlcmF0b3IiLCJyb2xlOmRhc2hib2FyZC1rZWJpamFrYW46aW5zdGFuc2kiLCJyb2xlOm1hbmFqZW1lbi13czpkZXZlbG9wZXIiLCJvZmZsaW5lX2FjY2VzcyIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW5jYW5hYW46aW5zdGFuc2ktb3BlcmF0b3ItcGVtZW51aGFuLWtlYi1wZWdhd2FpIiwidW1hX2F1dGhvcml6YXRpb24iLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOlRURSIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1ldmFqYWIiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnBlbmdhZGFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbWFqYWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zb3RrIiwicm9sZTpkYXNoYm9hcmQtb3BlcmFzaW9uYWw6aW5zdGFuc2kiLCJyb2xlOmRpc3Bha2F0aTppbnN0YW5zaTpvcGVyYXRvciIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVuZ2FkYWFuOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOm9wZXJhdG9yIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwaTphcHByb3ZhbCIsInJvbGU6c2lhc24taW5zdGFuc2k6YmF0YWxuaXA6YXBwcm92YWwiLCJyb2xlOnNpYXNuLWluc3RhbnNpOnNrazpUVEUiLCJyb2xlOnNpYXNuLWluc3RhbnNpOmlwYXNuOm1vbml0b3JpbmciLCJyb2xlOnNpYXNuLWluc3RhbnNpOmtwOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1vcGVyYXRvci1zdGFuZGFyLWtvbXAtamFiIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZW1iZXJoZW50aWFuOmFwcHJvdmFsIiwicm9sZTpzaWFzbi1pbnN0YW5zaTpwZXJlbmNhbmFhbjppbnN0YW5zaS1wZW5ldGFwYW4tc290ayIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVyZW1hamFhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6cHJvZmlsYXNuOnZpZXdwcm9maWwiLCJyb2xlOmRhc2hib2FyZC1vcGVyYXNpb25hbDppbnN0YW5zaS1waW1waW5hbiIsInJvbGU6c2lhc24taW5zdGFuc2k6cGVtYmVyaGVudGlhbjpwYXJhZiIsInJvbGU6c2lhc24taW5zdGFuc2k6c2trOnBhcmFmIiwicm9sZTpzaWFzbi1pbnN0YW5zaTphZG1pbjphZG1pbiJdfSwicmVzb3VyY2VfYWNjZXNzIjp7ImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJtYW5hZ2UtYWNjb3VudC1saW5rcyIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoib3BlbmlkIGVtYWlsIHByb2ZpbGUiLCJlbWFpbF92ZXJpZmllZCI6ZmFsc2UsIm5hbWUiOiJZT0dJRSBQUklCQURJIiwicHJlZmVycmVkX3VzZXJuYW1lIjoiMTk4MTA2MTgyMDA4MDExMDA3IiwiZ2l2ZW5fbmFtZSI6IllPR0lFIiwiZmFtaWx5X25hbWUiOiJQUklCQURJIiwiZW1haWwiOiJ5b2dpZS5wcmliYWRpQGdtYWlsLmNvbSJ9.GkdA1FyZ2Y7KNmYBvTSpXj30Vp137Q5Sn-OTkNt70WaowBHNZ9PthmjkJtr3TlykA_VJdTX2SeVnBeRKDYhUczK9-bj8hIruackb0LNeKku2zDG5TJG2YyTc42Qme63LLnRJYIrl7ZyliQqCq43-P5fOewa4hnYjR9PuUXpPfQBGmqvyPIkK9eHmGzSy8m1M5kmbBUclqxGVrJJCgGU6IF8HLM-Wu2GUGE2gCLoGipjmehDhX8kewBXaI7tmWcC0huxw5CWJEEbfU4zXl9Q3KkUwnRvxlFeqEOfW0TF29P-d4Na2VOi-gxqBLAWRTIckxsFzZeo40_a5u1tg_iDZQQ';

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
