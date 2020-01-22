<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_hdl extends CI_Model
{
	public function get_hdl()
	{
		$this->db->select('*');
		$this->db->from('tb_honor_dosenluar');
		$this->db->join('tb_matakuliah', 'tb_matakuliah.id_mk=tb_honor_dosenluar.id_mk');
		$this->db->join('tb_dosenluar', 'tb_dosenluar.id_dosenluar=tb_honor_dosenluar.id_dosenluar');
		$this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_matakuliah.id_kelas', 'left');
		$query = $this->db->get();
		return $query;
	}

	public function get_filterHdl($bulan1,$bulan2,$kelas)
	{
		$this->db->select('*');
		$this->db->from('tb_honor_dosenluar');
		$this->db->join('tb_matakuliah', 'tb_matakuliah.id_mk=tb_honor_dosenluar.id_mk');
		$this->db->join('tb_dosenluar', 'tb_dosenluar.id_dosenluar=tb_honor_dosenluar.id_dosenluar');
		$this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_matakuliah.id_kelas', 'left');
        $this->db->where('bulanpertama', $bulan1);
        $this->db->where('bulankedua', $bulan2);
        $this->db->where('tb_kelas.id_kelas', $kelas);
		$query = $this->db->get();
		return $query;
	}

	public function get_hdlEdit($id)
	{
		$this->db->select('*');
		$this->db->from('tb_honor_dosenluar');
		$this->db->join('tb_matakuliah', 'tb_matakuliah.id_mk=tb_honor_dosenluar.id_mk');
		$this->db->join('tb_dosenluar', 'tb_dosenluar.id_dosenluar=tb_honor_dosenluar.id_dosenluar');
		$this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_matakuliah.id_kelas', 'left');
		$this->db->where('id_honor_dosenluar', $id);
		$query = $this->db->get();
		return $query;
	}

	public function insertimport($data)
    {
        $this->db->insert_batch('tb_proker', $data);
    }
}
