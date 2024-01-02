<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">FAQ</h4>
                    <div class="page-title-right">
                        <a href="<?= site_url('faqs/add')?>" class="btn btn-primary">Tambah Faq</a>
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
                        <th>Category</th>
                        <th>Pertanyaan</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($faqs as $row) {?>
                      <tr>
                        <td><?= $row->category?></td>
                        <td><?= $row->question?></td>
                        <td><?= $row->created_by?></td>
                        <td><?= $row->created_at?></td>
                        <td><a href="<?= site_url('admin/faq/edit/'.$row->id)?>" class="btn btn-sm btn-primary">Edit</a> <a href="" class="btn btn-sm btn-danger" onclick="return confirm('Faq akan dihapus?')">Delete</a></td>
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
