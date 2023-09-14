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
            <div class="card">
              <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Pengaturan Pembagian Jumlah Non ASN dan Umum</h4>
              </div>


              <div class="card-body">
                <div class="table-responsive table-card">
                  <table class="table align-middle table-nowrap table-striped-columns mb-0 datatable">
                    <thead>
                      <tr>
                        <th>JABATAN</th>
                        <th>JENIS</th>
                        <th>KELOMPOK</th>
                        <th>JUMLAH</th>
                        <th>KHUSUS</th>
                        <th>UMUM</th>
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
                            <td><?= $row->jumlah?></td>
                            <td><?= $row->nonasn?></td>
                            <td><?= $row->umum?></td>
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
                Final pengaturan formasi sudah dilakukan
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
