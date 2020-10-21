<header class="main-header">
  <!-- Logo -->

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php if ($profile->tipe == 99) {
                                            echo base_url('assets/backend/dist/img/user.png');
                                          }
                                          if ($profile->tipe == 88) {
                                            echo base_url('assets/backend/dist/img/pict.jpg');
                                          }
                                          if ($profile->tipe == 77) {
                                            echo base_url('assets/backend/dist/img/user.png');
                                          } ?>
                                          " class="user-image" alt="User Image">
            <span class="hidden-xs"><?php if ($profile->tipe == 99) {
                                            echo $profile->username;

                                          }
                                          if ($profile->tipe == 88) {
                                            echo $profile->username;

                                          }
                                          if ($profile->tipe == 77) {
                                            echo $profile->nama;
                                          } ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php if ($profile->tipe == 99) {
                                            echo base_url('assets/backend/dist/img/user.png');
                                          }
                                          if ($profile->tipe == 88) {
                                            echo base_url('assets/backend/dist/img/pict.jpg');
                                          }
                                          if ($profile->tipe == 77) {
                                            echo base_url('assets/backend/dist/img/user.png');
                                          } ?>" class="img-circle" alt="User Image">

              <p>
                <?= $profile->nama; ?> - <?php if ($profile->tipe == 99) {
                                            echo 'Admin';
                                            echo '<small>NIP.'.$profile->nip.'</small>';

                                          }
                                          if ($profile->tipe == 88) {
                                            echo 'Guru';
                                            echo '<small>NIP.'.$profile->nip.'</small>';
                                            echo '<small>Mapel : ' . $profile->nama_mapel . '</small>';

                                          }
                                          if ($profile->tipe == 77) {
                                            echo 'Sekretaris';
                                            echo '<small>NIS.'.$profile->nip.'</small>';
                                            echo '<small>Mapel : ' . $profile->kelas . '</small>';
                                          } ?>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="<?= site_url('logout'); ?>" class="btn btn-danger btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>