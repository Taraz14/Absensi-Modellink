<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'admin_m', 'kelas_m'));
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
      'content' => 'backend/admin/kelas',
      'title'   => 'Kelas',
      'profile' => $this->user_m->profile($id),
      'userdata' => $id
    ], FALSE);
  }

  public function saveKelas()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $this->form_validation->set_rules('kelas', 'Kelas', 'required|is_unique[kelas.kelas]');
    if ($this->form_validation->run() == FALSE) {
      $this->form_validation->set_message('is_unique', '%s sudah ada');
      echo json_encode(array('status' => FALSE));
    } else {
      $data = [
        'kelas' => $input['kelas']
      ];

      $this->kelas_m->saveKelas($data);
      echo json_encode(['status' => TRUE]);
    }
  }

  public function getKelas()
  {
    $data = $this->kelas_m->dataKelas();
    $peg = [];
    $no = 1;
    foreach ($data as $pegKelas) {
      $temp = [];
      $temp[] = htmlspecialchars($no++, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegKelas->kelas, ENT_QUOTES, 'UTF-8');
      // if ($pegKelas->id_user == 0) {
      //   $temp[] = '<span class="badge "><i>' . htmlspecialchars('Belum Tersedia', ENT_QUOTES, 'UTF-8') . '</i></span>';
      // } else {
      //   $temp[] = '<span class="badge bg-green"><i>' . htmlspecialchars($pegKelas->nama, ENT_QUOTES, 'UTF-8') . '</i></span>';
      // }
      $temp[] = '
      <a href="' . site_url('edit-Kelas/') . $pegKelas->id_kelas . '" class="btn btn-default btn-sm" data-toggle="tooltip" title="Detail" target="">
          <i class="glyphicon glyphicon-pencil" style="color:#f39c12"></i>
      </a> 
      <a href="javascript:void(0)" onclick="hapusKelas(' . "'" . $pegKelas->id_kelas . "'" . ')" class="btn btn-default btn-sm" data-toggle="tooltip" title="Hapus" target="">
          <i class="glyphicon glyphicon-trash" style="color:#ff0000"></i>
      </a>';
      $peg[] = $temp;
    }

    $output['draw'] = intval($this->input->get('draw'));
    $output['recordsTotal'] = $this->kelas_m->countAll();
    $output['recordsFiltered'] = $this->kelas_m->filtered();
    $output['data'] = $peg;

    echo json_encode($output);
  }

  public function hapusKelas($id)
  {
    $this->kelas_m->hapusKelas($id);
    echo json_encode(array("status" => TRUE));
  }
}

/* End of file Controllername.php */
