<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Absensi_m Class
 * 
 * Class untuk mengatur data alternatif
 *
 * @package		absensi
 * @subpackage	Model
 * @category	Absensi_m
 * @author  	Fitri
 */

class Absensi_m extends CI_Model
{
  /**
   * Minimal Limit
   */
  const MIN_LIMIT = 1;

  /**
   * Instansiasi variable $db
   * 
   * @var object
   */
  private static $db;

  /**
   * Instansiasi variable input
   * 
   * @var array
   */
  private static $input;

  /**
   * Magic constructor
   */
  public function __construct()
  {
    parent::__construct();

    /**
     * Set value varible $db
     * @var object
     */
    self::$db = &get_instance()->db;

    /**
     * Set value varible $input
     * @var array
     */
    self::$input = &get_instance()->input;
  }

  public function getAbsen($kelas, $mapel, $bulan)
  {
    $string = "08,09,10";
    $array = array_map('intval', explode(',', $string));
    $array = implode("','", $array);
    var_dump($array);
    if ($kelas == NULL && $mapel == NULL) {
      return static::$db->query("SELECT 
                        COUNT(IF(keterangan='Sakit', 1, NULL)) as tSakit,
                        COUNT(IF(keterangan='Alpha', 1, NULL)) as tAlpha,
                        COUNT(IF(keterangan='Ijin', 1, NULL)) as tIjin,
                        COUNT(IF(keterangan='Hadir', 1, NULL)) as tHadir
                        FROM absensi")->result();
    } else {
      return static::$db->query("SELECT id_siswa, tanggal, bulan, tahun, id_kelas, id_mapel, time_in, keterangan,
                        COUNT(IF(keterangan='Sakit', 1, NULL)) as tSakit,
                        COUNT(IF(keterangan='Alpha', 1, NULL)) as tAlpha,
                        COUNT(IF(keterangan='Ijin', 1, NULL)) as tIjin,
                        COUNT(IF(keterangan='Hadir', 1, NULL)) as tHadir
                        FROM absensi
    WHERE (id_kelas = " . $kelas . " AND id_mapel = " . $mapel . " AND bulan IN ('".$array."'))")->result();
    }
  }

  public function getBulan($kelas, $mapel)
  {
    $where = ['id_kelas' => $kelas, 'id_mapel' => $mapel];
    $this->db->group_by('bulan');
    return $this->db->get_where('absensi', $where)->result();
  }

  //kode tambahan
  public function getLaporanPerKelas($kelas, $mapel){


    $this->db->distinct('keterangan');
    // $this->db->select('count(keterangan == "sakit") as jmlketerangansakit, keterangan, bulan,tahun');
    // $this->db->where(array('id_kelas' => $kelas, 'id_mapel' => $mapel, 'keterangan !='=>"Hadir"));
    // $this->db->group_by(array("bulan", "tahun", "keterangan"));
    // return $this->db->get('absensi')->result();


    $this->db->select("count(case when keterangan = 'Sakit' then 1 else null end) as tSakit,
                        count(case when keterangan = 'Ijin' then 1 else null end) as tIjin,
                        count(case when keterangan = 'Alpha' then 1 else null end) as tAlpha,bulan,tahun");
    
    $this->db->where(array('id_kelas' => $kelas, 'id_mapel' => $mapel, 'keterangan !='=>"Hadir"));
    $this->db->group_by(array("bulan", "tahun"));
    return $this->db->get('absensi')->result();

  }
  //end kode tambahan

  public function cetakRekap($kelas, $mapel, $bulan){
   $this->db->select('*')
            ->from('absensi a')
            ->join('siswa s', 'a.id_siswa = s.id_siswa')
            ->join('kelas k', 'a.id_kelas = k.id_kelas')
            ->join('mapel m', 'a.id_mapel = m.id_mapel')
            ->where(array('a.id_kelas' => $kelas, 'a.id_mapel' => $mapel, 'a.bulan' => $bulan));
    // $this->db->group_by('title');
    
   return $this->db->get()->result();
  }

  //cetak rekap
  public function kelas($kelas){
    $this->db->where('id_kelas', $kelas);
    return $this->db->get('kelas')->row();
    
  }

  public function mapel($mapel){
    $this->db->where('id_mapel', $mapel);
    return $this->db->get('mapel')->row();
    
  }
}

/* End of file Absensi_m.php */
