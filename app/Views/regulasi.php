<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Regulasi</h4>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table align-middle table-striped-columns mb-0 datatable">
                    <thead>
                      <tr>
                        <th>Regulasi</th>
                        <th>Tentang</th>
                        <th>Download</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Surat Plt. Ka BKN Nomor 8871/B-KS.04.01/SD/K/2023</td>
                        <td>Jadwal Pelaksanaan Seleksi CASN Tahun Anggaran 2023</td>
                        <td><a href="<?= base_url('download/jadwalpelaksanaan.pdf')?>" target="_blank">Download</a></td>
                      </tr>
                      <tr>
                        <td>Kepmen PAN RB Nomor 648 Tahun 2023</td>
                        <td>Mekanisme Seleksi Pegawai Pemerintah Dengan Perjanjian Kerja Untuk Jabatan Fungsional Tahun Anggaran 2023</td>
                        <td><a href="https://jdih.menpan.go.id/dokumen-hukum/KEPMEN/jenis/1762?KEPUTUSAN%20MENTERI" target="_blank">Download</a></td>
                      </tr>
                      <tr>
                        <td>Kepmen PAN RB Nomor 650 Tahun 2023</td>
                        <td>Persyaratan Wajib Tambahan dan Sertifikasi Kompetensi Sebagai Penambahan Nilai Seleksi Kompetensi Teknis Dalam Pengadaan Pegawai Pemerintah Dengan Perjanjian Kerja Untuk Jabatan Fungsional</td>
                        <td><a href="https://jdih.menpan.go.id/dokumen-hukum/KEPMEN/jenis/1765?KEPUTUSAN%20MENTERI" target="_blank">Download</a></td>
                      </tr>
                      <tr>
                        <td>Kepmen PAN RB Nomor 651 Tahun 2023</td>
                        <td>Nilai Ambang Batas Seleksi Kompetensi Dasar Pengadaan Pegawai Negeri Sipil Tahun Anggaran 2023</td>
                        <td><a href="https://jdih.menpan.go.id/dokumen-hukum/KEPMEN/jenis/1764?KEPUTUSAN%20MENTERI" target="_blank">Download</a></td>
                      </tr>
                      <tr>
                        <td>Kepmen PAN RB Nomor 652 Tahun 2023</td>
                        <td>Nilai Ambang Batas Sekesi Kompetensi Pengadaan Pegawai Pemerintah Dengan Perjanjian Kerja Untuk Jabatan Fungsional Tahun Anggaran 2023</td>
                        <td><a href="https://jdih.menpan.go.id/dokumen-hukum/KEPMEN/jenis/1766?KEPUTUSAN%20MENTERI" target="_blank">Download</a></td>
                      </tr>
                      <tr>
                        <td>Kepmen PAN RB Nomor 653 Tahun 2023</td>
                        <td>Nilai Ambang Batas Sekesi Kompetensi Pengadaan Pegawai Pemerintah Dengan Perjanjian Kerja Untuk Jabatan Fungsional Dosen Tahun Anggaran 2023</td>
                        <td><a href="https://jdih.menpan.go.id/dokumen-hukum/KEPMEN/jenis/1767?KEPUTUSAN%20MENTERI" target="_blank">Download</a></td>
                      </tr>
                      <tr>
                        <td>Kepmen PAN RB Nomor 654 Tahun 2023</td>
                        <td>Persyaratan Surat Tanda Registrasi Untuk Melamar Pada Jabatan Fungsional Kesehatan Dalam Pengadaan Pegawai Pemerintah Dengan Perjanjian Kerja Tahun Anggaran 2023</td>
                        <td><a href="https://jdih.menpan.go.id/dokumen-hukum/KEPMEN/jenis/1768?KEPUTUSAN%20MENTERI" target="_blank">Download</a></td>
                      </tr>
                      <tr>
                        <td>Juklak CPNS Kemenag 2023 (Draft)</td>
                        <td>Password: casnkemenag2023</td>
                        <td><a href="<?= base_url('download/RKSJ JUKLAK CPNS KEMENAG 2023 Draft.pdf')?>" class="btn btn-sm btn-primary">Download</a></td>
                      </tr>
                      <tr>
                        <td>Juklak PPPK Kemenag 2023 (Draft)</td>
                        <td>Password: casnkemenag2023</td>
                        <td><a href="<?= base_url('download/RKSJ JUKLAK PPPK 2023 Draft.pdf')?>" class="btn btn-sm btn-primary">Download</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>
