<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataSekretaris extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'kelas_m', 'sekretaris_m'));
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
      'content' => 'backend/admin/dataSekretaris',
      'title'   => 'Data Sekretaris',
      'profile' => $this->user_m->profile($id),
      'kelas' => $this->kelas_m->getKelas(),
      'userdata' => $id
    ], FALSE);
  }

  public function nisValid()
  {
    $nis = $this->input->post('nis');
    $exists = $this->sekretaris_m->nisExist($nis);
    $count = count($exists);
    if (empty($count)) {
      echo true;
    } else {
      echo false;
    }
  }


  public function saveSek()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $this->form_validation->set_rules('nis', 'NIS', 'required|min_length[10]|is_unique[user.nip]');
    $this->form_validation->set_rules('kelas', 'Kelas', 'required|is_unique[user.id_kelas]');
    if (!$this->form_validation->run()) {
      $data = [
        'nis' => form_error('nis'),
        'id_kelas' => form_error('id_kelas')
      ];
      echo json_encode(['status' => FALSE]);
    } else {
      $data = [
        'id_mapel' => 0,
        'id_kelas' => $input['kelas'],
        'id_agama' => 0,
        'id_status' => 4,
        'nip' => $input['nis'],
        'nama' => $input['nama'],
        'username' => $input['nis'],
        'password' => password_hash($input['nis'], PASSWORD_DEFAULT),
        'no_hp' => $input['no_hp'],
        'alamat' => '',
        'tempat_lahir' => '',
        'jenis_kelamin' => $input['gender'],
        'file' => NULL,
        'tipe' => 77,
        'submit_at' => time()
      ];
      $this->sekretaris_m->saveSek($data);
      echo json_encode(['status' => TRUE]);
    }
  }

  public function getSek()
  {
    $data = $this->sekretaris_m->dataSek();
    $peg = [];
    $no = 1;
    foreach ($data as $pegSek) {
      $temp = [];
      $temp[] = htmlspecialchars($no++, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegSek->kelas, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegSek->nip, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegSek->nama, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegSek->no_hp, ENT_QUOTES, 'UTF-8');
      // if ($pegSek->id_user == 0) {
      //   $temp[] = '<span class="badge "><i>' . htmlspecialchars('Belum Tersedia', ENT_QUOTES, 'UTF-8') . '</i></span>';
      // } else {
      //   $temp[] = '<span class="badge bg-green"><i>' . htmlspecialchars($pegSek->nama, ENT_QUOTES, 'UTF-8') . '</i></span>';
      // }
      $temp[] = '
      <a href="' . site_url('edit-Sek/') . $pegSek->id_user . '" class="btn btn-default btn-sm" data-toggle="tooltip" title="Detail" target="">
          <i class="glyphicon glyphicon-pencil" style="color:#f39c12"></i>
      </a> 
      <a href="javascript:void(0)" onclick="hapusSek(' . "'" . $pegSek->id_user . "'" . ')" class="btn btn-default btn-sm" data-toggle="tooltip" title="Hapus" target="">
          <i class="glyphicon glyphicon-trash" style="color:#ff0000"></i>
      </a>';
      $peg[] = $temp;
    }

    $output['draw'] = intval($this->input->get('draw'));
    $output['recordsTotal'] = $this->sekretaris_m->countAll();
    $output['recordsFiltered'] = $this->sekretaris_m->filtered();
    $output['data'] = $peg;

    echo json_encode($output);
  }

  public function hapusSek($id)
  {
    $this->sekretaris_m->hapusSek($id);
    echo json_encode(array("status" => TRUE));
  }
}

/* End of file DataSekretaris.php */
