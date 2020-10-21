<section class="content">
  <div class="row">

    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">
            Tambah Guru
          </h3>
        </div>
        <form action="<?= site_url('admin/DataGuru/saveGuru'); ?>" method="post" id="form-guru">
          <div class="box-body">
            <div class="form-group row">
              <label for="nip" class=" col-sm-2">NIP/NUPTK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nip" id="nip" onblur="nipAvail()" placeholder="NIP/NUPTK 18 digit">
                <small class="nip"><i class="text-muted">Jika NUPTK kurang dari 18, tambahkan digit 0 di bagian depan.</i></small>
              </div>
            </div>
            <div class="form-group row">
              <label for="nama" class=" col-sm-2">Nama Lengkap</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
              </div>
            </div>
            <div class="form-group row">
              <label for="username" class=" col-sm-2">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="username" onblur="userNameAvail()" placeholder="Username">
                <small class="uname"></small>
              </div>
            </div>
            <div class="form-group row">
              <label for="no_hp" class=" col-sm-2">Nomor HP</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="no_hp" placeholder="+62-812-3456-7890">
              </div>
            </div>

            <div class="form-group row">
              <label for="alamat" class=" col-sm-2">Alamat</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="alamat" placeholder="Alamat Lengkap">
              </div>
            </div>
            <div class="form-group row">
              <label for="agama" class=" col-sm-2">Agama</label>
              <div class="col-sm-10">
                <select class="form-control" name="agama">
                  <option value="" selected hidden>--Pilih Agama--</option>
                  <?php foreach ($agama as $val) : ?>
                    <option value="<?= $val->id_agama ?>"><?= $val->agama ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="tempat_lahir" class=" col-sm-2">Tempat/Tanggal Lahir</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir">
              </div>
              <div class="col-sm-5">
                <div class="input-group">
                  <input type="text" class="form-control" id="lahirGuru" name="tanggal_lahir" placeholder="08-08-1998" readonly>
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
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="status" class=" col-sm-2">Status</label>
              <div class="container row">
                <div class="col-sm-4">
                  <input type="radio" name="status" value="2"> PNS
                  &nbsp;
                  <input type="radio" name="status" vlaue="3"> Honorer
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="mapel" class=" col-sm-2">Mata Pelajaran</label>
              <div class="col-sm-10">
                <select class="form-control" name="mapel">
                  <option value="" selected hidden>--Pilih Mata Pelajaran--</option>
                  <?php foreach ($mapel as $ma) : ?>
                    <option value="<?= $ma->id_mapel; ?>"><?= $ma->nama_mapel ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <label class="col-sm-4 "></label>
                <div class="row">
                  <div class="col-sm-2">
                    <a class="btn btn-success btn-block" id="save">Simpan <i class="fa fa-send"></i></a>
                  </div>
                  <div class="col-sm-2">
                    <a href="<?= site_url('data-guru'); ?>" class="btn btn-danger btn-block">Kembali <i class="fa fa-chevron-left"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>
<script>
  //ajax save
  $('#save').click(function() {
    var data = new FormData($('#form-guru')[0]);
    $.ajax({
      type: 'post',
      url: '<?= site_url('admin/DataGuru/saveGuru') ?>',
      contentType: false,
      processData: false,
      dataType: 'json',
      data: data,
      success: function(data) {
        console.log(data);
        if (data.status == true) {
          swal({
            title: 'Tambah Guru',
            text: 'Guru berhasil ditambahkan',
            icon: 'success'
          });
        } else {
          swal({
            title: 'Gagal',
            text: 'Tidak diketahui',
            icon: 'error',
            dangerMode: 'true'
          })
        }
      }

    })
  })

  //pegawai borndate
  $('#lahirGuru').datepicker({
    locale: {
      format: "dd-mm-yyyy"
    }
  });

  $("#nip").inputFilter(function(value) {
    return /^\d*$/.test(value) && (value === "" || parseInt(value.length) <= 18);
  });

  function userNameAvail() {
    var username = $('input[name="username"]').val();
    $.ajax({
      type: "post",
      url: "<?= site_url('admin/DataGuru/unameValid') ?>",
      data: {
        username: username
      },
      success: function(response) {
        if (username == '') {
          $('.uname').html('<b><i style="color:red">Username wajib diisi</i></b>');
        } else {
          if (response == true) {
            $('.uname').html('<b><i style="color:green">Username dapat digunakan</i></b>');
          } else {
            $('.uname').html('<b><i style="color:red">Username sudah terdaftar</i></b>');
          }

        }
      }
    });
  }

  function nipAvail() {
    var nip = $('input[name="nip"]').val();
    $.ajax({
      type: "post",
      url: "<?= site_url('admin/DataGuru/nipValid') ?>",
      data: {
        nip: nip
      },
      success: function(response) {
        if (nip == '') {
          $('.nip').html('<b><i style="color:red">Nip wajib diisi</i></b>');
        } else {
          if (nip.length < 10) {
            $('.nip').html('<b><i style="color:red">Nip tidak lengkap</i></b>');
          } else {
            if (response == true) {
              $('.nip').html('<b><i style="color:green">Nip dapat digunakan</i></b>');
            } else {
              $('.nip').html('<b><i style="color:red">Nip sudah terdaftar</i></b>');
            }
          }

        }
      }
    });
  }
</script>