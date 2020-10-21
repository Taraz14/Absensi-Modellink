<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs (Pulled to the right) -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
          <li class="pull-left header"><i class="fa fa-th"></i> Kelas</li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active">
            <form method="post">
              <center>
                <b>Rekap Absen</b>
                <p class="text-muted">Pilih kelas</p>
                <select class="form-control" name="kelas" style="width:30%">
                  <option value="" slected hidden>--Pilih Kelas--</option>
                  <?php foreach ($kelas as $val) :
                    if ($this->input->post('kelas') == $val->id_kelas) {
                      $selected = "selected";
                    } else {
                      $selected = '';
                    }
                  ?>
                    <option value="<?= $val->id_kelas ?>" <?= $selected ?>><?= $val->kelas; ?></option>
                  <?php endforeach; ?>
                </select>
                <input type="hidden" name="mapel" value="<?= $this->session->userdata('id_mapel')?>">
                    
                <!-- <br /> -->
                <!-- <input type="text" class="form-control date" id="datepickerTEXT" style="width:30%" value="08/2020"> -->
                <br />
                <button class="btn btn-success">Pilih</button>
                <a href="<?= site_url('data-rekap'); ?>" class="btn btn-warning">Reset</a>
              </center>
            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
    </div>

    <!-- <?php foreach ($absensi as $val) :
            echo date("M", $val->time_in);
            echo $val->keterangan;
          endforeach; ?> -->
    <form method="post" action="<?= site_url('cetak-rekap');?>">
      <div class="col-md-12">
        <!-- Custom Tabs (Pulled to the right) -->
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li class="pull-left header"><i class="fa fa-users"></i> Data Rekap Absensi</li>
            <?php if($_SERVER['REQUEST_METHOD'] === 'POST') :?>
            <li class="pull-right header"><button class="btn btn-success btn-sm" formtarget="_blank"><i class="fa fa-print"></i> Cetak</button></li>
            <?php endif;?>
          </ul>
        <div class="tab-content">
          <div class="tab-pane active">
                <table class="table table-hover table-striped" style="width:100%">
                  <thead>
                    <th>Bulan/Tahun</th>
                    <!-- <th>NIS</th> -->
                    <!-- <th>Nama</th> -->
                    <th>Sakit</th>
                    <th>Ijin</th>
                    <th>Alpha</th>
                    <th>Jumlah tidak hadir</th>
                  </thead>
                  <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
                    <tbody>

                      <?php
                      foreach ($absensi as $val) :
                        $tot = $val->tSakit + $val->tIjin + $val->tAlpha;
                      ?>
                        <input type="hidden" name="kelas" value="<?= $kelask ?>">
                        <input type="hidden" name="mapel" value="<?= $mapelk ?>">
                        <tr>
                          <td><?= $val->bulan . '/' . $val->tahun; ?></td>
                          <td><?= $val->tSakit; ?></td>
                          <td><?= $val->tIjin; ?></td>
                          <td><?= $val->tAlpha; ?></td>
                          <td><?= $tot; ?></td>
                        </tr>
                      <?php endforeach; ?>

                    </tbody>
                  <?php } else { ?>
                    <tbody>
                      <tr>
                        <td colspan=5>
                          <center>
                            <small class="text-muted"><i>Pilih Kelas dan Mata Pelajaran</i></small>
                          </center>
                        </td>
                      </tr>
                    </tbody>
                  <?php } ?>
                </table>
                <br />

                <!-- <button class="btn btn-primary" disabled>Kirim Absensi</button> -->

            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
      </div>
    </form>

  </div>
</section>