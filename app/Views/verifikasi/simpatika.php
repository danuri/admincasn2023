<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-sm-0">Cek Validasi SIMPATIKA</h4>
      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
          <li class="breadcrumb-item active">Starter</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-4">
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
  <div class="col-8">

    <?php if($pegawai){ ?>
    <div class="card">
      <div class="card-body">
        <form class="" action="<?= site_url('verifikasi/save')?>" method="post">
          <div class="row mb-3">
              <div class="col-lg-3">
                  <label for="nameInput" class="form-label">NIK</label>
              </div>
              <div class="col-lg-9">
                  <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->nik?>" readonly>
              </div>
          </div>
          <div class="row mb-3">
              <div class="col-lg-3">
                  <label for="nameInput" class="form-label">NAMA</label>
              </div>
              <div class="col-lg-9">
                  <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->nama?>" readonly>
              </div>
          </div>
          <div class="row mb-3">
              <div class="col-lg-3">
                  <label for="nameInput" class="form-label">NPK</label>
              </div>
              <div class="col-lg-9">
                  <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->npk?>" readonly>
              </div>
          </div>
          <div class="row mb-3">
              <div class="col-lg-3">
                  <label for="nameInput" class="form-label">TANGGAL LAHIR</label>
              </div>
              <div class="col-lg-9">
                  <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->tgl_lahir?>" readonly>
              </div>
          </div>
          <div class="row mb-3">
              <div class="col-lg-3">
                  <label for="nameInput" class="form-label">TMT GURU</label>
              </div>
              <div class="col-lg-9">
                  <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->tmt_guru?>" readonly>
              </div>
          </div>
          <div class="row mb-3">
              <div class="col-lg-3">
                  <label for="nameInput" class="form-label">LOKASI</label>
              </div>
              <div class="col-lg-9">
                  <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->provinsi.', '.$pegawai->kabkota?>" readonly>
              </div>
          </div>
          <div class="row mb-3">
              <div class="col-lg-3">
                  <label for="nameInput" class="form-label">STATUS MADRASAH</label>
              </div>
              <div class="col-lg-9">
                  <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->is_negeri?>" readonly>
              </div>
          </div>
<div class="row mb-3">
              <div class="col-lg-3">
                  <label for="nameInput" class="form-label">STATUS SERTIFIKASI</label>
              </div>
              <div class="col-lg-9">
                  <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->nrg?>" readonly>
              </div>
          </div>

          <div class="row mb-3">
              <div class="col-lg-3">
                  <label for="nameInput" class="form-label">MAPEL SERTIFIKASI</label>
              </div>
              <div class="col-lg-9">
                  <input type="text" class="form-control" id="nameInput" value="<?= $pegawai->mapel_sertifikasi?>" readonly>
              </div>
          </div>

        </form>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<?= $this->endSection() ?>
