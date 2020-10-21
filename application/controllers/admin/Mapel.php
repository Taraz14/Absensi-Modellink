<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'admin_m', 'mapel_m'));
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
      'content' => 'backend/admin/mapel',
      'title'   => 'Mata Pelajaran',
      'profile' => $this->user_m->profile($id),
      'userdata' => $id
    ], FALSE);
  }

  public function saveMapel()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required|is_unique[mapel.nama_mapel]');
    if ($this->form_validation->run() == FALSE) {
      $this->form_validation->set_message('is_unique', '%s sudah ada');
      echo json_encode(array('status' => FALSE));
    } else {
      $data = [
        'nama_mapel' => $input['mapel']
      ];

      $this->mapel_m->saveMapel($data);
      echo json_encode(['status' => TRUE]);
    }
  }

  public function getMapel()
  {
    $data = $this->mapel_m->dataMapel();
    $peg = [];
    $no = 1;
    foreach ($data as $pegMapel) {
      $temp = [];
      $temp[] = htmlspecialchars($no++, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegMapel->nama_mapel, ENT_QUOTES, 'UTF-8');
      $temp[] = '
      <a href="' . site_url('edit-Mapel/') . $pegMapel->id_mapel . '" class="btn btn-default btn-sm" data-toggle="tooltip" title="Detail" target="">
          <i class="glyphicon glyphicon-pencil" style="color:#f39c12"></i>
      </a> 
      <a href="javascript:void(0)" onclick="hapusMapel(' . "'" . $pegMapel->id_mapel . "'" . ')" class="btn btn-default btn-sm" data-toggle="tooltip" title="Hapus" target="">
          <i class="glyphicon glyphicon-trash" style="color:#ff0000"></i>
      </a>';
      $peg[] = $temp;
    }

    $output['draw'] = intval($this->input->get('draw'));
    $output['recordsTotal'] = $this->mapel_m->countAll();
    $output['recordsFiltered'] = $this->mapel_m->filtered();
    $output['data'] = $peg;

    echo json_encode($output);
  }

  public function hapusMapel($id)
  {
    $this->mapel_m->hapusMapel($id);
    echo json_encode(array("status" => TRUE));
  }
}

/* End of file Controllername.php */
