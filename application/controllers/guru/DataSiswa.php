<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataSiswa extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'admin_m', 'siswa_m'));
    if ($this->session->userdata('is_login') !== TRUE || $this->session->userdata('tipe') != 88) {
      $this->session->set_flashdata('failed', '<div class="alert alert-danger" role="alert">
                                       Maaf, Anda harus login!
                                       </div>');
      redirect('login');
    }
    //Do your magic here
  }

  public function index()
  {
    $id = $this->session->userdata('id_user');

    $this->load->view('backend/layouts/wrapper', [
      'content' => 'backend/guru/dataSiswa',
      'title'   => 'Data Siswa',
      'profile' => $this->user_m->profile($id),
      'userdata' => $id
    ], FALSE);
  }

  public function getSiswa()
  {
    $data = $this->admin_m->dataSiswa();
    $peg = [];
    $no = 1;
    foreach ($data as $pegSiswa) {
      $temp = [];
    //   $temp[] = '
    //   <div class="dropdown">
    //     <a class="btn btn-default btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //       <i class="glyphicon glyphicon-chevron-down" style="color:#0073b7"></i>
    //     </a>
    //     <div class="dropdown-menu">
    //       <li><a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="addSek(' . "'" . $pegSiswa->id_siswa . "'" . ')"><i class="fa fa-user"></i>Jadikan Sekretaris</a></li>
    //       <li><a role="menuitem" tabindex="-1" href="' . site_url('edit-Siswa/') . $pegSiswa->id_siswa . '" data-toggle="tooltip" title="Detail" target="">
    //         <i class="fa fa-pencil" style="color:#f39c12"></i>Edit
    //       </a></li>
    //       <li><a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="hapusSiswa(' . "'" . $pegSiswa->id_siswa . "'" . ')" data-toggle="tooltip" title="Hapus" target="">
    //          <i class="fa fa-trash" style="color:#ff0000"></i>Hapus
    //       </a></li>
    //     </div>      
    //   </div>';
      $temp[] = htmlspecialchars($no++, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegSiswa->kelas, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegSiswa->nis, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegSiswa->nama, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegSiswa->no_hp, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegSiswa->alamat, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegSiswa->agama, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegSiswa->tempat_lahir . ', ' . date("d-m-Y", strtotime($pegSiswa->tanggal_lahir)), ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegSiswa->jenis_kelamin, ENT_QUOTES, 'UTF-8');
      // $temp[] = htmlspecialchars($pegSiswa->status, ENT_QUOTES, 'UTF-8');

      // $temp[] = htmlspecialchars(date('d-m-Y / H:i', $pegSiswa->submit_at), ENT_QUOTES, 'UTF-8');

      $peg[] = $temp;
    }

    $output['draw'] = intval($this->input->get('draw'));
    $output['recordsTotal'] = $this->admin_m->countAllSiswa();
    $output['recordsFiltered'] = $this->admin_m->filteredSiswa();
    $output['data'] = $peg;

    echo json_encode($output);
  }
}

/* End of file DataSiswa.php */
