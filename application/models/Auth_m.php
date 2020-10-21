<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_m extends CI_Model
{
  private $user = 'user';

  public function login($username)
  {
    return $this->db->get_where($this->user, ['username' => $username])->row_array();
  }
}

/* End of file Auth.php */
