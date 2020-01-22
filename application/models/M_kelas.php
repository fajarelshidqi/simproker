<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_kelas extends CI_Model
{
	public function get_kelas()
    {
        $this->db->select('*');
        $this->db->from('tb_kelas');
        $query = $this->db->get();
        return $query;
    }

    public function get_kelasId($id)
    {
        $this->db->select('*');
        $this->db->from('tb_kelas');
        $this->db->where('id_kelas', $id);
        $query = $this->db->get();
        return $query;
    }
}
