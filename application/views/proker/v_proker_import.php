<?php
$this->load->view('template/head');
?>

<!--tambahkan custom css disini-->

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data Program Kerja
    <small>Mengelola Data Program Kerja</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('home') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="#"></a> Data Master</li>
    <li><a href="#"></a> Data Program Kerja</li>
    <li><a href="#"></a> Import Data Program Kerja</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Import Data Program Kerja</h3>
          <a href="<?= base_url('excel/format-import-data-proker.xlsx') ?>" class="pull-right" download><i class="fa fa-download"></i> Download Format Import Data Program Kerja</a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?= base_url('proker/saveimport'); ?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Tahun Ajaran</label>
              <div class="col-sm-10">
                <select class="select2 form-control" name="ta" required="">
                  <option selected="selected" disabled="">- Pilih Tahun Ajaran -</option>
                  <?php foreach ($ta as $a) { ?>
                  <option value="<?= $a->id_ta ?>"><?= $a->tahun_ajaran; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-2 control-label">File Import</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="file" required accept=".xls, .xlsx">
                <p class="help-block">File harus bertipe : <b>.xls</b> atau <b>.xlsx</b></p>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-10">
                <button type="button" class="btn btn-default" onclick="return history.go(-1)" title="Kembali ke Halaman sebelumnya"><span class="fa fa-arrow-circle-left"></span> Batal</button>
                <button type="submit" class="btn btn-primary" title="Simpan Data"><span class="fa fa-save"></span> Simpan</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section><!-- /.content -->

<?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->
<script type="text/javascript">
  $(function() {
    $('#data').dataTable();
  });

  $('.alert-message').alert().delay(3000).slideUp('slow');
</script>

<?php
$this->load->view('template/foot');
?>