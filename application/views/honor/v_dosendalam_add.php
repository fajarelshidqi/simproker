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
    Data Dosen Dalam
    <small>Mengelola Data Dosen Dalam</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('home') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="#"></a> Data Master Honor</li>
    <li><a href="#"></a> Data Dosen Dalam</li>
    <li><a href="#"></a> Tambah Data Dosen Dalam</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Dosen Dalam</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?= base_url('dosen_dalam/add'); ?>" method="post" class="form-horizontal">
          <div class="box-body">                    
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Dosen Dalam</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Masukan Nama Dosen Dalam" name="dosen">
                <?= form_error('dosen', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Honor Mengajar (Per-Jam)</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" placeholder="Rp. 0,-" name="honor_dosen">
                <?= form_error('honor_dosen', '<small class="text-danger">', '</small>'); ?>
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
    $('.select2').select2();
  });
</script>
<?php
$this->load->view('template/foot');
?>