<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Pengaturan Formasi CASN 2023</h4>

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
          <div class="col-xl-12">
            <div class="alert alert-warning" role="alert">
              <strong>Harap diperhatikan!</strong>
              <ul>
                <li>Pembagian jumlah sesuai kebutuhan Organisasi</li>
                <li>Proposi menggunakan ketentuan jumlah total maksimal jumlah Non ASN sebesar 80% atau</li>
                <li>Umum minimal 20%</li>
                <li>Maksimal dan minimal peresentase adalah dari total formasi bukan per jabatan</li>
                <li>Isi pada kolom Non ASN. Kolom Umum mengikuti secara sistem.</li>
                <li>Untuk jabatan Dosen CPNS wajib UMUM.</li>
                <li>Final pengaturan jika telah selesai melakukan pembagian.</li>
              </ul>
            </div>
            <div class="card">
              <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Pengaturan Pembagian Jumlah Non ASN dan Umum</h4>
              </div>


              <div class="card-body">
                <div class="table-responsive table-card">
                  <table class="table align-middle table-nowrap table-striped-columns mb-0">
                    <thead>
                      <tr>
                        <th>JABATAN</th>
                        <th>JENIS</th>
                        <th>KELOMPOK</th>
                        <th>JUMLAH (<span id="rtotal">0</span>)</th>
                        <th>KHUSUS (<span id="rnonasn">0</span>)</th>
                        <th>UMUM (<span id="rumum">0</span>)</th>
                        <th>SIMPAN</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      foreach ($formasi as $row) {?>
                        <form class="" action="" method="post">
                          <tr>
                            <td><?= $row->jabatan?></td>
                            <td><?= strtoupper($row->jenis)?></td>
                            <td><?= $row->kelompok?></td>
                            <td><input type="number" class="form-control form-control-sm" id="total<?= $no?>" value="<?= $row->jumlah?>" readonly></td>
                            <td>
                              <input type="number" class="form-control form-control-sm jnonasn" id="jnonasn<?= $no?>" name="" value="<?= $row->nonasn?>" onchange="calculate(<?= $no?>)">
                            </td>
                            <td>
                              <input type="number" class="form-control form-control-sm jumum" id="jumum<?= $no?>" name="" value="<?= $row->umum?>" readonly>
                            </td>
                            <td>
                              <input type="button" class="btn btn-sm btn-primary" name="submit" onclick="sendporsi(<?= $no?>,<?= $row->id?>)" value="Simpan">
                            </td>
                          </tr>
                        </form>
                      <?php $no++; } ?>
                      <input type="hidden" id="no" value="<?= $no;?>">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Final Pengaturan</h4>
              </div>
              <div class="card-body">
                <div class="alert alert-warning" role="alert">
                  <ul>
                    <li>SPTJM ditandatangani oleh pimpinan Satuan Kerja</li>
                    <li>Dengan mengunggah SPTJM maka pembagian alokasi tidak lagi dapat diubah</li>
                    <li>Download <a href="<?= base_url()?>template/sptjm_alokasi_formasi.docx">Draft</a></li>
                  </ul>
                </div>
                <form class="" action="<?= site_url('pengaturan/formasi/final')?>" method="post" enctype="multipart/form-data">
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="nameInput" class="form-label">SPTJM</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="file" class="form-control" id="lampiran" name="lampiran">
                      </div>
                  </div>
                  <div class="text-end">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    countnonasn();
    counttotal();
    countumum();
  });

  function calculate(id) {
    total = $('#total'+id);
    nonasn = $('#jnonasn'+id);
    umum = $('#jumum'+id);

    if(parseInt(nonasn.val()) > parseInt(total.val())){
      alert('Jumlah Non ASN melebihi Total alokasi formasi '+total.val());
      nonasn.val(total.val());
      umum.val(0);

      countnonasn();
      countumum();
    }else{
      umum.val(total.val() - nonasn.val());

      countnonasn();
      countumum();
      //update disini
    }

  }

  function countnonasn() {
    x = 0;
    for(var n = 1; n < $('#no').val(); n++) {
        x = x+parseInt($('#jnonasn'+n).val());
    }

    $('#rnonasn').html(x);
  }

  function counttotal() {
    x = 0;
    for(var n = 1; n < $('#no').val(); n++) {
        x = x+parseInt($('#total'+n).val());
    }

    $('#rtotal').html(x);
  }

  function countumum() {
    x = 0;
    for(var n = 1; n < $('#no').val(); n++) {
        x = x+parseInt($('#jumum'+n).val());
    }

    $('#rumum').html(x);
  }

  function sendporsi(no,id) {
    axios.post('<?= site_url('pengaturan/formasi/saveporsi')?>', {
      ids: id,
      nonasn: $('#jnonasn'+no).val()
    })
    .then(function (response) {
      console.log(response);
      alert(response.data.message);
    })
    .catch(function (error) {
      console.log(error);
    });
  }
</script>
<?= $this->endSection() ?>
