<section class="content">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Penetapan Sekretaris</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form action="" method="post" id="form-sekretaris">
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
          <label for="kelas" class=" col-sm-2">Kelas</label>
          <div class="col-sm-10">
            <select class="form-control" name="kelas">
              <option value="" selected hidden>--Pilih Kelas--</option>
              <?php foreach ($kelas as $kl) : ?>
                <option value="<?= $kl->id_kelas; ?>"><?= $kl->kelas ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-12">
            <label class="col-sm-4 "></label>
            <div class="row">
              <div class="col-sm-4 text-center">
                <a class="btn btn-success btn-block" id="save">Simpan <i class="fa fa-send"></i></a>
              </div>
              <!-- <div class="col-sm-2">
                <a href="<?= site_url('data-guru'); ?>" class="btn btn-danger btn-block">Kembali <i class="fa fa-chevron-left"></i></a>
              </div> -->
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <h4>Data Sekretaris</h4>
      <hr>
      <!-- <div class="col-sm-1"></div> -->
      <!-- <div class="col-sm-10 text-center"> -->
      <table class="table table-hover table-striped" style="width:100%" id="dataSekre">
        <thead>
          <!-- <th><i class="glyphicon glyphicon-chevron-left"></i><i class=" glyphicon glyphicon-chevron-right "></i></th> -->
          <th>No.</th>
          <th>Kelas</th>
          <th>NIS</th>
          <th>Nama</th>
          <th>No. HP</th>
          <th style="width:50px">Aksi</th>
        </thead>
      </table>
      <!-- </div> -->
    </div>
  </div>

  <!-- ============================= -->

</section>
<script>
  var sekTable;

  function reload_table() {
    sekTable.ajax.reload(null, false); //reload datatable ajax 
  }
  $(function() {
    $('#save').click(function() {
      var data = new FormData($('#form-sekretaris')[0]);
      var kelas = $('[input="kelas"]').val();
      $.ajax({
        type: 'post',
        url: '<?= site_url('guru/DataSekretaris/saveSek') ?>',
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,
        success: function(data) {
          console.log(data);
          if (data.status == true) {
            swal({
              title: 'Tambah Sekretaris',
              text: 'Sekretaris berhasil ditambahkan',
              icon: 'success'
            });
            reload_table();

          } else {
            swal({
              title: 'Gagal',
              text: 'Periksa lagi',
              icon: 'error',
              dangerMode: 'true'
            });
          }
        }

      })
    });

    sekTable = $('#dataSekre').DataTable({
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "order": [],
      "ajax": {
        url: "<?= site_url('guru/DataSekretaris/getSek') ?>",
        'responsive': true
      },
      buttons: [
        'excel'
      ],
      "columnDefs": [{
        // "targets": [4, 6, 8, 9],
        "visible": false,
        "searchable": true
      }],
      // "bInfo": false
      // "width": "5%",
      // "targets": 0
    });
  });

  function nisAvail() {
    var nis = $('input[name="nis"]').val();
    $.ajax({
      type: "post",
      url: "<?= site_url('guru/DataSekretaris/nisValid') ?>",
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
              $('.nis').html('<b><i style="color:red">Nis sudah terdaftar sebagai sekretaris</i></b>');
            }
          }
        }
      }
    });
  }

  function hapusSek(id) {
    swal({
        title: "Yakin hapus Sekeretaris?",
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
            url: "<?= site_url('guru/DataSekretaris/hapusSek/') ?>" + id,
            type: "post",
            dataType: "json",
            success: function(data) {
              swal("Sukses", "Satu Sekeretaris telah dihapus!", {
                icon: "success",
              });
              reload_table();
            }
          });
        } else {
          swal("Batal", "Satu Sekeretaris batal dihapus!", "error");
        }
      });
  }

  $("#nis").inputFilter(function(value) {
    return /^\d*$/.test(value) && (value === "" || parseInt(value.length) <= 10);
  });
</script>