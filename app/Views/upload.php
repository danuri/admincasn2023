<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Upload Dokumen</h4>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Daftar Unggah Dokumen</h4>
                <div class="flex-shrink-0">
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive table-card">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Dokumen</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Upload</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php foreach ($dokumen as $row) {?>
                    		<tr>
              	          <td><?= $row->dokumen?></td>
              	          <td><?= $row->keterangan?></td>
              	          <td>
                            <?php if($row->lampiran){?>
                            <a href="https://docu.kemenag.go.id:9000/sscasn/2023/surat/<?= $row->lampiran ?>" class="btn btn-primary btn-sm" target="_blank">Lihat</a>
                          <?php  }else{  ?>
                            Belum mengunggah
                          <?php  }  ?>
                          </td>
              	          <td>
                            <a href="javascript:;" onclick="$('#lampiran<?= $row->id?>').click()" class="btn btn-warning btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Upload Berkas"><i class="ri-upload-cloud-line"></i></a>
              	          	<form style="display:none;" action="<?= site_url('upload/save')?>" method="post" enctype="multipart/form-data" id="form<?= $row->id?>">
                              <input type="hidden" name="id" value="<?= $row->id?>">
                              <input type="hidden" name="idlampiran" value="<?= $row->lampiran?>">
                              <label><i class="icofont icofont-upload-alt"></i>
                                <input type="file" name="lampiran" id="lampiran<?= $row->id?>" class="custom-file-input" onchange="$('#form<?= $row->id?>').submit()">
                              </label>
                            </form>
              	          </td>
              	        </tr>
                    	<?php }?>
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
