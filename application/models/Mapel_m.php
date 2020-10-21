<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel_m extends CI_Model
{
  /**
   * @author Taraz14(Meliodas)
   * Save Mapel
   */
  public function saveMapel($data)
  {
    $this->db->insert('mapel', $data);
    return $this->db->insert_id();
  }

  /**
   * Hapus Mapel
   */
  public function hapusMapel($id)
  {
    $this->db->where('id_mapel', $id);
    $this->db->delete('mapel');
  }

  public function getMapel()
  {
    return $this->db->get('mapel')->result();
  }

  /**
   * Datatables Query
   */
  private function queryMapel()
  {
    $this->db->select('*');
    $this->db->from('mapel');

    if ($this->input->get('search')['value']) {
      $this->db->like('nama_mapel', $this->input->get('search')['value']);
    }

    if ($this->input->get('order')) {
      $this->db->order_by(
        $this->input->get('order')['0']['column'],
        $this->input->get('order')['0']['dir']
      );
    } else {
      $this->db->order_by('id_mapel', 'desc');
    }
  }

  public function dataMapel()
  {
    self::queryMapel();
    if ($this->input->get('length') !== -1) {
      $this->db->limit($this->input->get('length'), $this->input->get('start'));
    }
    return $this->db->get()->result();
  }

  public function filtered()
  {
    self::queryMapel();
    return $this->db->get()->num_rows();
  }

  public function countAll()
  {
    $this->db->from('mapel');
    return $this->db->count_all_results();
  }
}

/* End of file Mapel_m.php */
