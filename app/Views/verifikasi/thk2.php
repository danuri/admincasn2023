<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Cek Validasi Eks THK-II</h4>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-xl-4">
            <div class="card border card-border-danger">
              <div class="card-body text-center">
                <h4 class="card-title mb-0 flex-grow-1">Masukan Nomor Peserta</h4>
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
                          <label for="nameInput" class="form-label">NAMA</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->NAMA?>" readonly>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="nameInput" class="form-label">NOMOR PESERTA</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->NO_PESERTA?>" readonly>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="nameInput" class="form-label">TANGGAL LAHIR</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->TANGGAL_LAHIR?>" readonly>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="nameInput" class="form-label">KELOMPOK</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->KELOMPOK?>" readonly>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="nameInput" class="form-label">STATUS THK2</label>
                      </div>
                      <div class="col-lg-9">
                        <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->STATUS_THK2?>" readonly>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="nameInput" class="form-label">JABATAN</label>
                      </div>
                      <div class="col-lg-9">
                        <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->JABATAN?>" readonly>
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
