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
    Data Kelas
    <small>Mengelola Data Kelas</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('home') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="#"></a> Data Master</li>
    <li><a href="#"></a> Data Kelas</li>
    <li><a href="#"></a> Update Data Kelas</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Update Data Kelas</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php foreach ($kelas as $p) { ?>
          <form action="<?= base_url('kelas/update'); ?>" method="post" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Kelas</label>
                <div class="col-sm-10">
                  <input type="hidden" class="form-control" value="<?php echo $p->id_kelas?>" name="id">
                  <input type="text" class="form-control" value="<?php echo $p->nama_kelas?>" name="kelas">                  
                  <?= form_error('kelas', '<small class="text-danger">', '</small>'); ?>
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
        <?php } ?>
      </div>
    </div>
  </div>
</section><!-- /.content -->

<?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->

<?php
$this->load->view('template/foot');
?>