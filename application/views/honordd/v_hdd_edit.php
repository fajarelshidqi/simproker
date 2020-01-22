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
    Data Honor Dosen Dalam
    <small>Mengelola Data Honor Dosen Dalam</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('home') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="#"></a> Data Honor Dosen Dalam</li>
    <li><a href="#"></a> Update Data Honor Dosen Dalam</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Update Data Honor Dosen Dalam</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php foreach ($hdd as $k) { ?>
        <form action="<?= base_url('honor_dosen_dalam/update'); ?>" method="post" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Mata Kuliah</label>
              <div class="col-sm-10">
                <input type="hidden" name="id_honordd" value="<?= $k->id_honor_dosendalam;?>">
                <select class="select2 form-control" name="mk" required="">
                  <option selected="selected" disabled="">- Pilih Mata Kuliah -</option>
                  <?php foreach ($matakuliah as $a) { ?>
                    <option value="<?= $a->id_mk ?>" <?php if($a->nama_mk==$k->nama_mk){echo "selected='selected'";} ?>><?= $a->nama_kelas; ?> | <?= $a->nama_mk; ?> | <?= $a->sks; ?> SKS</option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Dosen Dalam</label>
              <div class="col-sm-10">
                <select class="select2 form-control" name="dosen" required="">
                  <option selected="selected" disabled="">- Pilih Nama Dosen Dalam -</option>
                  <?php foreach ($dosendalam as $d) { ?>
                    <option value="<?= $d->id_dosendalam ?>" <?php if($d->nama_dosendalam==$k->nama_dosendalam){echo "selected='selected'";} ?>><?= $d->nama_dosendalam; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Pertemuan</label>
              <div class="col-sm-10">
                  <input type="number" class="form-control" name="pertemuan" value="<?= $k->pertemuan;?>" autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Jam Mengajar</label>
              <div class="col-sm-10">
                  <input type="number" step="any" class="form-control" name="jam" value="<?= $k->jam;?>" autocomplete="off">
                  <span class="help-block"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Mengajar Bulan</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="datepicker" name="bulan1" value="<?= $k->bulanpertama;?>" autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Dibayar Bulan</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="datepicker2" name="bulan2" value="<?= $k->bulankedua;?>" autocomplete="off">
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
    $('.select2').select2();
    $('#datepicker').datepicker({
      autoclose: true,
      todayHighlight: true,
      viewMode: "months",
      minViewMode: "months",
      orientation: "bottom auto",
      format: 'MM yyyy'
    });
    $('#datepicker2').datepicker({
      autoclose: true,
      todayHighlight: true,
      viewMode: "months",
      minViewMode: "months",
      orientation: "bottom auto",
      format: 'MM yyyy'
    });
  });

  $('.alert-message').alert().delay(3000).slideUp('slow');
</script>
<?php
$this->load->view('template/foot');
?>