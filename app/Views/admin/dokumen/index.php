<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dokumen Unggahan</h4>
                    <div class="page-title-right">
                        <a href="javascript: void(0);" class="btn btn-primary">Tambah Dokumen</a>
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
                        <th>DOKUMEN</th>
                        <th>KETERANGAN</th>
                        <th>DIBUAT TANGGAL</th>
                        <th>OPSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($dokumen as $row) {?>
                      <tr>
                        <td><?= $row->dokumen?></td>
                        <td><?= $row->keterangan?></td>
                        <td><?= $row->created_at?></td>
                        <td><a href="" class="btn btn-sm btn-primary">Unggahan</a> <a href="" class="btn btn-sm btn-success">Edit</a> <a href="" class="btn btn-sm btn-danger" onclick="return confirm('Dokumen akan dihapus?')">Delete</a></td>
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
