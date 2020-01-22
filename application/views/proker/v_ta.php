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
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      
      <?= $this->session->flashdata('message'); ?>
      <!-- Default box -->
      <div class="box box-default">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <a href="<?= base_url('ta/add'); ?>" class="btn btn-primary"><span class="fa fa-plus"></span> Data Tahun Ajaran</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="data" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="1%">No</th>
                <th>Tahun Ajaran</th>
                <th width="15%"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($ta as $m) { ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $m->tahun_ajaran; ?></td>
                  <td>
                    <a href="<?= base_url('ta/edit/') . $m->id_ta; ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a> | 
                    <a href="<?= base_url('ta/hapus/') . $m->id_ta; ?>" onclick="return confirm('Apakah yakin data peserta ini di hapus?')"  class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>
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
  });

  $('.alert-message').alert().delay(3000).slideUp('slow');
</script>
<?php
$this->load->view('template/foot');
?>