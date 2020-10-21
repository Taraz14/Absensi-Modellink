<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataSiswa extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'admin_m', 'kelas_m', 'siswa_m'));
    $this->load->library('form_validation');
    if ($this->session->userdata('is_login') !== TRUE || $this->session->userdata('tipe') != 99) {
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
      'content' => 'backend/admin/dataSiswa',
      'title'   => 'Data Siswa',
      'profile' => $this->user_m->profile($id),
      'agama' => $this->admin_m->getAgama(),
      'kelas' => $this->kelas_m->getKelas(),
      'userdata' => $id
    ], FALSE);
  }

  public function nisValid()
  {
    $nis = $this->input->post('nis');
    $exists = $this->admin_m->nisExist($nis);
    $count = count($exists);
    if (empty($count)) {
      echo true;
    } else {
      echo false;
    }
  }

  public function addSiswa()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $this->form_validation->set_rules('nis', 'NIS', 'required|min_length[10]|is_unique[siswa.nis]');
    if (!$this->form_validation->run()) {
      $data = [
        'nis' => form_error('nis'),
      ];
      echo json_encode(['status' => FALSE]);
    } else {
      $data = [
        'id_agama' => $input['agama'],
        'id_kelas' => $input['kelas'],
        'nis' => $input['nis'],
        'nama' => $input['nama'],
        'no_hp' => $input['no_hp'],
        'alamat' => $input['alamat'],
        'tempat_lahir' => $input['tempat_lahir'],
        'tanggal_lahir' => $input['tanggal_lahir'],
        'jenis_kelamin' => $input['gender']
      ];

      $this->admin_m->saveSiswa($data);
      echo json_encode(['status' => TRUE]);
    }
  }

  public function getSiswa()
  {
    $data = $this->admin_m->dataSiswa();
    $peg = [];
    $no = 1;
    foreach ($data as $pegSiswa) {
      $explode = explode('-', $pegSiswa->tanggal_lahir);
      // $tgl = $explode[2] . '-' . $explode[1] . '-' . $explode[0];
      $temp = [];
      // <li><a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="addSek(' . "'" . $pegSiswa->id_siswa . "'" . ')"><i class="fa fa-user"></i>Jadikan Sekretaris</a></li>
      $temp[] = '
      <div class="dropdown">
        <a class="btn btn-default btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="glyphicon glyphicon-chevron-down" style="color:#0073b7"></i>
        </a>
        <div class="dropdown-menu">
          <li><a role="menuitem" tabindex="-1" href="' . site_url('edit-siswa/') . $pegSiswa->id_siswa . '" data-toggle="tooltip" title="Detail" target="">
            <i class="fa fa-pencil" style="color:#f39c12"></i>Edit
          </a></li>
          <li><a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="hapusSiswa(' . "'" . $pegSiswa->id_siswa . "'" . ')" data-toggle="tooltip" title="Hapus" target="">
             <i class="fa fa-trash" style="color:#ff0000"></i>Hapus
          </a></li>
        </div>      
      </div>';
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

  public function editSiswa()
  {
    $id = $this->session->userdata('id_user');
    $id_siswa = $this->uri->segment(2);
    // var_dump($id_siswa);die();
    $this->load->view('backend/layouts/wrapper', [
      'content' => 'backend/admin/editSiswa',
      'title'   => 'Edit Data Siswa',
      'profile' => $this->user_m->profile($id),
      'agama' => $this->admin_m->getAgama(),
      'kelas' => $this->kelas_m->getKelas(),
      'userdata' => $id,
      'dataSiswa' => $this->siswa_m->getDataSiswa($id_siswa)
    ], FALSE);
  }

  public function saveEdit(){
    $input = $this->input->post();
    $id_siswa = $input['id_siswa'];
    // var_dump($id_siswa);die();
    // $this->form_validation->set_rules('nis', 'NIS', 'required|min_length[10]|is_unique[siswa.nis]');
    // if (!$this->form_validation->run()) {
    //   echo json_encode(['status' => FALSE]);
    // } else {
      $data = [
        'id_siswa' => $id_siswa,
        'id_agama' => $input['agama'],
        'id_kelas' => $input['kelas'],
        'nis' => $input['nis'],
        'nama' => $input['nama'],
        'no_hp' => $input['no_hp'],
        'alamat' => $input['alamat'],
        'tempat_lahir' => $input['tempat_lahir'],
        'tanggal_lahir' => $input['tanggal_lahir'],
        'jenis_kelamin' => $input['gender']
      ];

      $this->siswa_m->saveEditSiswa($data, $id_siswa);
      echo json_encode(['status' => TRUE]);
      // var_dump($data);
    // }

  }

  public function hapusSiswa($id)
  {
    $this->admin_m->hapusSiswa($id);
    echo json_encode(array("status" => TRUE));
  }
}

/* End of file DataSiswa.php */
