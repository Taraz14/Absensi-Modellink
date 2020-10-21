<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CetakRekap extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->library(array('form_validation', 'secure_sess'));
    $this->load->model(['absensi_m', 'user_m', 'kelas_m', 'mapel_m']);
    $this->load->helper('tanggal');
  }
  public function index()
  {
    // echo json_encode($this->absensi_m->getLaporanPerKelas(2, 1));
    $id = $this->session->userdata('id_user');
    $kelas = $this->input->post('kelas');
    $mapel = $this->input->post('mapel');
    $bulan = date("m");
    // var_dump($bulan);die();
    $data = [
      'title'   => 'Cetak Absensi',
      'profile' => $this->user_m->profile($id),
      'userdata' => $id,
      'absensi' => $this->absensi_m->getLaporanPerKelas($kelas, $mapel),
      'cetak' => $this->absensi_m->cetakRekap($kelas, $mapel, $bulan),
      'bulan' => $this->absensi_m->getBulan($kelas, $mapel),
      'kelas' => $this->absensi_m->kelas($kelas),
      'mapel' => $this->absensi_m->mapel($mapel),
    ];
    $this->load->view('backend/cetak', $data, FALSE);
    
  }
}
