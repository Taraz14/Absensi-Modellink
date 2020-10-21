<?php $id_mapel = $this->session->userdata('id_mapel'); ?>
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
                <b>Absensi Siswa</b>
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
                <br />
                <button class="btn btn-success">Pilih</button>
              </center>
            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
    </div>

    <!-- Absensi -->
    <div class="col-md-12">
      <!-- Custom Tabs (Pulled to the right) -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
          <li class="pull-left header"><i class="fa fa-users"></i> Absensi</li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active">
            <form action="<?= site_url('guru/absensi/saveAbsensi'); ?>" method="post" id="absen">
              <table class="table table-hover table-striped">
                <thead>
                  <th>Tanggal</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php foreach ($siswa as $sis) : ?>
                    <input type="hidden" name="id_siswa[]" value="<?= $sis->id_siswa; ?>">
                    <input type="hidden" name="id_kelas" value="<?= $id_kelas; ?>">
                    <input type="hidden" name="id_mapel" value="<?= $id_mapel; ?>">
                    <tr>
                      <td><?= date("d-m-Y") ?></td>
                      <td><?= $sis->nis; ?></td>
                      <td><?= $sis->nama; ?></td>
                      <td>
                        <select class="form-control" name="keterangan[]">
                          <option value="Hadir">Hadir</option>
                          <option value="Alpha">Alpha</option>
                          <option value="Ijin">Ijin</option>
                          <option value="Sakit">Sakit</option>
                        </select>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <br />
              <?php if ($this->input->post('kelas') == "") { ?>
                <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Pilih kelas dahulu" disabled>Kirim Absensi</button>
              <?php } else { ?>
                <button class="btn btn-primary">Kirim Absensi</button>
              <?php } ?>
              <!-- <button class="btn btn-primary" disabled>Kirim Absensi</button> -->

            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
    </div>
  </div>
</section>