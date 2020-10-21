<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekretaris_m extends CI_Model
{
  /**
   * saveSekretaris
   */
  public function saveSek($data)
  {
    $this->db->insert('user', $data);
    return $this->db->insert_id();
  }

  //nis
  public function nisExist($nis)
  {
    $this->db->select('nip')
      ->from('user')
      ->where('nip', $nis);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  /**
   * Hapus Sekretaris
   */
  public function hapusSek($id)
  {
    $this->db->where('id_user', $id);
    $this->db->delete('user');
  }

  /**
   * Datatables Query
   */
  private function querySek()
  {
    $this->db->select('*');
    $this->db->from('user u');
    $this->db->join('kelas k', 'u.id_kelas = k.id_kelas');
    $this->db->where('u.id_status', 4);
    $this->db->where('u.id_kelas >', 0);

    if ($this->input->get('search')['value']) {
      $this->db->like('k.kelas', $this->input->get('search')['value']);
      $this->db->or_like('u.nama', $this->input->get('search')['value']);
    }

    if ($this->input->get('order')) {
      $this->db->order_by(
        $this->input->get('order')['0']['column'],
        $this->input->get('order')['0']['dir']
      );
    } else {
      $this->db->order_by('u.submit_at', 'desc');
    }
  }

  public function dataSek()
  {
    $this->querySek();
    // self::querySek();
    if ($this->input->get('length') !== -1) {
      $this->db->limit($this->input->get('length'), $this->input->get('start'));
    }
    return $this->db->get()->result();
  }

  public function filtered()
  {
    $this->querySek();
    // self::querySek();
    return $this->db->get()->num_rows();
  }

  public function countAll()
  {
    $this->db->from('user');
    $this->db->where('id_status', 4);

    return $this->db->count_all_results();
  }
}

/* End of file Sekretaris_m.php */
