<?php

namespace App\Models;

use CodeIgniter\Model;

class SimpegModel extends Model
{
  protected $db;

  public function __construct()
  {
    $this->db = \Config\Database::connect('simpeg', false);

  }

  public function getRow($table,$where)
  {
    $builder = $this->db->table($table);
    $query = $builder->getWhere($where);

    return $query->getRow();
  }

  public function getArray($table,$where=false)
  {
    $builder = $this->db->table($table);

    if($where){
      $query = $builder->getWhere($where);
    }else{
      $query = $builder->get();
    }

    return $query->getResult();
  }

  public function setquery($query)
  {
    $query = $this->db->query($query);
    return $query;
  }

  public function getPegawai($nip)
  {
    $query = $this->db->query("SELECT * FROM TEMP_PEGAWAI WHERE NIP_BARU='$nip'")->getRow();
    return $query;
  }

  public function query_row($query)
  {
    $query = $this->db->query($query)->getRow();
    return $query;
  }

  public function query_array($query)
  {
    $query = $this->db->query($query)->getResult();
    return $query;
  }

  public function getCount($table,$where=false)
  {
    $builder = $this->db->table($table);

    if($where){
      $query = $builder->getWhere($where);
    }else{
      $query = $builder->get();
    }

    return $query->countAllResults();
  }

  public function inserts($table,$param)
  {
    $builder = $this->db->table($table);
    $insert = $builder->insert($param);

    return $insert;
  }

  public function getAuth($nip)
  {
    $query = $this->db->query("exec sp_usermanager @nip='".$nip."', @appid='1'")->getRow();
    return $query;
  }

  public function getInfoKP($year,$month)
  {
    $query = $this->db->query("SELECT SATKER2 AS SATKER, COUNT(*) AS JUMLAH FROM TEMP_PEGAWAI_PANGKAT WHERE TMT_KP <> CAST('$month/01/$year' AS DATE)
                              GROUP BY SATKER2")->getResult();
    return $query;
  }

  public function getCountKP($year,$month)
  {
    $query = $this->db->query("SELECT COUNT(*) AS JUMLAH FROM TEMP_PEGAWAI_PANGKAT
    WHERE TMT_KP <> CAST('$month/01/$year' AS DATE)")->getRow();
    return $query;
  }

  public function getNonasn($kodesatker)
  {
    $query = $this->db->query("SELECT ts.*,satker.KETERANGAN_SATUAN_KERJA FROM TS_USER ts
                              INNER JOIN _vw_list_satker_jabatan_struktural satker
                              ON ts.KODE_UNIT_KERJA=satker.KODE_SATUAN_KERJA
                              WHERE ts.KODE_UNIT_KERJA LIKE '$kodesatker%' AND ts.KETERANGAN='NON PNS'")->getResult();

    return $query;
  }

  public function getsatker($kodesatker)
  {
    $query = $this->db->query("SELECT * FROM TM_SATUAN_KERJA
                              WHERE KODE_SATUAN_KERJA='$kodesatker'")->getResult();

    return $query;
  }

  public function subsatker($kodesatker)
  {
    $query = $this->db->query("SELECT * FROM TM_SATUAN_KERJA
                              WHERE KODE_ATASAN='$kodesatker'")->getResult();

    return $query;
  }

  public function temppegawailat($kodesatker)
  {
    $query = $this->db->query("SELECT * FROM TEMP_PEGAWAI_LATLON
                              WHERE KODE_SATKER='$kodesatker'")->getResult();

    return $query;
  }

  public function updatekoordinat($satker,$lat,$lon)
  {
    $query = $this->db->query("UPDATE TM_SATUAN_KERJA SET LAT='$lat', LON='$lon'
                              WHERE KODE_SATUAN_KERJA='$satker'");

    return $query;
  }

  public function search_pegawai($nip,$satker)
  {
    if(session('role') == 1){
      $query = $this->db->query("SELECT * FROM TEMP_PEGAWAI WHERE NIP_BARU='$nip'");
    }else{
      $query = $this->db->query("SELECT * FROM TEMP_PEGAWAI WHERE NIP_BARU='$nip' AND KODE_SATUAN_KERJA LIKE '$satker%'");
    }
    $result = $query;

    $force = $this->db->query("SELECT * FROM TEMP_PEGAWAI_LATLON WHERE NIP_BARU='$nip'");

    if($force){
      $result = $query;
    }

    return $result->getRow();
  }

  public function gethari($nip)
  {
    $query = $this->db->query("SELECT
                              	TEMP_PEGAWAI.NIP_BARU,
                              	TEMP_PEGAWAI.NAMA_LENGKAP,
                              	TEMP_PEGAWAI.SATKER_2,
                              	TEMP_PEGAWAI.KODE_SATKER_2,
                              	TM_PEGAWAI.HARI_KERJA
                              FROM
                              	dbo.TEMP_PEGAWAI
                              	INNER JOIN
                              	dbo.TM_PEGAWAI
                              	ON
                              		TEMP_PEGAWAI.NIP_BARU = TM_PEGAWAI.NIP_BARU
                              WHERE
                              	TEMP_PEGAWAI.NIP_BARU = '$nip'")->getRow();

    return $query;
  }

  public function updatehari($nip,$hari)
  {
    $query = $this->db->query("UPDATE TM_PEGAWAI SET HARI_KERJA='$hari'
                              WHERE NIP_BARU='$nip'");

    return true;
  }

  public function updateharimasal($kodesatker,$hari)
  {
    $query = $this->db->query("SELECT NIP_BARU FROM TEMP_PEGAWAI WHERE KODE_SATKER_2='$kodesatker'")->getResult();

    foreach ($query as $row) {
      $update = $this->db->query("UPDATE TM_PEGAWAI SET HARI_KERJA='$hari' WHERE NIP_BARU='$row->NIP_BARU'");
    }

    return true;
  }

  function rekapitulasitukin($satker,$tahun,$bulan)
  {
    if(strlen($satker) == 14){
      $query = (object) $this->db->query("SELECT a.NIP,a.NIP_BARU,a.NAMA_LENGKAP,a.GOL_RUANG,a.TAMPIL_JABATAN,a.SATKER_3,a.SATKER_2,b.* FROM TEMP_PEGAWAI a
        LEFT JOIN db_absen..t_rekap_tukin_bulanan b ON b.nip=a.NIP
        WHERE a.KODE_SATUAN_KERJA='$satker' AND b.tahun='$tahun' AND b.bulan='$bulan'")->getResult();
    }else{
      $query = (object) $this->db->query("SELECT a.NIP,a.NIP_BARU,a.NAMA_LENGKAP,a.GOL_RUANG,a.TAMPIL_JABATAN,a.SATKER_3,a.SATKER_2,b.* FROM TEMP_PEGAWAI a
        LEFT JOIN db_absen..t_rekap_tukin_bulanan b ON b.nip=a.NIP
        WHERE a.KODE_SATUAN_KERJA LIKE '$satker%' AND b.tahun='$tahun' AND b.bulan='$bulan'")->getResult();
    }

      return $query;
  }

  function rekapitulasiukan($satker,$tahun,$bulan)
  {
      if(strlen($satker) == 14){
        $query = (object) $this->db->query("SELECT a.NIP,a.NIP_BARU,a.NAMA_LENGKAP,a.GOL_RUANG,a.TAMPIL_JABATAN,a.SATKER_3,a.SATKER_2,a.HARI_KERJA,b.* FROM TEMP_PEGAWAI a
                                          LEFT JOIN db_absen..t_rekap_uang_makan_bulanan b ON b.nip=a.NIP
                                          WHERE a.KODE_SATUAN_KERJA = '$satker' AND b.thn='$tahun' AND b.bln='$bulan'")->getResult();
      }else{
        $query = (object) $this->db->query("SELECT a.NIP,a.NIP_BARU,a.NAMA_LENGKAP,a.GOL_RUANG,a.TAMPIL_JABATAN,a.SATKER_3,a.SATKER_2,a.HARI_KERJA,b.* FROM TEMP_PEGAWAI a
                                          LEFT JOIN db_absen..t_rekap_uang_makan_bulanan b ON b.nip=a.NIP
                                          WHERE a.KODE_SATUAN_KERJA LIKE '$satker%' AND b.thn='$tahun' AND b.bln='$bulan'")->getResult();
      }

      return $query;
  }

  function rekapitulasikehadiran($satker,$tahun,$bulan)
  {
      if(strlen($satker) == 14){
        $query = (object) $this->db->query("SELECT a.NIP,a.NIP_BARU,a.NAMA_LENGKAP,a.GOL_RUANG,a.TAMPIL_JABATAN,a.SATKER_3,a.SATKER_2,a.HARI_KERJA,b.* FROM TEMP_PEGAWAI a
                                          LEFT JOIN db_absen..t_rekap_kehadiran_harian b ON b.nip=a.NIP
                                          WHERE a.KODE_SATUAN_KERJA = '$satker' AND b.tahun='$tahun' AND b.bulan='$bulan' ORDER BY a.NIP_BARU,b.tanggal ASC")->getResult();
      }else{
        $query = (object) $this->db->query("SELECT a.NIP,a.NIP_BARU,a.NAMA_LENGKAP,a.GOL_RUANG,a.TAMPIL_JABATAN,a.SATKER_3,a.SATKER_2,a.HARI_KERJA,b.* FROM TEMP_PEGAWAI a
                                          LEFT JOIN db_absen..t_rekap_kehadiran_harian b ON b.nip=a.NIP
                                          WHERE a.KODE_SATUAN_KERJA LIKE '$satker%' AND b.tahun='$tahun' AND b.bulan='$bulan' ORDER BY a.NIP_BARU,b.tanggal ASC")->getResult();
      }
      return $query;
  }
}
