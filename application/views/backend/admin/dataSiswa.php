<section class="content">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Input Siswa dan Data Siswa</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form action="" method="post" id="form-siswa">
        <div class="form-group row">
          <label for="nis" class=" col-sm-2">NIS</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nis" id="nis" onblur="nisAvail()" placeholder="NIS 10 digit">
            <small class="nis"></small>
          </div>
        </div>
        <div class="form-group row">
          <label for="nama" class=" col-sm-2">Nama Lengkap</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
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
                <option value="<?= $val->id_agama ?>"><?= $val->agama; ?></option>
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
              <input type="text" class="form-control" id="lahirSiswa" name="tanggal_lahir" placeholder="-" readonly>
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
          <label for=kelas class=" col-sm-2">Kelas</label>
          <div class="col-sm-10">
            <select class="form-control" name="kelas">
              <option value="" selected hidden>--Pilih Kelas--</option>
              <?php foreach ($kelas as $val) : ?>
                <option value="<?= $val->id_kelas ?>"><?= $val->kelas ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-12">
            <div class="col-sm-2 pull-right">
              <a class="btn btn-success btn-block" id="save">Simpan <i class="fa fa-send"></i></a>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <h4>Data Siswa</h4>
      <hr>
      <!-- <div class="col-sm-1"></div> -->
      <!-- <div class="col-sm-10 text-center"> -->
      <table class="table table-hover table-striped" style="width:100%" id="dataSiswa">
        <thead>
          <th><i class="glyphicon glyphicon-chevron-left"></i><i class=" glyphicon glyphicon-chevron-right "></i></th>
          <th>No.</th>
          <th>Kelas</th>
          <th>NIS</th>
          <th>Nama</th>
          <th>No. HP</th>
          <th>Alamat</th>
          <th>Agama</th>
          <!-- <th>Tempat Lahir</th> -->
          <th>TTL</th>
          <th>Jenis Kelamin</th>
          <!-- <th style="width:50px">Aksi</th> -->
        </thead>
      </table>
      <!-- </div> -->
    </div>
  </div>

  <!-- ============================= -->

</section>
<script>
  var tableSiswa;

  function reload_table() {
    tableSiswa.ajax.reload(null, false); //reload datatable ajax 
  }

  $(function() {
    //ajax save
    $('#save').click(function() {
      var data = new FormData($('#form-siswa')[0]);
      $.ajax({
        type: 'post',
        url: '<?= site_url('admin/DataSiswa/addSiswa') ?>',
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,
        success: function(data) {
          console.log(data);
          if (data.status == true) {
            swal({
              title: 'Tambah Siswa',
              text: 'Siswa berhasil ditambahkan',
              icon: 'success'
            });
            reload_table();
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

    tableSiswa = $('#dataSiswa').DataTable({
      'responsive': true,
      "processing": true,
      "serverSide": true,
      // "scrollX": true,
      // "scrollY": "200px",
      "order": [],
      "ajax": {
        url: "<?= site_url('admin/DataSiswa/getSiswa') ?>",
      },
      buttons: [
        'excel'
      ],
      "columnDefs": [{
        "targets": 0,
        // "data": "download_link",
        // "render": function(data, type, row, meta) {
        //   return '<a href="' + data + '">Download</a>';
        // }
      }, {
        // "width": "10%",
        // "targets": 8
      }],
    });
  });

  //siswa borndate
  $('#lahirSiswa').datepicker({
    locale: {
      format: "dd-mm-yyyy"
    }
  });

  $("#nis").inputFilter(function(value) {
    return /^\d*$/.test(value) && (value === "" || parseInt(value.length) <= 10);
  });

  function nisAvail() {
    var nis = $('input[name="nis"]').val();
    $.ajax({
      type: "post",
      url: "<?= site_url('admin/DataSiswa/nisValid') ?>",
      data: {
        nis: nis
      },
      success: function(response) {
        if (nis == '') {
          $('.nis').html('<b><i style="color:red">Nis wajib diisi</i></b>');
        } else {
          if (nis.length < 10) {
            $('.nis').html('<b><i style="color:red">Nis tidak lengkap</i></b>');
          } else {
            if (response == true) {
              $('.nis').html('<b><i style="color:green">Nis dapat digunakan</i></b>');
            } else {
              $('.nis').html('<b><i style="color:red">Nis sudah terdaftar</i></b>');
            }
          }

        }
      }
    });
  }

  function hapusSiswa(id) {
    swal({
        title: "Yakin hapus Siswa?",
        text: "Jika sudah terhapus maka, tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: "<?= site_url('admin/DataSiswa/hapusSiswa/') ?>" + id,
            type: "post",
            dataType: "json",
            success: function(data) {
              swal("Sukses", "Satu Siswa telah dihapus!", {
                icon: "success",
              });
              reload_table();
            }
          });
        } else {
          swal("Batal", "Satu Siswa batal dihapus!", "error");
        }
      });
  }
</script>