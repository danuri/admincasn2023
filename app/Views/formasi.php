<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Formasi</h4>
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
                        <th>Jenis</th>
                        <th>Jabatan</th>
                        <th>Jenis Formasi</th>
                        <th>Pendidikan</th>
                        <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($formasi as $row) {?>
                      <tr>
                        <td><?= $row->pengadaan?></td>
                        <td><?= $row->jabatan?></td>
                        <td><?= $row->jenis_formasi?></td>
                        <td><?= $row->nama_pendidikan?></td>
                        <td><?= $row->jumlah?></td>
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
