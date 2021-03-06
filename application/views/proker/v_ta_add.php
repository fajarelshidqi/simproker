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
    Data Tahun Ajaran
    <small>Mengelola data tahun ajaran</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('home') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="#"></a> Data Master</li>
    <li><a href="#"></a> Data Tahun Ajaran</li>
    <li><a href="#"></a> Tambah Data Tahun Ajaran</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Tahun Ajaran</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?= base_url('ta/add'); ?>" method="post" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Tahun Ajaran</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Masukan Tahun Ajaran Baru" name="ta">
                <?= form_error('ta', '<small class="text-danger">', '</small>'); ?>
                <p class="help-block"> Isilah dengan isian sebagai contoh berikut : <b>2019/2020</b></p>
              </div>
              <div class="col-sm-10">
                
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