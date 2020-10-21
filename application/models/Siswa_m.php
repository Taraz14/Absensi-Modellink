<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_m extends CI_Model
{
  /**
   * Query Siswa
   */
  private function querySiswa()
  {
    $id_kelas = $this->session->userdata('id_kelas');
    $this->db->select('*');
    $this->db->from('siswa s');
    $this->db->join('agama a', 's.id_agama = a.id_agama');
    $this->db->join('kelas k', 's.id_kelas = k.id_kelas');
    $this->db->where('s.id_kelas', $id_kelas);

    if ($this->input->get('search')['value']) {
      $this->db->like('nama', $this->input->get('search')['value']);
      $this->db->or_like('tanggal_lahir', $this->input->get('search')['value']);
      $this->db->or_like('jenis_kelamin', $this->input->get('search')['value']);
      $this->db->or_like('no_hp', $this->input->get('search')['value']);
      $this->db->or_like('a.agama', $this->input->get('search')['value']);
    }

    if ($this->input->get('order')) {
      $this->db->order_by(
        $this->input->get('order')['0']['column'],
        $this->input->get('order')['0']['dir']
      );
    } else {
      $this->db->order_by('s.id_siswa', 'desc');
    }
  }

  public function dataSiswa()
  {
    self::querySiswa();
    if ($this->input->get('length') !== -1) {
      $this->db->limit($this->input->get('length'), $this->input->get('start'));
    }
    return $this->db->get()->result();
  }

  public function filteredSiswa()
  {
    self::querySiswa();
    return $this->db->get()->num_rows();
  }

  public function countAllSiswa()
  {
    $this->db->from('siswa');
    return $this->db->count_all_results();
  }

  public function getDataSiswa($id_siswa){
    $this->db->select('*');
    $this->db->from('siswa');
    $this->db->where('id_siswa', $id_siswa);
   return $this->db->get()->row();
  }

  public function saveEditSiswa($data, $id_siswa){
    return $this->db->replace('siswa', $data, $id_siswa);
    
  }

  public function getSiswa($id_kelas)
  {
    $this->db->select('*');
    $this->db->from('siswa');
    $this->db->where('id_kelas', $id_kelas);
    return $this->db->get()->result();
  }
}

/* End of file Siswa_m.php */
