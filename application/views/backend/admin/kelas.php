<style>
  /* div.dataTables_wrapper {
    margin: 0 auto;
    width: 65%;
  } */
</style>
<section class="content">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Input Kelas</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form action="" method="post" id="form-kelas">
        <div class="form-group row">
          <label for="kelas" class=" col-sm-2 text-center">Kelas</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="kelas" id="kelas" placeholder="Nama Kelas">
          </div>
          <div class="col-sm-3">
            <a class="btn btn-warning btn-block" id="save">Simpan <i class="fa fa-send"></i></a>
          </div>
        </div>

      </form>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="row">
        <label for="dataKelas" class=" col-sm-2 text-center">Data Kelas</label>
        <div class="col-sm-8">
          <table class="table table-hover table-striped" style="width:100%" id="dataKelas">
            <thead>
              <th>No.</th>
              <!-- <th>Kelas</th> -->
              <th>Sekretaris</th>
              <th>Aksi</th>
            </thead>
          </table>
        </div>
        <div class="col-sm-2"></div>
      </div>
    </div>
  </div>
</section>
<script>
  var tbKelas;

  function reload_table() {
    tbKelas.ajax.reload(null, false); //reload datatable ajax 
  }

  $(function() {
    //datatables
    tbKelas = $('#dataKelas').DataTable({
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "order": [],
      "ajax": {
        url: "<?= site_url('admin/Kelas/getKelas') ?>",
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
      "bInfo": false
    });

    //saveKelas
    $('#save').click(function() {
      var data = new FormData($('#form-kelas')[0]);
      var kelas = $('input[name="kelas"]').val();
      $.ajax({
        type: 'post',
        url: '<?= site_url('admin/Kelas/saveKelas') ?>',
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,
        success: function(data) {
          console.log(data);
          if (data.status == true) {
            swal({
              title: 'Tambah Kelas',
              text: 'Kelas berhasil ditambahkan',
              icon: 'success'
            });
            reload_table();
            $('input[name="kelas"]').val('');
          } else {
            if (kelas == '') {
              swal({
                title: 'Gagal',
                text: 'Harap isi Nama Kelas',
                icon: 'error',
                dangerMode: 'true'
              })
            } else {
              swal({
                title: 'Gagal',
                text: 'Kelas Sudah Ada',
                icon: 'error',
                dangerMode: 'true'
              })

            }
          }
        }
      })
    });
  });

  function hapusKelas(id) {
    swal({
        title: "Yakin hapus Kelas?",
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
            url: "<?= site_url('admin/Kelas/hapusKelas/') ?>" + id,
            type: "post",
            dataType: "json",
            success: function(data) {
              swal("Sukses", "Satu Kelas telah dihapus!", {
                icon: "success",
              });
              reload_table();
            }
          });
        } else {
          swal("Batal", "Satu Kelas batal dihapus!", "error");
        }
      });
  }
</script>