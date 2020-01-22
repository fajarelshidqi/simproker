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
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-2">
      <div class="box box-default">
        <div class="box-header text-center">
          <h4 class="box-title">Filter Honor Dosen Dalam</h4>
        </div>
        <div class="box-body">
          <form action="" method="get">
            <div class="box-body">
              <div class="form-group">
                <label>Mengajar Bulan</label>
                <input type="text" class="form-control" id="datepicker" name="bulan1" placeholder="Januari 2019" autocomplete="off">              
              </div>
              <div class="form-group">
                <label>Dibayarkan Bulan</label>
                <input type="text" class="form-control" id="datepicker2" name="bulan2" placeholder="Februari 2019" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Kelas</label>
                <select class="select2 form-control" name="kelas" required="">
                  <option selected="selected" disabled="">- Pilih Kelas -</option>
                  <?php foreach ($kelas as $a) { ?>
                    <option value="<?= $a->id_kelas ?>"><?= $a->nama_kelas; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="box-footer">
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-block"><span class="fa fa-filter"></span> Filter Data</button>
              </div>
              <div class="form-group">
                <a href="<?=base_url('honor_dosen_dalam')?>" class="btn btn-default btn-block"><span class="fa fa-refresh"></span> REFRESH</a>
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
          <a href="<?= base_url('honor_dosen_dalam/add'); ?>" class="btn btn-primary"><span class="fa fa-plus"></span> Data Honor Dosen Dalam</a>
          <?php 
          if(isset($_GET['bulan1']) || isset($_GET['bulan2']) || isset($_GET['kelas'])) {
            $bulan1 = $this->input->get('bulan1');
            $bulan2 = $this->input->get('bulan2');
            $kelas  = $this->input->get('kelas');
            ?>
            <a href="<?=base_url().'honor_dosen_dalam/exportPdf/?bulan1='.$bulan1.'&bulan2='.$bulan2.'&kelas='.$kelas; ?>" class="btn btn-danger pull-right" target="_blank"><span class="fa fa-file-pdf-o"></span> Export Filter to PDF</a>
          <?php } ?>
          <!-- <a href="//<?= base_url('dosen_dalam/import');//?>" class="btn btn-success"><span class="fa fa-file-excel-o"></span> Import Data Dosen Dalam</a> -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="data" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="1%">No</th>
                <th>Kelas</th>
                <th>Nama Dosen</th>
                <th>Mata Kuliah</th>
                <th>Pertemuan</th>
                <th>Jam Mengajar</th>
                <th>Mengajar Bulan</th>
                <th>Dibayar Bulan</th>
                <th>Jumlah</th>
                <th width="8%"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($honordd as $m) { $jumlah = 0; $jumlah = $m->honor_dosendalam * $m->jam; ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $m->nama_kelas; ?></td>
                  <td><?php echo $m->nama_dosendalam; ?></td>
                  <td><?php echo $m->nama_mk; ?></td>
                  <td><?php echo $m->pertemuan; ?></td>
                  <td><?php echo $m->jam; ?></td>
                  <td><?php echo $m->bulanpertama; ?></td>
                  <td><?php echo $m->bulankedua; ?></td>
                  <td>
                    Rp. 
                    <?php if ($jumlah == "") { 
                      echo number_format(0,0,'','.'); 
                    } else {
                      echo number_format($jumlah,0,'','.');
                    }
                    ?>                      
                  </td>
                  <td>
                    <a href="<?= base_url('honor_dosen_dalam/edit/') . $m->id_honor_dosendalam; ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a> | 
                    <a href="<?= base_url('honor_dosen_dalam/hapus/') . $m->id_honor_dosendalam; ?>" onclick="return confirm('Apakah yakin data peserta ini di hapus?')"  class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>
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