<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Download Data</h4>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive table-card">
                  <table class="table align-middle table-nowrap table-striped-columns mb-0">
                    <thead>
                      <tr>
                        <th>Data</th>
                        <th>Keterangan</th>
                        <th>Download</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Data Pelamar</td>
                        <td><?= get_option('data_pelamar')?></td>
                        <td><a href="<?= site_url('downloads/pelamar')?>" class="btn btn-sm btn-primary">Download</a></td>
                      </tr>
                      <tr>
                        <td>Data Pelamar Sanggah</td>
                        <td>Data ringkas</td>
                        <td><a href="<?= site_url('downloads/sanggah')?>" class="btn btn-sm btn-primary">Download</a></td>
                      </tr>
                      <tr>
                        <td>Jadwal SKD CPNS</td>
                        <td>Dapat diunduh oleh Admin Kanwil</td>
                        <td><a href="<?= site_url('downloads/jadwalskd')?>" class="btn btn-sm btn-primary">Download</a></td>
                      </tr>
                      <tr>
                        <td>Jadwal SK PPPK</td>
                        <td>Dapat diunduh oleh Admin Kanwil</td>
                        <td><a href="<?= site_url('downloads/jadwalsk')?>" class="btn btn-sm btn-primary">Download</a></td>
                      </tr>
                      <tr>
                        <td>Jadwal SK CPNS & PPPK Internal</td>
                        <td>Peserta yang mendaftar pada <?= session('lokasi_nama')?></td>
                        <td><a href="<?= site_url('downloads/jadwalsksatker')?>" class="btn btn-sm btn-primary">Download</a></td>
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
