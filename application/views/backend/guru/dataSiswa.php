<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Data Siswa</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-striped" id="dataSiswa" style="width: 100%;">
        <thead>
          <!--<th>Aksi</th>-->
          <th>No.</th>
          <th>Kelas</th>
          <th>NIS</th>
          <th>Nama</th>
          <th>No. HP</th>
          <th>Alamat</th>
          <th>Agama</th>
          <th>TTL</th>
          <!-- <th>Tanggal Lahir</th> -->
          <th>Jenis Kelamin</th>
        </thead>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      SMK Modellink
    </div>
  </div>
</section>
<script>
  var tableSiswa;

  function reload_table() {
    tableSiswa.ajax.reload(null, false); //reload datatable ajax 
  }
  $(function() {
    tableSiswa = $('#dataSiswa').DataTable({
      'responsive': true,
      "processing": true,
      "serverSide": true,
      // "scrollX": true,
      // "scrollY": "200px",
      "order": [],
      "ajax": {
        url: "<?= site_url('guru/DataSiswa/getSiswa') ?>",
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

      responsive: true
    });
  });
</script>