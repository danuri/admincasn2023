<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Cek Non ASN</h4>
                </div>
            </div>
        </div>

        <div class="row">
          <p>Pengecekan menggunakan database pada periode "Pendataan Non ASN 2022"</p>
          <div class="col-xl-4">
            <div class="card border card-border-danger">
              <div class="card-body text-center">
                <h4 class="card-title mb-0 flex-grow-1">Masukan NIK</h4>
                <div class="row justify-content-md-center">
                  <div class="col-md-auto">
                    <form id="uploadForm" action="" method="post">
                      <div class="mb-3">
                        <input type="number" class="form-control" id="nik" name="nik" value="">
                      </div>
                      <input type="submit" name="submit" value="Cari" class="btn btn-primary">
                    </form>
                  </div>
                </div>
                <?php if(session()->getFlashdata('message')){
                  echo '<p class="text-danger">'.session()->getFlashdata('message').'</p>';
                } ?>
              </div>
            </div>
          </div>
          <div class="col-xl-8">
            <?php if($pegawai){ ?>
            <div class="card">
              <div class="card-body">
                <form class="" action="" method="post">
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="nameInput" class="form-label">NIK</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->NIK?>" readonly>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="nameInput" class="form-label">NAMA</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->NAMA?>" readonly>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="nameInput" class="form-label">TANGGAL LAHIR</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->TGL_LAHIR?>" readonly>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="nameInput" class="form-label">LOKASI</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->satker?>" readonly>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="nameInput" class="form-label">JABATAN SK</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->JABATAN_SK?>" readonly>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="nameInput" class="form-label">AWAL KERJA</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->TGL_AWAL_KERJA?>" readonly>
                      </div>
                  </div>
                </form>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>
