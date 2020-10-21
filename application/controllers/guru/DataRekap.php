<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataRekap extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'absensi_m', 'kelas_m', 'mapel_m'));
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
    $kelas = $this->input->post('kelas');
    $mapel = $this->input->post('mapel');
    $data = [
      'content' => 'backend/guru/dataRekap',
      'title'   => 'Rekap Bulanan',
      'profile' => $this->user_m->profile($id),
      'userdata' => $id,
      'absensi' => $this->absensi_m->getLaporanPerKelas($kelas, $mapel),
      'bulan' => $this->absensi_m->getBulan($kelas, $mapel),
      'kelas' => $this->kelas_m->getKelas(),
      'mapel' => $this->mapel_m->getMapel(),
      'kelask' => $kelas,
      'mapelk' => $mapel
    ];
    $this->load->view('backend/layouts/wrapper', $data, FALSE);
    // die();
    // $kelas = 2;
    // $mapel = 1;
  }
}

/* End of file DataRekap.php */
