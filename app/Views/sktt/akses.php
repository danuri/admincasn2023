<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-12">
              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0">Data Akses Lokasi SKTT</h4>

                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                          <li class="breadcrumb-item active">Lokasi SKTT</li>
                      </ol>
                  </div>

              </div>
          </div>
      </div>

      <div class="row">
        <div class="col-12">

            <div class="card-body table-responsive">
              <table class="table table-bordered" id="DataTable">
                <thead>
                  <tr>
                    <th>Kabupaten/Kota</th>
                    <th>Username</th>
                    <th>Password</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($lokasi as $row) {?>
                    <tr>
                      <td><?= $row->lokasi_ujian?></td>
                      <td><?= $row->username?></td>
                      <td><?= $row->password?></td>
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

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script type="text/javascript">
var siteurl = '<?= site_url()?>';
</script>
<?= $this->endSection() ?>
