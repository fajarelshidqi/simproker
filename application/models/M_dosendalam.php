<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_dosendalam extends CI_Model
{
	public function get_dosenDalam()
    {
        $this->db->select('*');
        $this->db->from('tb_dosendalam');
        $query = $this->db->get();
        return $query;
    }

    public function get_dosenDalamEdit($id)
    {
        $this->db->select('*');
        $this->db->from('tb_dosendalam');
        $this->db->where('id_dosendalam', $id);
        $query = $this->db->get();
        return $query;
    }

    public function insertimport($data)
    {
        $this->db->insert_batch('tb_dosendalam', $data);
    }
}
