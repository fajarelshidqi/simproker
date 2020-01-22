<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_dosenluar extends CI_Model
{
	public function get_dosenLuar()
    {
        $this->db->select('*');
        $this->db->from('tb_dosenluar');
        $query = $this->db->get();
        return $query;
    }

    public function get_dosenLuarEdit($id)
    {
        $this->db->select('*');
        $this->db->from('tb_dosenluar');
        $this->db->where('id_dosenluar', $id);
        $query = $this->db->get();
        return $query;
    }

    public function insertimport($data)
    {
        $this->db->insert_batch('tb_dosenluar', $data);
    }
}
