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
    Data Pengguna
    <small>Mengelola data pengguna</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('home') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="#"></a> Data Pengguna</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
        Jangan Menghapus Data Admin, jika terhapus sistem tidak akan bisa digunakan!
      </div>
      <!-- Default box -->
      <div class="box box-default" style="overflow-x: scroll;">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span>  Data Pengguna</button> -->
        </div>
        <!-- /.box-header -->
        
        <?= $this->session->flashdata('message'); ?>

        <div class="box-body">
          <table id="data" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="1%">No</th>
                <th>Nama User</th>
                <th>Email</th><!-- 
                <th width="15%"></th> -->
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($user as $m) { ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $m->nama_user; ?></td>
                  <td><?php echo $m->email; ?></td>
                  <!-- <td>
                    <a href="//<?= base_url('user/edit/') .$m->id_user; //?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a> | 
                    <a href="//<?= base_url('user/hapus/') .$m->id_user; //?>" onclick="return confirm('Apakah yakin data peserta ini di hapus?')"  class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></a>
                  </td> -->
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section><!-- /.content -->

<!-- /. modal  -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Masukan Data Kelas</h4>
      </div>
      <!-- /.form dengan modal -->
      <form method="post" action="<?php echo base_url('kelas'); ?>">
        <div class="modal-body">
          <div class="form-group">
            <label class="font-weight-bold">Nama Kelas</label>
            <input type="text" class="form-control" name="nama_kelas" placeholder="Masukkan Nama Kelas" required="">
            <?= form_error('nama_kelas', '<small class="text-danger">', '</small>'); ?>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">TUTUP</button>
          <button type="submit" class="btn btn-primary">SUBMIT</button>
        </div>
      </form>
      <!-- /.tutup form dengan modal  -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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