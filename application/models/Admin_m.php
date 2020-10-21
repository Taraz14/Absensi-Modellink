<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_m extends CI_Model
{
  public function getAgama()
  {
    return $this->db->get('agama')->result();
  }

  //Guru
  public function saveGuru($data)
  {
    $this->db->insert('user', $data);
    return $this->db->insert_id();
  }

  /**
   * Hapus Guru
   */
  public function hapusGuru($id)
  {
    $this->db->where('id_user', $id);
    $this->db->delete('user');
  }

  /**
   * Siswa
   */
  public function saveSiswa($data)
  {
    $this->db->insert('siswa', $data);
    return $this->db->insert_id();
  }

  public function addSek()
  {
  }

  /**
   * Hapus Siswa
   */
  public function hapusSiswa($id)
  {
    $this->db->where('id_siswa', $id);
    $this->db->delete('siswa');
  }

  //nis
  public function nisExist($nis)
  {
    $this->db->select('nis')
      ->from('siswa')
      ->where('nis', $nis);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  //nip
  public function nipExist($nip)
  {
    $this->db->select('nip')
      ->from('user')
      ->where('nip', $nip);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function usernameExist($username)
  {
    $this->db->select('username')
      ->from('user')
      ->where('username', $username);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  private function queryGuru()
  {
    $this->db->select('*');
    $this->db->from('user u');
    $this->db->join('status s', 'u.id_status = s.id_status');
    $this->db->join('agama a', 'u.id_agama = a.id_agama');
    $this->db->where('tipe', 88);

    if ($this->input->get('search')['value']) {
      $this->db->like('nama', $this->input->get('search')['value']);
      $this->db->or_like('tanggal_lahir', $this->input->get('search')['value']);
      $this->db->or_like('jenis_kelamin', $this->input->get('search')['value']);
      $this->db->or_like('nip', $this->input->get('search')['value']);
      $this->db->or_like('s.status', $this->input->get('search')['value']);
    }

    if ($this->input->get('order')) {
      $this->db->order_by(
        $this->input->get('order')['0']['column'],
        $this->input->get('order')['0']['dir']
      );
    } else {
      $this->db->order_by('submit_at', 'desc');
    }
  }

  public function dataGuru()
  {
    self::queryGuru();
    if ($this->input->get('length') !== -1) {
      $this->db->limit($this->input->get('length'), $this->input->get('start'));
    }
    return $this->db->get()->result();
  }

  public function filtered()
  {
    self::queryGuru();
    $this->db->where('tipe', 88);
    return $this->db->get()->num_rows();
  }

  public function countAll()
  {
    $this->db->from('user');
    $this->db->where('tipe', 88);
    return $this->db->count_all_results();
  }

  /**
   * Query Siswa
   */
  private function querySiswa()
  {
    $id_kelas = $this->session->userdata('id_kelas');
    $this->db->select('*');
    $this->db->from('siswa s');
    $this->db->join('agama a', 's.id_agama = a.id_agama', 'left');
    $this->db->join('kelas k', 's.id_kelas = k.id_kelas', 'left');
    // $this->db->where('s.id_kelas', $id_kelas);

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
      $this->db->order_by('k.kelas', 'asc');
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
}

/* End of file Admin_m.php */
