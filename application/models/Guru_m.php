<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_m extends CI_Model
{
  public function saveAbsen($data)
  {
    return $this->db->insert('absensi', $data);
  }
}

/* End of file Guru_m.php */
