<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_hdd extends CI_Model
{
	public function get_hdd()
	{
		$this->db->select('*');
		$this->db->from('tb_honor_dosendalam');
		$this->db->join('tb_matakuliah', 'tb_matakuliah.id_mk=tb_honor_dosendalam.id_mk');
		$this->db->join('tb_dosendalam', 'tb_dosendalam.id_dosendalam=tb_honor_dosendalam.id_dosendalam');
		$this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_matakuliah.id_kelas', 'left');
		$query = $this->db->get();
		return $query;
	}

	public function get_filterHdd($bulan1,$bulan2,$kelas)
	{
		$this->db->select('*');
		$this->db->from('tb_honor_dosendalam');
		$this->db->join('tb_matakuliah', 'tb_matakuliah.id_mk=tb_honor_dosendalam.id_mk');
		$this->db->join('tb_dosendalam', 'tb_dosendalam.id_dosendalam=tb_honor_dosendalam.id_dosendalam');
		$this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_matakuliah.id_kelas', 'left');		
        $this->db->where('bulanpertama', $bulan1);
        $this->db->where('bulankedua', $bulan2);
        $this->db->where('tb_kelas.id_kelas', $kelas);
		$query = $this->db->get();
		return $query;
	}

	public function get_hddEdit($id)
	{
		$this->db->select('*');
		$this->db->from('tb_honor_dosendalam');
		$this->db->join('tb_matakuliah', 'tb_matakuliah.id_mk=tb_honor_dosendalam.id_mk');
		$this->db->join('tb_dosendalam', 'tb_dosendalam.id_dosendalam=tb_honor_dosendalam.id_dosendalam');
		$this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_matakuliah.id_kelas', 'left');
		$this->db->where('id_honor_dosendalam', $id);
		$query = $this->db->get();
		return $query;
	}

	public function insertimport($data)
    {
        $this->db->insert_batch('tb_proker', $data);
    }
}
