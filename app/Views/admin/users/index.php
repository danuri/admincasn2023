<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Pengguna</h4>
                    <div class="page-title-right">
                        <a href="javascript: void(0);" class="btn btn-primary">Tambah Pengguna Baru</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table id="buttons-datatables" class="display table table-bordered datatable" style="width:100%">
                    <thead>
                      <tr>
                        <th>NIP</th>
                        <th>NAMA</th>
                        <th>LOKASI FORMASI</th>
                        <th>OPSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($users as $row) {?>
                      <tr>
                        <td><?= $row->nip?></td>
                        <td><?= $row->nama?></td>
                        <td><?= $row->nama_satker?></td>
                        <td></td>
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
