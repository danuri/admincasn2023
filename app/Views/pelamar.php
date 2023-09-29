<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Statistik Pelamar</h4>
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
                        <th>Jabatan</th>
                        <th>Jenis Formasi</th>
                        <th>Formasi</th>
                        <th>Pendaftar</th>
                        <th>Submit</th>
                        <th>MS</th>
                        <th>TMS</th>
                        <th>Belum Verif</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($stat as $row) {?>
                      <tr>
                        <td><?= $row->jabatan?></td>
                        <td><?= $row->jenis_formasi?></td>
                        <td><?= $row->formasi?></td>
                        <td><?= $row->pendaftar?></td>
                        <td><?= $row->submit?></td>
                        <td><?= $row->ms?></td>
                        <td><?= $row->tms?></td>
                        <td><?= $row->belum_verif?></td>
                      </tr>
                      <?php } ?>
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
