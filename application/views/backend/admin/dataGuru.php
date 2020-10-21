<section class="content">
  <div class="row">

    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">
            Data Guru
          </h3>
          <div class="pull-right box-tools">
            <a href="<?= site_url('add-guru'); ?>" class="btn btn-success">Tambah <i class="fa fa-users"></i></a>
          </div>
        </div>
        <!-- <form action=""> -->
        <div class="box-body">
          <table class="table table-bordered table-hover nowrap" id="guru" style="width:100%">
            <thead>
              <th>No.</th>
              <th>Username</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>No.HP</th>
              <th>Alamat</th>
              <th>Agama</th>
              <th>TTL</th>
              <th>Jenip Kelamin</th>
              <th>Status</th>
              <th>Aksi</th>
            </thead>
          </table>
        </div>
        <!-- </form> -->
      </div>
    </div>
  </div>
</section>
<script>
  var tableGuru;

  function reload_table() {
    tableGuru.ajax.reload(null, false); //reload datatable ajax 
  }

  $(function() {
    tableGuru = $('#guru').DataTable({
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      // "scrollY": "200px",
      "order": [],
      "ajax": {
        url: "<?= site_url('admin/DataGuru/getGuru') ?>",
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
    });
  });

  function hapusGuru(id) {
    swal({
        title: "Yakin hapus Guru?",
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
            url: "<?= site_url('admin/DataGuru/hapusGuru/') ?>" + id,
            type: "post",
            dataType: "json",
            success: function(data) {
              swal("Sukses", "Satu Guru telah dihapus!", {
                icon: "success",
              });
              reload_table();
            }
          });
        } else {
          swal("Batal", "Satu Guru batal dihapus!", "error");
        }
      });
  }
</script>