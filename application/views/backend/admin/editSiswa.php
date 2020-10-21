<section class="content">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Siswa</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form action="" method="post" id="form-siswa">
          <input type="hidden" name="id_siswa" value="<?= $dataSiswa->id_siswa; ?>">
        <div class="form-group row">
          <label for="nis" class=" col-sm-2">NIS</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nis" id="nis" placeholder="NIS 10 digit" value="<?= $dataSiswa->nis; ?>">
            <small class="nis"></small>
          </div>
        </div>
        <div class="form-group row">
          <label for="nama" class=" col-sm-2">Nama Lengkap</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="<?= $dataSiswa->nama; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="no_hp" class=" col-sm-2">Nomor HP</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="no_hp" placeholder="+62-812-3456-7890" value="<?= $dataSiswa->no_hp; ?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="alamat" class=" col-sm-2">Alamat</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="alamat" placeholder="Alamat Lengkap" value="<?= $dataSiswa->alamat; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="agama" class=" col-sm-2">Agama</label>
          <div class="col-sm-10">
            <select class="form-control" name="agama">
              <option value="" selected hidden>--Pilih Agama--</option>
              <?php foreach ($agama as $val) : ?>
                <option value="<?= $val->id_agama ?>" <?php if($dataSiswa->id_agama == $val->id_agama){echo 'selected'; }?>><?= $val->agama; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="tempat_lahir" class=" col-sm-2">Tempat/Tanggal Lahir</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= $dataSiswa->tempat_lahir; ?>">
          </div>
          <div class="col-sm-5">
            <div class="input-group">
              <input type="text" class="form-control" id="lahirSiswa" name="tanggal_lahir" placeholder="-" value="<?= $dataSiswa->tanggal_lahir; ?>" readonly>
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="gender" class=" col-sm-2">Jenis Kelamin</label>
          <div class="col-sm-10">
            <select class="form-control" name="gender">
              <option value="" selected hidden>--Pilih Gender--</option>
              <option value="Laki-laki" <?php if($dataSiswa->jenis_kelamin == 'Laki-laki'){echo 'selected'; } ?>>Laki-laki</option>
              <option value="Perempuan" <?php if($dataSiswa->jenis_kelamin == 'Perempuan'){echo 'selected'; } ?>>Perempuan</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for=kelas class=" col-sm-2">Kelas</label>
          <div class="col-sm-10">
            <select class="form-control" name="kelas">
              <option value="" selected hidden>--Pilih Kelas--</option>
              <?php foreach ($kelas as $val) : ?>
                <option value="<?= $val->id_kelas ?>" <?php if($dataSiswa->id_kelas == $val->id_kelas){echo 'selected'; } ?>><?= $val->kelas ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-12">
            <div class="col-sm-2 pull-right">
              <a class="btn btn-success btn-block" id="save">Simpan <i class="fa fa-send"></i></a>
              <!-- <button class="btn btn-success btn-block">Save</button> -->
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.box-body -->
  </div>

  <!-- ============================= -->

</section>
<script>
      //siswa borndate
  $('#lahirSiswa').datepicker({
    locale: {
      format: "dd-mm-yyyy"
    }
  });


  $("#nis").inputFilter(function(value) {
    return /^\d*$/.test(value) && (value === "" || parseInt(value.length) <= 10);
  });

  $(function() {
    //ajax save
    $('#save').click(function() {
      var data = new FormData($('#form-siswa')[0]);
      $.ajax({
        type: 'post',
        url: '<?= site_url('admin/DataSiswa/saveEdit') ?>',
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,
        success: function(data) {
          console.log(data);
          if (data.status == true) {
            swal({
              title: 'Tambah Siswa',
              text: 'Data siswa berhasil diubah',
              icon: 'success'
            }).then(function() {
                window.location = "<?= site_url('admin/DataSiswa'); ?>";
            });
          } else {
            swal({
              title: 'Gagal',
              text: 'Periksa lagi',
              icon: 'error',
              dangerMode: 'true'
            })
          }
        }

      })
    });
  });
</script>