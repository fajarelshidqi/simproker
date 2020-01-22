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
    <li><a href="#"></a> Tambah Data Program Kerja</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Program Kerja</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?= base_url('dana_cair/add'); ?>" method="post" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Program Kerja</label>
              <div class="col-sm-10">
                <select class="select2 form-control" name="proker" required="">
                  <option selected="selected" disabled="">- Pilih Program Kerja -</option>
                  <?php foreach ($proker as $a) { ?>
                  <option value="<?= $a->id_proker ?>"><?= $a->tahun_ajaran; ?> | <?= $a->nama_proker; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Jumlah Dana Cair</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" placeholder="Masukan Jumlah Dana Cair" name="dana_cair">
                <?= form_error('dana_cair', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal Dana Cair</label>
              <div class="col-sm-10">
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" value="<?= set_value('tanggal')?>" placeholder="Masukan Tanggal Dana Cair" autocomplete="off">
                </div>
                <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">No. Kwitansi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Masukan No. Kwitansi" name="no_kwitansi">
                <?= form_error('no_kwitansi', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nota Dinas</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Masukan Nota Dinas" name="nota_dinas">
                <?= form_error('nota_dinas', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-10">
                <textarea class="form-control" placeholder="Masukan Keterangan" name="keterangan"></textarea>
                <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
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
    $('#datepicker').datepicker({
      autoclose: true,
      todayHighlight: true,
      orientation: "bottom auto",
      format: 'yyyy-mm-dd'
    });
    $('#date').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });
  });

  $('.alert-message').alert().delay(3000).slideUp('slow');
</script>
<?php
$this->load->view('template/foot');
?>