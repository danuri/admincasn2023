<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Upload Dokumen</h4>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Daftar Unggah Dokumen</h4>
                <div class="flex-shrink-0">
                  <button type="button" name="button" class="btn btn-primary">Upload Dokumen</button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive table-card">
                  <table class="table align-middle table-nowrap table-striped-columns mb-0">
                    <thead>
                      <tr>
                        <th>Dokumen</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Lihat</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
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
