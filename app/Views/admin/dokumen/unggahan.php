<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Unggahan Dokumen ""<?= $dokumen->dokumen?>""</h4>
                    <div class="page-title-right">
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
                        <th>KODE LOKASI</th>
                        <th>LOKASI</th>
                        <th>LAMPIRAN</th>
                        <th>OPSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($unggahan as $row) {?>
                      <tr>
                        <td><?= $row->kode_bkn?></td>
                        <td><?= $row->nama?></td>
                        <?php if($row->attachment){ ?>
                        <td><a href="https://docu.kemenag.go.id:9000/sscasn/2023/<?= $row->attachment;?>" target="_blank" class="btn btn-sm btn-primary">Lihat</a></td>
                        <td><a href="<?= site_url('admin/dokumen/deleteunggahan/'.$row->idattachment)?>" class="btn btn-sm btn-danger" onclick="return confirm('Dokumen akan dihapus?')">Delete</a></td>
                      <?php }else{ ?>
                        <td>Belum Mengunggah</td>
                        <td></td>
                      <?php } ?>
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
