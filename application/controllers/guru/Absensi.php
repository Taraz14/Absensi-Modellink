<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'kelas_m', 'siswa_m', 'guru_m'));
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
    $id_kelas = $this->input->post('kelas');
    // echo $id_kelas;
    // // die();
    $this->load->view('backend/layouts/wrapper', [
      'content' => 'backend/guru/absensi',
      'title' => 'Absensi',
      'profile' => $this->user_m->profile($id),
      'kelas' => $this->kelas_m->getKelas(),
      'siswa' => $this->siswa_m->getSiswa($id_kelas),
      'userdata' => $id,
      'id_kelas' => $id_kelas
    ], FALSE);
  }

  public function saveAbsensi()
  {
    $input = $this->input->post();
    $id_mapel = $input['id_mapel'];
    $id_kelas = $input['id_kelas'];
    $index = 0;
    foreach ($input['id_siswa'] as $key => $val) {
      // array_push($data, [
      // $time = array(time());
      $data = [
        'id_siswa' => $input['id_siswa'][$key],
        'id_mapel' => $input['id_mapel'],
        'id_kelas' => $input['id_kelas'],
        'time_in' => time(),
        'tanggal' => date("d"),
        'bulan' => date("m"),
        // 'bulan' => '10',
        'tahun' => date("Y"),
        'keterangan' => $input['keterangan'][$key]
      ];
      // $index++;
      // $json = json_encode($data);
      // echo $json;
      // var_dump($data);
      $this->guru_m->saveAbsen($data);
    }
    redirect('gr/absensi');
  }
}

/* End of file Absensi.php */
