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
    Data Proposal
    <small>Mengelola Data Proposal</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('home') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="#"></a> Data Master</li>
    <li><a href="#"></a> Data Proposal</li>
    <li><a href="#"></a> Update Data Proposal</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Update Data Proposal</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
         <?php foreach ($proposal as $p) { ?>
        <form action="<?= base_url('proposal/update'); ?>" method="post" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Program Kerja</label>
              <div class="col-sm-10">
                <input type="hidden" class="form-control" name="id_proposal" value="<?= $p->id_proposal?>">
                <select class="form-control" name="id_proker" required="" id="select2">
                  <option selected="selected" disabled>- Pilih Program Kerja -</option>
                  <?php foreach ($proker as $a) { ?>
                  <option value="<?= $a->id_proker ?>" <?php if($a->nama_proker==$p->nama_proker && $a->id_ta==$p->id_ta){echo "selected='selected'";} ?> ><?= $a->tahun_ajaran; ?> | <?= $a->nama_proker?></option>
                  <?php } ?>
                  <?= form_error('id_proker', '<small class="text-danger">', '</small>'); ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal Proposal</label>
              <div class="col-sm-10">
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" value="<?= $p->tanggal_proposal;?>" autocomplete="off">
                </div>
                <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">No. Surat Proposal</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="no_surat" value="<?= $p->no_surat_proposal;?>" autocomplete="off">
                <?= form_error('no_surat', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Perihal</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="perihal" autocomplete="off"><?= $p->perihal;?></textarea>
                <?= form_error('perihal', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>            
            <div class="form-group">
              <label class="col-sm-2 control-label">Dana Proposal</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="dana_proposal" value="<?= $p->dana_proposal;?>" autocomplete="off">
                <?= form_error('dana_proposal', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-10">
                <button type="button" class="btn btn-default" onclick="return history.go(-1)" title="Kembali ke Halaman sebelumnya"><span class="fa fa-arrow-circle-left"></span> Batal</button>
                <button type="submit" class="btn btn-primary" title="Update Data"><span class="fa fa-save"></span> Update</button>
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
    $('#select2').select2()
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
    $('#data').dataTable();
  });

  $('.alert-message').alert().delay(3000).slideUp('slow');
</script>
<?php
$this->load->view('template/foot');
?>