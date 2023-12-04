<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-12">
              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0">Data Lokasi SKTT</h4>

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
          <div class="alert alert-success">
            Readme!
            <ul>
              <li>1 Lokasi dapat dibuat lebih dari 1 titik lokasi</li>
              <li>2 Lokasi dapat dibuat 1 titik lokasi dengan mengubah nama tilok dengan dengan nama tilok yang sama.</li>
              <!-- <li>1 hari 4 Sesi</li> -->
              <li>Pelaksanaan Tahun ini dilakukan dalam 1 hari dengan 4 sesi</li>
              <li>Peserta dapat dipindahkan menggunakan fitur pindah tilok hanya pada lokasi yang sama</li>
              <li>Tombol Generate Jadwal untuk meng<i>generate</i> seluruh peserta pada tilok yang dipilih</li>
              <li>Jika ada perpindahan tilok peserta, pada tilok wajib dilakukan generate jadwal kembali</li>
              <li>Pelaksanaan dapat dilaksanakan minimal 1 sesi. Tidak harus 4 sesi.</li>
              <li>Dalam Pengaturan titik lokasi, Kanwil wajib berkoordinasi dengan ESELON 1/PTKN/BALAI/UPT pada wilayahnya.</li>
            </ul>
          </div>

          <div class="card">
            <div class="card-header align-items-center d-flex">
              <h4 class="card-title mb-0 flex-grow-1">Data Lokasi SKTT</h4>
              <div class="flex-shrink-0">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addmodal">
                  Tambah Tilok
                </button>
              </div>
            </div>

            <div class="card-body table-responsive">
              <table class="table datatablex">
                <thead>
                  <tr>
                    <th>LOKASI</th>
                    <th>TITIK LOKASI</th>
                    <th>JUMLAH</th>
                    <th>OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($lokasi as $row) {?>
                    <tr class="bg-soft-danger">
                      <td colspan="4"><?= $row->lokasi_ujian?></td>
                    </tr>
                    <?php
                    $db = db_connect();
                    $tiloks = $db->query("SELECT *, (SELECT COUNT(nik) FROM sktt_peserta WHERE tilok_kode=id) jumlah FROM sktt_tilok WHERE kode_lokasi='$row->id'")->getResult();
                    foreach ($tiloks as $rtilok) {?>
                      <tr>
                        <td></td>
                        <td><?= $rtilok->tilok?></td>
                        <td><?= $rtilok->jumlah?></td>
                        <td><a href="<?php echo site_url('sktt/peserta/'.encrypt($rtilok->id));?>">Peserta</a> | <a href="javascript:;" onclick="edit('<?= $row->id?>','<?php echo $rtilok->id;?>')">Edit</a> <?php if($rtilok->jumlah == 0){?>| <a href="<?php echo site_url('sktt/delete/'.encrypt($rtilok->id));?>" onclick="return confirm('Tilok akan dihapus?')">Delete</a><?php }?></td>
                      </tr>
                    <?php
                    }
                    ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>

          <?php if(isset($peserta)){ ?>
          <div class="card">
            <div class="card-header align-items-center d-flex">
              <h4 class="card-title mb-0 flex-grow-1">Data Peserta Titik Lokasi <?= $tilok->tilok?></h4>
              <div class="flex-shrink-0">
                <button type="button" class="btn btn-primary btn-sm" id="btntilok">
                  Pindah Titik Lokasi
                </button>
                <a href="jacasript:;" class="btn btn-success btn-sm" onclick="generatejadwal('<?= encrypt($tilok->id)?>')">Generate Jadwal</a>
              </div>
            </div>

            <div class="card-body table-responsive">
              <table class="table table-bordered" id="lokasi">
                <thead>
                  <tr>
                    <th></th>
                    <th>Nomor Peserta</th>
                    <th>Nama</th>
                    <th>Lokasi Jabatan</th>
                    <th>Hari</th>
                    <th>Sesi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($peserta as $row) {?>
                    <tr>
                      <td></td>
                      <td><?= $row->nomor_peserta?></td>
                      <td><?= $row->nama?></td>
                      <td><?= $row->lokasi_nama?></td>
                      <td><?= harisesi($row->sesi)?></td>
                      <td><?= $row->sesi?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>

          <div id="pindahtilok" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-backdrop="static" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header p-3 bg-soft-info">
                  <h5 class="modal-title" id="myModalLabel">Pindah Titik Lokasi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="" action="<?= site_url('sktt/pindahtilok')?>" method="post" id="formpindahtilok">
                    <div class="mb-3">
                      <label for="lokasi" class="form-label">Titik Lokasi</label>
                      <select class="form-select" name="titik_lokasi" id="tilok">
                      </select>

                      <input type="hidden" name="lokasi" value="<?= $tilok->kode_lokasi?>">
                    </div>
                    <div class="mb-3">
                      <label for="lokasi" class="form-label">Sesi</label>
                      <input type="number" class="form-control" name="sesi">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="$('#formpindahtilok').submit()">Simpan</button>
                </div>
              </div>
            </div>
          </div>

          <div id="generatejadwal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-backdrop="static" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header p-3 bg-soft-info">
                  <h5 class="modal-title" id="myModalLabel">Generate Jadwal <?= $tilok->tilok?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="" action="<?= site_url('sktt/generatejadwal')?>" method="post" id="formgenerate">
                    <div class="mb-3">
                      <label for="lokasi" class="form-label">Jumlah Sesi</label>
                      <input type="number" class="form-control" name="sesi" value="">
                      <input type="hidden" name="lokasi" value="<?= encrypt($tilok->id)?>">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="$('#formgenerate').submit()">Simpan</button>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
  </div>
</div>

<div id="addmodal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-backdrop="static" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header p-3 bg-soft-info">
        <h5 class="modal-title" id="myModalLabel">Tambah Titik Lokasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" action="<?= site_url('sktt/lokasi')?>" method="post" id="addtilok">
          <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <select class="form-select" name="kode_lokasi">
              <?php foreach ($lokasi as $row) {
                echo '<option value="'.$row->id.'">'.$row->lokasi_ujian.'</option>';
              } ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="lokasi" class="form-label">Titik Lokasi (Nama Gedung)</label>
            <input type="text" class="form-control" name="lokasi" value="">
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="maps" class="form-label">Link Google Maps</label>
            <input type="text" class="form-control" name="maps">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="$('#addtilok').submit()">Simpan</button>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<div id="editmodal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-backdrop="static" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header p-3 bg-soft-info">
        <h5 class="modal-title" id="myModalLabel">Edit Titik Lokasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" action="<?= site_url('sktt/edittilok')?>" method="post" id="edittilok">
          <div class="mb-3">
            <label for="lokasi" class="form-label">Titik Lokasi (Nama Gedung)</label>
            <input type="text" class="form-control" name="lokasi" id="lokasi" value="">
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="maps" class="form-label">Link Google Maps</label>
            <input type="text" class="form-control" id="maps" name="maps">
            <input type="hidden" name="idtilok" id="idtilok" value="">
            <input type="hidden" name="kode_lokasi" id="kode_lokasi" value="">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="$('#edittilok').submit()">Simpan</button>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script type="text/javascript">
var siteurl = '<?= site_url()?>';

var lokasi = $('#lokasi').DataTable({
  'dom':"Bfrtip",
  'buttons':["copy","csv","excel","print","pdf","pageLength"],
  'lengthMenu': [
    [10, 25, 50, 100, -1],
    [10, 25, 50, 100, 'Semua'],
  ],
      'columnDefs': [
         {
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi'
      },
      'order': [[1, 'asc']]
   });

var lokasix = $('#lokasix').DataTable( {
  columnDefs: [ {
      orderable: false,
      className: 'select-checkbox',
      targets:   0
  } ],
  select: {
      style:    'multi',
      selector: 'td:first-child'
  },
  order: [[ 1, 'asc' ]]
} );

$('#btntilok').on('click',function(event) {
  var rows_selected = lokasi.rows( { selected: true } ).data().toArray();

  $('input[name="peserta\[\]"]', '#formpindahtilok').remove();

  $.each(rows_selected, function(index, value){
    // console.log(value[1]);
    $('#formpindahtilok').append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'peserta[]')
                .val(value[1])
         );
  });

  <?php if(isset($peserta)){ ?>
  $('#tilok').load(siteurl+'sktt/gettilok/<?= $tilok->kode_lokasi?>');
  <?php } ?>
  $('#pindahtilok').modal('show');
});

function generatejadwal() {
  $('#generatejadwal').modal('show');
}

function edit(lokasi,id) {
  alert('Memuat...');
  axios.get(siteurl+'sktt/edit/'+id).then(function (response) {
    $('#lokasi').val(response.data.tilok);
    $('#maps').val(response.data.maps);
    $('#alamat').html(response.data.alamat);
    $('#idtilok').val(response.data.id);
    $('#kode_lokasi').val(lokasi);
    $('#editmodal').modal('show');
  });
}

function addtilok() {
  $('#tambahtilok').trigger('reset');
  $('#addtilok').modal('show');
}

function detail(nik) {
  $('#bodydetail').load('<?= site_url('admin/skb/lokasi/get_detail');?>/'+nik);
  $('#detaillokasi').modal('show');
}
</script>
<?= $this->endSection() ?>
