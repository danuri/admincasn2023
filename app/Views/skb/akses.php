<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-12">
              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0">Akses Penguji</h4>

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
                    <th>NIP</th>
                    <th>NAMA</th>
                    <th>JENIS</th>
                    <th>USERNAME</th>
                    <th>PASSWORD</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($akses as $row) {?>
                    <tr>
                      <td><?= $row->nip?></td>
                      <td><?= $row->nama?></td>
                      <td><?= ($row->ujian == 'praker')?'Praktek Kerja':'Wawancara';?></td>
                      <td><?= ($row->ujian == 'praker')?'praker_':'interview_';?><?= $row->username?></td>
                      <td>kemenag2023</td>
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
