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
    <li><a href="#"></a> Update Data Program Kerja</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Update Data Program Kerja</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php foreach ($proker as $p) { ?>
        <form action="<?= base_url('proker/update'); ?>" method="post" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Tahun Ajaran</label>
              <div class="col-sm-10">
                <input type="hidden" class="form-control" name="id_proker" value="<?= $p->id_proker?>">
                <select class="select2 form-control" name="ta" required="">
                  <option selected="selected" disabled="">- Pilih Tahun Ajaran -</option>
                  <?php foreach ($ta as $a) { ?>
                  <option value="<?= $a->id_ta ?>" <?php if($a->tahun_ajaran==$p->tahun_ajaran ){echo "selected='selected'";} ?>><?= $a->tahun_ajaran; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Program Kerja</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_proker" value="<?= $p->nama_proker?>">
                <?= form_error('nama_proker', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Dana Program Kerja</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="dana_proker" value="<?= $p->dana_proker?>">
                <?= form_error('dana_proker', '<small class="text-danger">', '</small>'); ?>
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
<script type="text/javascript">
  $(function() {
    $('#data').dataTable();
  });

  $('.alert-message').alert().delay(3000).slideUp('slow');
</script>
<?php
$this->load->view('template/foot');
?>