<?= $this->extend('template') ?>

<?= $this->section('style') ?>

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Mapping Penempatan SIASN</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-xl-12">

            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table align-middle table-striped-columns mb-0 datatable">
                    <thead>
                      <tr>
                        <th>Jabatan</th>
                        <th>Alokasi</th>
                        <th>Penempatan Menpan</th>
                        <th>Penempatan SIASN</th>
                        <th>Ubah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($penempatan as $row) {?>
                      <tr>
                        <td><?= $row->jabatan?></td>
                        <td><?= $row->jumlah?></td>
                        <td><?= $row->penempatan?></td>
                        <td><?= $row->unor_nama?></td>
                        <td><a href="javascript:;" onclick="edit('<?= $row->id?>')" class="btn btn-sm btn-primary">Ubah</a></td>
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

<div id="editmodal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-backdrop="static" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header p-3 bg-soft-info">
        <h5 class="modal-title" id="myModalLabel">Edit Penempatan SIASN</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" action="<?= site_url('pengaturan/penempatan/save')?>" method="post" id="edit">
          <input type="hidden" name="idformasi" id="idformasi" value="">
          <div class="mb-3">
            <label for="lokasi" class="form-label">Penempatan SIASN</label>
            <select class="form-select" name="unor" id="unor"></select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="$('#edit').submit()">Simpan</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
var siteurl = '<?= site_url()?>';

function edit(id) {
  alert('Memuat...');
  // axios.get(siteurl+'sktt/edit/'+id).then(function (response) {
  //   $('#lokasi').val(response.data.tilok);
  //   $('#maps').val(response.data.maps);
  //   $('#alamat').html(response.data.alamat);
  //   $('#idtilok').val(response.data.id);
  //   $('#kode_lokasi').val(lokasi);
  // });
    $('#idformasi').val(id);
    $('#editmodal').modal('show');
}

$('#unor').select2({
  dropdownParent: $('#editmodal'),
  ajax: {
    url: siteurl+'pengaturan/penempatan/search',
    data: function (params) {
      var query = {
        search: params.term,
        type: 'public'
      }

      return query;
    },
    processResults: function (data) {
      return {
        results: data
      };
    },
    processResults: (data, params) => {
        const results = data.map(item => {
          return {
            id: item.id,
            text: item.nama,
          };
        });
        return {
          results: results,
        }
      },
  },
  placeholder: 'Cari Unor',
  minimumInputLength: 5,
});
</script>
<?= $this->endSection() ?>
