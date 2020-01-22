<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_matakuliah extends CI_Model
{
	public function get_mk()
    {
        $this->db->select('*');
        $this->db->from('tb_matakuliah');
        $this->db->join('tb_kelas','tb_matakuliah.id_kelas = tb_kelas.id_kelas');
        $query = $this->db->get();
        return $query;
    }

    public function get_mkEdit($id)
    {
    	$this->db->select('*');
        $this->db->from('tb_matakuliah');
        $this->db->join('tb_kelas','tb_matakuliah.id_kelas = tb_kelas.id_kelas');
        $this->db->where('id_mk', $id);
        $query = $this->db->get();
        return $query;
    }

    public function insertimport($data)
    {
        $this->db->insert_batch('tb_matakuliah', $data);
    }
}
