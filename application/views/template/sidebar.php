  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('image/avatar.png') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama_user'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <!-- Menu Home -->
        <li <?= $this->uri->segment(1) == 'home' ? 'class="active"' : '' ?>>
          <a href="<?php echo base_url('home'); ?>"><i class="fa fa-home"></i>
            <span>Home</span>
          </a>
        </li>
        <!-- Tutup Menu Home -->
      </ul>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">SISTEM PROGRAM KERJA</li>
        <!-- Menu Data Master dan Submenu Data mhs, Dosen, MK -->
        <li class="treeview <?= $this->uri->segment(1) == 'ta' || $this->uri->segment(1) == 'proker' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Data Master Proker</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li <?= $this->uri->segment(1) == 'ta' ? 'class="active"' : '' ?>>
              <a href="<?php echo base_url('ta'); ?>"><i class="fa fa-circle-o"></i> Data Tahun Ajaran</a>
            </li>
            <li <?= $this->uri->segment(1) == 'proker' ? 'class="active"' : '' ?>>
              <a href="<?php echo base_url('proker'); ?>"><i class="fa fa-circle-o"></i> Data Program Kerja</a>
            </li>
          </ul>
        </li>
        <!-- Tutup Menu Data Master dan Submenu Data mhs, Dosen, MK -->

        <!-- Menu Data Proposal -->
        <li <?= $this->uri->segment(1) == 'proposal' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
          <a href="<?php echo base_url('proposal'); ?>"><i class="fa fa-file-text"></i>
            <span>Data Proposal</span>
          </a>
        </li>
        <!-- Tutup Data Proposal -->

        <!-- Menu Data Proposal -->
        <li <?= $this->uri->segment(1) == 'dana_cair' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
          <a href="<?php echo base_url('dana_cair'); ?>"><i class="fa fa-money"></i>
            <span>Data Dana Cair</span>
          </a>
        </li>
        <!-- Tutup Data Proposal -->
      </ul>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">SISTEM HONOR MENGAJAR</li>

        <!-- Menu Data Master dan Submenu Data mhs, Dosen, MK -->
        <li class="treeview <?= $this->uri->segment(1) == 'kelas' || $this->uri->segment(1) == 'mata_kuliah' || $this->uri->segment(1) == 'dosen_dalam' || $this->uri->segment(1) == 'dosen_luar' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Data Master Honor</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?= $this->uri->segment(1) == 'kelas' ? 'class="active"' : '' ?>>
              <a href="<?php echo base_url('kelas'); ?>"><i class="fa fa-circle-o"></i> Data Kelas</a>
            </li>
            <li <?= $this->uri->segment(1) == 'mata_kuliah' ? 'class="active"' : '' ?>>
              <a href="<?php echo base_url('mata_kuliah'); ?>"><i class="fa fa-circle-o"></i> Data Mata Kuliah</a>
            </li>
            <li <?= $this->uri->segment(1) == 'dosen_dalam' ? 'class="active"' : '' ?>>
              <a href="<?php echo base_url('dosen_dalam'); ?>"><i class="fa fa-circle-o"></i> Data Dosen Dalam</a>
            </li>
            <li <?= $this->uri->segment(1) == 'dosen_luar' ? 'class="active"' : '' ?>>
              <a href="<?php echo base_url('dosen_luar'); ?>"><i class="fa fa-circle-o"></i> Data Dosen Luar</a>
            </li>
          </ul>
        </li>
        <!-- Tutup Menu Data Master dan Submenu Data mhs, Dosen, MK -->

        <!-- Menu Data  Honor Koord MK-->
        <li <?= $this->uri->segment(1) == 'koord' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
          <a href="<?php echo base_url('koord'); ?>"><i class="fa fa-money"></i>
            <span>Data Honor Koord MK</span>
          </a>
        </li>
        <!-- Tutup Data Honor Koord MK -->

        <!-- Menu Data Proposal -->
        <li <?= $this->uri->segment(1) == 'honor_dosen_dalam' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
          <a href="<?php echo base_url('honor_dosen_dalam'); ?>"><i class="fa fa-money"></i>
            <span>Data Honor Dosen Dalam</span>
          </a>
        </li>
        <!-- Tutup Data Proposal -->

        <!-- Menu Data Proposal -->
        <li <?= $this->uri->segment(1) == 'honor_dosen_luar' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
          <a href="<?php echo base_url('honor_dosen_luar'); ?>"><i class="fa fa-money"></i>
            <span>Data Honor Dosen Luar</span>
          </a>
        </li>
        <!-- Tutup Data Proposal -->

        <li class="header">AKUN</li>

         <!-- Menu utilitas -->
       <!--  <li class="treeview <?= $this->uri->segment(1) == 'backup' || $this->uri->segment(1) == 'restore' || $this->uri->segment(1) == 'reset'  ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-gears"></i> <span>Utilitas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?= $this->uri->segment(1) == 'backup' ? 'class="active"' : '' ?>>
              <a href="<?php echo base_url('backup'); ?>"><i class="fa fa-circle-o"></i> Backup Database</a>
            </li>
            <li <?= $this->uri->segment(1) == 'restore' ? 'class="active"' : '' ?>>
              <a href="<?php echo base_url('restore'); ?>"><i class="fa fa-circle-o"></i> Restore Database</a>
            </li>
            <li <?= $this->uri->segment(1) == 'reset' ? 'class="active"' : '' ?>>
              <a href="<?php echo base_url('reset'); ?>"><i class="fa fa-circle-o"></i> Reset Database</a>
            </li>
          </ul>
        </li> -->
        <!-- Tutp Import Data -->

        <!-- Menu Data Peserta Ujian -->
        <li <?= $this->uri->segment(1) == 'user' ? 'class="active"' : '' ?>>
          <a href="<?php echo base_url('user'); ?>"><i class="fa fa-users"></i>
            <span>Pengguna</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">