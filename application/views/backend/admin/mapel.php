<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Input Mata Pelajaran</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form action="" method="post" id="form-mapel">
        <div class="form-group row">
          <label for="mapel" class=" col-sm-2 text-center">Mata Pelajaran</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="mapel" id="mapel" placeholder="Nama Mata Pelajaran">
          </div>
          <div class="col-sm-3">
            <a class="btn btn-primary btn-block" id="save">Simpan <i class="fa fa-send"></i></a>
          </div>
        </div>

      </form>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="row">
        <label for="mapel" class=" col-sm-2 text-center">Data Mata Pelajaran</label>
        <div class="col-sm-8">
          <table class="table table-hover table-striped" style="width:100%" id="dataMapel">
            <thead>
              <th>No.</th>
              <th>Mata Pelajaran</th>
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
  var tbMapel;

  function reload_table() {
    tbMapel.ajax.reload(null, false); //reload datatable ajax 
  }

  $(function() {
    tbMapel = $('#dataMapel').DataTable({
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "order": [],
      "ajax": {
        url: "<?= site_url('admin/Mapel/getMapel') ?>",
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

    //save Mapel
    $('#save').click(function() {
      var data = new FormData($('#form-mapel')[0]);
      var mapel = $('input[name="mapel"]').val();
      $.ajax({
        type: 'post',
        url: '<?= site_url('admin/Mapel/saveMapel') ?>',
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,
        success: function(data) {
          console.log(data);
          if (data.status == true) {
            swal({
              title: 'Tambah Mata Pelajaran',
              text: 'Mata Pelajaran berhasil ditambahkan',
              icon: 'success'
            });
            reload_table();
            $('input[name="mapel"]').val('');
          } else {
            if (mapel == '') {
              swal({
                title: 'Gagal',
                text: 'Harap isi Mata Pelajaran',
                icon: 'error',
                dangerMode: 'true'
              })
            } else {
              swal({
                title: 'Gagal',
                text: 'Mata Pelajaran Sudah Ada',
                icon: 'error',
                dangerMode: 'true'
              })

            }
          }
        }

      })
    });
  });

  function hapusMapel(id) {
    swal({
        title: "Yakin hapus Mata Pelajaran?",
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
            url: "<?= site_url('admin/Mapel/hapusMapel/') ?>" + id,
            type: "post",
            dataType: "json",
            success: function(data) {
              swal("Sukses", "Satu Mata Pelajaran telah dihapus!", {
                icon: "success",
              });
              reload_table();
            }
          });
        } else {
          swal("Batal", "Satu Mata Pelajaran batal dihapus!", "error");
        }
      });
  }
</script>