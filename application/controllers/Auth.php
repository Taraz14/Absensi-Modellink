<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  /**
   * @author Taraz14(Meliodas)
   * @link https://github.com/Taraz14/Absensi-Modellink
   * Auth
   */
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->library(array('form_validation', 'secure_sess'));
    $this->load->model('auth_m');
  }

  public function index()
  {
    $this->form_validation->set_rules('username', 'Username', 'required|trim');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('backend/auth/login', [
        'title' => 'Absensi Modellink'
      ], FALSE);
    } else {
      $this->login();
      redirect('login');
      // var_dump($username);die();
    }
  }

  public function login()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    // var_dump($password);die();
    $valid    = $this->auth_m->login($username);

    if ($valid) {
      if (password_verify($password, $valid['password'])) {
        $this->_set_session_login($valid);
      } else {
        $this->session->set_flashdata('failed', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>
               Maaf, Username atau Password tidak sesuai!
            </div>');
      }
    } else {
      $this->session->set_flashdata('failed', '<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>
         Maaf, Username atau Password tidak sesuai!
      </div>');
    }
  }

  private function _set_session_login($valid)
  {
    if (!is_array($valid) || empty($valid)) {
      return false;
    }
    $data = [
      'id_user' => $valid['id_user'],
      'id_kelas' => $valid['id_kelas'],
      'id_mapel' => $valid['id_mapel'],
      'nama' => $valid['nama'],
      'username' => $valid['username'],
      'tipe' => $valid['tipe'],
      'is_login' => TRUE
      // 'since' => date('Y m d H:i:s', strtotime($valid['created_at']))
    ];
    $this->session->set_userdata($data);
    $userdata = $this->session->userdata();
    if ($userdata['tipe'] == 99) {
      redirect('admin');
    } else if ($userdata['tipe'] == 88) {
      redirect('guru');
    } else if ($userdata['tipe'] == 77) {
      redirect('sekretaris');
    }
  }

  public function logout()
  {
    $this->secure_sess->is_logout();
  }
}

/* End of file Auth.php */
