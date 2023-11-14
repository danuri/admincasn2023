<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\CrudModel;

class Download extends BaseController
{
    public function index()
    {
        return view('download');
    }

    public function pelamar()
    {
      $model = new CrudModel();
      $nonasn = $model->getResult('pelamar',['lokasi_kode'=>session('lokasi')]);

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setCellValue('A1', 'remark');
      $sheet->setCellValue('B1', 'nik');
      $sheet->setCellValue('C1', 'no_register');
      $sheet->setCellValue('D1', 'no_peserta');
      $sheet->setCellValue('E1', 'tgl_daftar');
      $sheet->setCellValue('F1', 'nama_ktp');
      $sheet->setCellValue('G1', 'tempat_lahir_ktp');
      $sheet->setCellValue('H1', 'tgl_lahir_ktp');
      $sheet->setCellValue('I1', 'gelar_depan_ijazah');
      $sheet->setCellValue('J1', 'nama_ijazah');
      $sheet->setCellValue('K1', 'gelar_belakang_ijazah');
      $sheet->setCellValue('L1', 'tempat_lahir_ijazah');
      $sheet->setCellValue('M1', 'tgl_lahir_ijazah');
      $sheet->setCellValue('N1', 'jenis_kelamin');
      $sheet->setCellValue('O1', 'agama');
      $sheet->setCellValue('P1', 'jenis_disabilitas');
      $sheet->setCellValue('Q1', 'link_disabilitas');
      $sheet->setCellValue('R1', 'alamat_domisili');
      $sheet->setCellValue('S1', 'kabkota_domisili');
      $sheet->setCellValue('T1', 'provinsi_domisili');
      $sheet->setCellValue('U1', 'lembaga_pendidikan');
      $sheet->setCellValue('V1', 'prodi');
      $sheet->setCellValue('W1', 'no_ijazah');
      $sheet->setCellValue('X1', 'tgl_ijazah');
      $sheet->setCellValue('Y1', 'tahun_lulus');
      $sheet->setCellValue('Z1', 'akreditasi_lembaga');
      $sheet->setCellValue('AA1', 'akreditasi_prodi');
      $sheet->setCellValue('AB1', 'ipk_nilai');
      $sheet->setCellValue('AC1', 'jabatan_kode');
      $sheet->setCellValue('AD1', 'jabatan_nama');
      $sheet->setCellValue('AE1', 'lokasi_kode');
      $sheet->setCellValue('AF1', 'lokasi_nama');
      $sheet->setCellValue('AG1', 'jenis_formasi');
      $sheet->setCellValue('AH1', 'pendidikan_kode');
      $sheet->setCellValue('AI1', 'pendidikan_nama');
      $sheet->setCellValue('AJ1', 'lokasi_ujian_id');
      $sheet->setCellValue('AK1', 'lokasi_ujian_nama');
      $sheet->setCellValue('AL1', 'lokasi_ujian_luar_negeri_id');
      $sheet->setCellValue('AM1', 'lokasi_ujian_luar_negeri_nama');
      $sheet->setCellValue('AN1', 'email');
      $sheet->setCellValue('AO1', 'pt_dikti');
      $sheet->setCellValue('AP1', 'prodi_dikti');
      $sheet->setCellValue('AQ1', 'status_verifikasi');
      $sheet->setCellValue('AR1', 'alasan_tms');
      $sheet->setCellValue('AS1', 'alasan_tms_dokumen');
      $sheet->setCellValue('AT1', 'tanggal_verifikasi');
      $sheet->setCellValue('AU1', 'verifikator_username');
      $sheet->setCellValue('AV1', 'verifikator_nama');
      $sheet->setCellValue('AW1', 'supervisor_username');
      $sheet->setCellValue('AX1', 'supervisor_nama');
      $sheet->setCellValue('AY1', 'tanggal_supervisi');
      $sheet->setCellValue('AZ1', 'lokasi_ujian_skb_id');
      $sheet->setCellValue('BA1', 'lokasi_ujian_skb_nama');
      $sheet->setCellValue('BB1', 'lokasi_ujian_skb_luar_negeri_id');
      $sheet->setCellValue('BC1', 'lokasi_ujian_skb_luar_negeri_nama');
      $sheet->setCellValue('BD1', 'bahasa_ujian_diplomat');
      $sheet->setCellValue('BE1', 'no_thk2');
      $sheet->setCellValue('BF1', 'jenis');

      $i = 2;
      foreach ($nonasn as $row) {
        $sheet->setCellValue('A'.$i, '');
        $sheet->getCell('B'.$i)->setValueExplicit($row->nik,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2);
        $sheet->getCell('C'.$i)->setValueExplicit($row->no_register,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2);
        $sheet->getCell('D'.$i)->setValueExplicit($row->no_peserta,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2);
        $sheet->setCellValue('E'.$i, $row->tgl_daftar);
        $sheet->setCellValue('F'.$i, $row->nama_ktp);
        $sheet->setCellValue('G'.$i, $row->tempat_lahir_ktp);
        $sheet->setCellValue('H'.$i, $row->tgl_lahir_ktp);
        $sheet->setCellValue('I'.$i, $row->gelar_depan_ijazah);
        $sheet->setCellValue('J'.$i, $row->nama_ijazah);
        $sheet->setCellValue('K'.$i, $row->gelar_belakang_ijazah);
        $sheet->setCellValue('L'.$i, $row->tempat_lahir_ijazah);
        $sheet->setCellValue('M'.$i, $row->tgl_lahir_ijazah);
        $sheet->setCellValue('N'.$i, $row->jenis_kelamin);
        $sheet->setCellValue('O'.$i, $row->agama);
        $sheet->setCellValue('P'.$i, $row->jenis_disabilitas);
        $sheet->setCellValue('Q'.$i, $row->link_disabilitas);
        $sheet->setCellValue('R'.$i, $row->alamat_domisili);
        $sheet->setCellValue('S'.$i, $row->kabkota_domisili);
        $sheet->setCellValue('T'.$i, $row->provinsi_domisili);
        $sheet->setCellValue('U'.$i, $row->lembaga_pendidikan);
        $sheet->setCellValue('V'.$i, $row->prodi);
        $sheet->setCellValue('W'.$i, $row->no_ijazah);
        $sheet->setCellValue('X'.$i, $row->tgl_ijazah);
        $sheet->setCellValue('Y'.$i, $row->tahun_lulus);
        $sheet->setCellValue('Z'.$i, $row->akreditasi_lembaga);
        $sheet->setCellValue('AA'.$i, $row->akreditasi_prodi);
        $sheet->setCellValue('AB'.$i, $row->ipk_nilai);
        $sheet->setCellValue('AC'.$i, $row->jabatan_kode);
        $sheet->setCellValue('AD'.$i, $row->jabatan_nama);
        $sheet->setCellValue('AE'.$i, $row->lokasi_kode);
        $sheet->setCellValue('AF'.$i, $row->lokasi_nama);
        $sheet->setCellValue('AG'.$i, $row->jenis_formasi);
        $sheet->setCellValue('AH'.$i, $row->pendidikan_kode);
        $sheet->setCellValue('AI'.$i, $row->pendidikan_nama);
        $sheet->setCellValue('AJ'.$i, $row->lokasi_ujian_id);
        $sheet->setCellValue('AK'.$i, $row->lokasi_ujian_nama);
        $sheet->setCellValue('AL'.$i, $row->lokasi_ujian_luar_negeri_id);
        $sheet->setCellValue('AM'.$i, $row->lokasi_ujian_luar_negeri_nama);
        $sheet->setCellValue('AN'.$i, $row->email);
        $sheet->setCellValue('AO'.$i, $row->pt_dikti);
        $sheet->setCellValue('AP'.$i, $row->prodi_dikti);
        $sheet->setCellValue('AQ'.$i, $row->status_verifikasi);
        $sheet->setCellValue('AR'.$i, $row->alasan_tms);
        $sheet->setCellValue('AS'.$i, $row->alasan_tms_dokumen);
        $sheet->setCellValue('AT'.$i, $row->tanggal_verifikasi);
        $sheet->setCellValue('AU'.$i, $row->verifikator_username);
        $sheet->setCellValue('AV'.$i, $row->verifikator_nama);
        $sheet->setCellValue('AW'.$i, $row->supervisor_username);
        $sheet->setCellValue('AX'.$i, $row->supervisor_nama);
        $sheet->setCellValue('AY'.$i, $row->tanggal_supervisi);
        $sheet->setCellValue('AZ'.$i, $row->lokasi_ujian_skb_id);
        $sheet->setCellValue('BA'.$i, $row->lokasi_ujian_skb_nama);
        $sheet->setCellValue('BB'.$i, $row->lokasi_ujian_skb_luar_negeri_id);
        $sheet->setCellValue('BC'.$i, $row->lokasi_ujian_skb_luar_negeri_nama);
        $sheet->setCellValue('BD'.$i, $row->bahasa_ujian_diplomat);
        $sheet->setCellValue('BE'.$i, $row->no_thk2);
        $sheet->setCellValue('BF'.$i, $row->jenis);

        $i++;
      }

      $writer = new Xlsx($spreadsheet);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Data_Pelamar.xlsx"');
      $writer->save('php://output');
      exit();
    }

    public function sanggah()
    {
      $model = new CrudModel();
      $nonasn = $model->getResult('pelamar',['lokasi_kode'=>session('lokasi'),'is_sanggah'=>1]);

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setCellValue('A1', 'nik');
      $sheet->setCellValue('B1', 'nama_ijazah');
      $sheet->setCellValue('C1', 'jabatan_nama');
      $sheet->setCellValue('D1', 'jenis_formasi');
      $sheet->setCellValue('E1', 'jenis');
      $sheet->setCellValue('F1', 'pasca_sanggah');

      $i = 2;
      foreach ($nonasn as $row) {
        $sheet->getCell('A'.$i)->setValueExplicit($row->nik,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2);
        $sheet->setCellValue('B'.$i, $row->nama_ijazah);
        $sheet->setCellValue('C'.$i, $row->jabatan_nama);
        $sheet->setCellValue('D'.$i, $row->jenis_formasi);
        $sheet->setCellValue('E'.$i, $row->jenis);
        $sheet->setCellValue('F'.$i, $row->pasca_sanggah);

        $i++;
      }

      $writer = new Xlsx($spreadsheet);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Data_Pelamar_Sanggah.xlsx"');
      $writer->save('php://output');
      exit();
    }

    public function jadwalskd()
    {
      $model = new CrudModel();
      $nonasn = $model->getResult('temp_jadwal_sk',['kode_lokasi'=>session('lokasi'),'jenis'=>'cpns']);

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setCellValue('A1', 'nomor_peserta');
      $sheet->setCellValue('B1', 'nama');
      $sheet->setCellValue('C1', 'lokasi');
      $sheet->setCellValue('D1', 'hari');
      $sheet->setCellValue('E1', 'tanggal');
      $sheet->setCellValue('F1', 'sesi');

      $i = 2;
      foreach ($nonasn as $row) {
        $sheet->getCell('A'.$i)->setValueExplicit($row->nomor_peserta,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2);
        $sheet->setCellValue('B'.$i, $row->nama);
        $sheet->setCellValue('C'.$i, $row->lokasi);
        $sheet->setCellValue('D'.$i, $row->hari);
        $sheet->setCellValue('E'.$i, $row->tanggal);
        $sheet->setCellValue('F'.$i, $row->sesi);

        $i++;
      }

      $writer = new Xlsx($spreadsheet);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Jadwal_SKD_CPNS.xlsx"');
      $writer->save('php://output');
      exit();
    }

    public function jadwalsk()
    {
      $model = new CrudModel();
      $nonasn = $model->getResult('temp_jadwal_sk',['kode_lokasi'=>session('lokasi'),'jenis'=>'pppk']);

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setCellValue('A1', 'nomor_peserta');
      $sheet->setCellValue('B1', 'nama');
      $sheet->setCellValue('C1', 'lokasi');
      $sheet->setCellValue('D1', 'hari');
      $sheet->setCellValue('E1', 'tanggal');
      $sheet->setCellValue('F1', 'sesi');

      $i = 2;
      foreach ($nonasn as $row) {
        $sheet->getCell('A'.$i)->setValueExplicit($row->nomor_peserta,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2);
        $sheet->setCellValue('B'.$i, $row->nama);
        $sheet->setCellValue('C'.$i, $row->lokasi);
        $sheet->setCellValue('D'.$i, $row->hari);
        $sheet->setCellValue('E'.$i, $row->tanggal);
        $sheet->setCellValue('F'.$i, $row->sesi);

        $i++;
      }

      $writer = new Xlsx($spreadsheet);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Jadwal_SK_PPPK.xlsx"');
      $writer->save('php://output');
      exit();
    }

    public function jadwalsksatker()
    {
      $model = new CrudModel();
      $nonasn = $model->getResult('temp_jadwal_sk',['lokasi_formasi'=>session('lokasi')]);

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setCellValue('A1', 'nomor_peserta');
      $sheet->setCellValue('B1', 'nama');
      $sheet->setCellValue('C1', 'lokasi');
      $sheet->setCellValue('D1', 'hari');
      $sheet->setCellValue('E1', 'tanggal');
      $sheet->setCellValue('F1', 'sesi');
      $sheet->setCellValue('G1', 'jenis');

      $i = 2;
      foreach ($nonasn as $row) {
        $sheet->getCell('A'.$i)->setValueExplicit($row->nomor_peserta,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2);
        $sheet->setCellValue('B'.$i, $row->nama);
        $sheet->setCellValue('C'.$i, $row->lokasi);
        $sheet->setCellValue('D'.$i, $row->hari);
        $sheet->setCellValue('E'.$i, $row->tanggal);
        $sheet->setCellValue('F'.$i, $row->sesi);
        $sheet->setCellValue('G'.$i, $row->jenis);

        $i++;
      }

      $writer = new Xlsx($spreadsheet);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Jadwal_SK.xlsx"');
      $writer->save('php://output');
      exit();
    }
}
