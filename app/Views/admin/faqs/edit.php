<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">FAQ</h4>
                    <div class="page-title-right">
                        <a href="<?= site_url('admin/faq')?>" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <form class="" action="" method="post">
                  <div class="col-md-12">
                      <label for="fullnameInput" class="form-label">Kategori</label>
                      <input type="text" class="form-control" id="category" name="category" value="<?= $faq->category?>">
                  </div>
                  <div class="col-md-12">
                      <label for="fullnameInput" class="form-label">Pertanyaan</label>
                      <input type="text" class="form-control" id="question" name="question" value="<?= $faq->question?>">
                  </div>
                  <div class="col-md-12">
                      <label for="fullnameInput" class="form-label">Jawaban</label>
                      <textarea name="answer" id="editor"><?= $faq->answer?></textarea>
                  </div>
                  <div class="col-12 mt-3">
                      <div class="text-end">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
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
<script src="<?= base_url()?>assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
});

</script>
<?= $this->endSection() ?>
