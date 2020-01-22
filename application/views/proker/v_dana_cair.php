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
    Data Dana Cair
    <small>Mengelola Data Dana Cair</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('home') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="#"></a> Data Dana Cair</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-2">
      <div class="box box-default">
        <div class="box-header text-center">
          <h4 class="box-title">Filter Program Kerja</h4>
        </div>
        <div class="box-body">
          <form action="" method="get">
            <div class="box-body">
              <div class="form-group">
                <label>Program Kerja</label>
                <select class="form-control" id="select2" name="proker" required="">
                  <option selected="selected" disabled="">- Pilih Program Kerja -</option>
                  <?php foreach ($proker as $a) { ?>
                  <option value="<?= $a->id_proker ?>"><?= $a->tahun_ajaran; ?> | <?= $a->nama_proker; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="box-footer">
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-block"><span class="fa fa-filter"></span> Filter Data</button>
              </div>
              <div class="form-group">
                <a href="<?=base_url('dana_cair')?>" class="btn btn-default btn-block"><span class="fa fa-refresh"></span> REFRESH</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-10">

      <?= $this->session->flashdata('message'); ?>
      <!-- Default box -->
      <div class="box box-default">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <a href="<?= base_url('dana_cair/add'); ?>" class="btn btn-primary"><span class="fa fa-plus"></span> Data Dana Cair</a>
          
          <a href="<?= base_url('dana_cair/exportPdf'); ?>" class="btn btn-danger" target="_blank"><span class="fa fa-file-pdf-o"></span> Export All to PDF</a>
          <?php 
            if(isset($_GET['proker'])) {
              $proker = $_GET['proker'];
              ?>
              <a href="<?=base_url().'dana_cair/exportPdf/?proker='.$proker; ?>" class="btn btn-danger pull-right" target="_blank"><span class="fa fa-file-pdf-o"></span> Export Filter to PDF</a>
            <?php } ?>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="data" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="1%">No</th>
                <th>Program Kerja</th>
                <th>Dana Cair</th>
                <th>Tanggal</th>
                <th>No. Kwitansi</th>
                <th>Nota Dinas</th>
                <th>Keterangan</th>
                <th width="8%"></th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($dana_cair as $m) {; ?>

                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $m->tahun_ajaran; ?> | <?php echo $m->nama_proker; ?></td>
                  <td>
                  	Rp. 
                    <?php if ($m->dana_cair == "") { 
                      echo number_format(0,0,'','.'); 
                    } else {
                      echo number_format($m->dana_cair,0,'','.');
                    }
                    ?>                 	
                  </td>
                  <td><?php echo $m->tanggal; ?></td>
                  <td><?php echo $m->no_kwitansi; ?></td>
                  <td><?php echo $m->nota_dinas; ?></td>
                  <td><?php echo $m->keterangan; ?></td>              
                  <td>
                    <a href="<?= base_url('dana_cair/edit/') . $m->id_dana_cair; ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a> | 
                    <a href="<?= base_url('dana_cair/hapus/') . $m->id_dana_cair; ?>" onclick="return confirm('Apakah yakin data peserta ini di hapus?')"  class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
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
    $('#select2').select2();
  });

  $('.alert-message').alert().delay(3000).slideUp('slow');
</script>
<?php
$this->load->view('template/foot');
?>