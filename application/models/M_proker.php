<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_proker extends CI_Model
{
	public function get_proker()
	{
		$this->db->select('*');
		$this->db->from('tb_proker');
		$this->db->join('tb_ta', 'tb_proker.id_ta=tb_ta.id_ta');
		$query = $this->db->get();
		return $query;
	}

	public function get_joinproker($id)
	{
		$this->db->select('*');
		$this->db->from('tb_proker');
		$this->db->join('tb_ta', 'tb_proker.id_ta=tb_ta.id_ta');
		$this->db->where('id_proker', $id);
		$query = $this->db->get();
		return $query;
	}

	public function insertimport($data)
    {
        $this->db->insert_batch('tb_proker', $data);
    }
}
