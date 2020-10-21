<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel text-center" style="margin-top:-50px;">
      <!-- <div class="pull-left image">
        <img src="<?= base_url(); ?>assets/backend/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?= $profile->nama; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div> -->
      <img src="<?= base_url() ?>assets/gambar/logo/logo.png" class="" style="max-width:50%;">

    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU UTAMA</li>
      <?php if ($userdataTipe == 99) : ?>
        <li class="<?php if ($this->uri->segment(1) == 'admin') {
                      echo 'active';
                    } ?>">
          <a href="<?= site_url('admin'); ?>">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li class="treeview <?php if ($this->uri->segment(1) == 'kelas' || $this->uri->segment(1) == 'mapel') {
                              echo 'active';
                            } ?>">
          <a href="#">
            <i class="glyphicon glyphicon-blackboard"></i> <span>KBM</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment(1) == 'kelas') {
                          echo 'active';
                        } ?>"><a href="<?= site_url('kelas') ?>"><i class="fa fa-circle-o text-red"></i> Kelas</a></li>
            <li class="<?php if ($this->uri->segment(1) == 'mapel') {
                          echo 'active';
                        } ?>"><a href="<?= site_url('mapel') ?>"><i class="fa fa-circle-o text-purple"></i> Mata Pelajaran</a></li>
          </ul>
        </li>
        <li class="<?php if ($this->uri->segment(1) == 'data-guru' || $this->uri->segment(1) == 'add-guru') {
                      echo 'active';
                    } ?>">
          <a href="<?= site_url('data-guru'); ?>">
            <i class="fa fa-user"></i>
            <span>Data Guru</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->segment(1) == 'data-siswa' || $this->uri->segment(1) == 'edit-siswa') {
                      echo 'active';
                    } ?>">
          <a href="<?= site_url('data-siswa'); ?>">
            <i class="fa fa-users"></i> <span>Data Siswa</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->segment(1) == 'data-sekretaris') {
                      echo 'active';
                    } ?>">
          <a href="<?= site_url('data-sekretaris'); ?>">
            <i class="fa fa-sticky-note"></i>
            <span>Data Sekretaris</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->segment(1) == 'data-rekap') {
                      echo 'active';
                    } ?>">
          <a href="<?= site_url('data-rekap'); ?>">
            <i class="fa fa-files-o"></i>
            <span>Data Rekap</span>
          </a>
        </li>
      <li class="header">BUKU PANDUAN</li>
        <li class="">
          <a href="https://s.id/rkX1M" target="_blank">
            <i class="fa fa-circle"></i>
            <span>User Guide</span>
          </a>
        </li>
      <?php endif; ?>

      <!-- guru -->
      <?php if ($userdataTipe == 88) : ?>
        <li class="<?php if ($this->uri->segment(1) == 'guru') {
                      echo 'active';
                    } ?>">
          <a href="<?= site_url('guru'); ?>">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->segment(2) == 'absensi') {
                      echo 'active';
                    } ?>">
          <a href="<?= site_url('gr/absensi'); ?>">
            <i class="fa fa-tags"></i> <span>Absensi</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->segment(2) == 'data-siswa' || $this->uri->segment(3) == 'add-siswa') {
                      echo 'active';
                    } ?>">
          <a href="<?= site_url('gr/data-siswa'); ?>">
            <i class="fa fa-users"></i> <span>Data Siswa</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->segment(2) == 'data-sekretaris') {
                      echo 'active';
                    } ?>">
          <a href="<?= site_url('gr/data-sekretaris'); ?>">
            <i class="fa fa-sticky-note"></i>
            <span>Data Sekretaris</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->segment(2) == 'data-rekap') {
                      echo 'active';
                    } ?>">
          <a href="<?= site_url('gr/data-rekap'); ?>">
            <i class="fa fa-files-o"></i>
            <span>Data Rekap</span>
          </a>
        </li>
              <li class="header">BUKU PANDUAN</li>

        <li class="">
          <a href="https://s.id/rkX1M" target="_blank">
            <i class="fa fa-circle"></i>
            <span>User Guide</span>
          </a>
        </li>
      <?php endif; ?>

      <!-- sekretaris -->
      <?php if ($userdataTipe == 77) : ?>
        <li class="<?php if ($this->uri->segment(1) == 'sekretaris') {
                      echo 'active';
                    } ?>">
          <a href="<?= site_url('sekretaris'); ?>">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->segment(2) == 'data-siswa' || $this->uri->segment(3) == 'add-siswa') {
                      echo 'active';
                    } ?>">
          <a href="<?= site_url('sk/data-siswa'); ?>">
            <i class="fa fa-users"></i> <span>Data Siswa</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->segment(2) == 'data-rekap') {
                      echo 'active';
                    } ?>">
          <a href="<?= site_url('sk/data-rekap'); ?>">
            <i class="fa fa-files-o"></i>
            <span>Data Rekap</span>
          </a>
        </li>
              <li class="header">BUKU PANDUAN</li>

        <li class="">
          <a href="https://s.id/rkX1M" target="_blank">
            <i class="fa fa-circle"></i>
            <span>User Guide</span>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>