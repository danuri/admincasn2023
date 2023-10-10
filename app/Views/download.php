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
                        <td>2023-10-09 10:25:00 WIB</td>
                        <td><a href="<?= site_url('downloads/pelamar')?>" class="btn btn-sm btn-primary">Download</a></td>
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
