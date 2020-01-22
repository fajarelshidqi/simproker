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
        Dashboard
        <small>Home</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
        
        <div class="box-header with-border">
            <h3 class="box-title">Perjanjian Penggunaan</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body" style="display: none;">
            <dl>
                <dd>
                    Dengan menggunakan Aplikasi ini, maka anda setuju untuk :
                    <ol>
                        <li>Tidak mengubah Nama Aplikasi <b>Sistem Informasi Program Kerja</b> menjadi nama aplikasi lain</li>
                        <li>Tidak mengubah footer yang menunjukkan Profil Sistem Informasi Program Kerja</li>
                        <li>Tidak menghapus Perjanjian Penggunaan</li>
                    </ol>
                    Semoga <b>Sistem Informasi Program Kerja</b> dapat bermanfaat untuk kita semua.
                </dd>
            </dl>
        </div><!-- /.box-body -->
      </div>
      <!-- /.box -->
     <div class="callout callout-info">
       <h4>Informasi</h4>
        <p>Ini adalah Sistem Informasi Program Kerja yang disertai dengan Sistem Honor Mengajar, yang memiliki platform dan bahasa user-friendly untuk membuat, mengelola dan melaksanakan pelaporan Dana Program Kerja dan Honor Mengajar.</p>
     </div>
      
    

        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $proker?></h3>

              <p>Program Kerja</p>
            </div>
            <div class="icon">
              <i class="fa fa-pie-chart"></i>
            </div>
            <a href="<?php echo base_url('proker'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $proposal?><!-- <sup style="font-size: 20px">%</sup> --></h3>

              <p>Data Proposal</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url('proposal'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $danaCair?></h3>

              <p>Data Dana Cair</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="<?php echo base_url('dana_cair'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $mk?></h3>

              <p>Data Mata Kuliah</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="<?php echo base_url('mata_kuliah'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $dd?></h3>

              <p>Data Dosen Dalam</p>
            </div>
            <div class="icon">
              <i class="fa fa-graduation-cap"></i>
            </div>
            <a href="<?php echo base_url('dosen_dalam'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?php echo $dl?></h3>

              <p>Data Dosen Luar</p>
            </div>
            <div class="icon">
              <i class="fa fa-graduation-cap"></i>
            </div>
            <a href="<?php echo base_url('dosen_luar'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

      

    </section>
    <!-- /.content -->

<?php 
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->

<script type="text/javascript">

    $(function(){
        $('#data-tables').dataTable();
    });

    $('.alert-message').alert().delay(3000).slideUp('slow');

</script>


<?php
$this->load->view('template/foot');
?>
