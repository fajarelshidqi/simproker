<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_dana_cair extends CI_Model
{
	public function get_danaCair()
    {
        $this->db->select('*');
        $this->db->from('tb_dana_cair');
        $this->db->join('tb_proker', 'tb_proker.id_proker = tb_dana_cair.id_proker');
        $this->db->join('tb_ta', 'tb_proker.id_ta = tb_ta.id_ta','left');
        $query = $this->db->get();
        return $query;
    }

    public function get_joinDanaCair($id)
    {
    	$this->db->select('*');
    	$this->db->from('tb_dana_cair');
    	$this->db->join('tb_proker', 'tb_proker.id_proker = tb_dana_cair.id_proker');
    	$this->db->where('id_dana_cair', $id);
    	$query = $this->db->get();
        return $query;
    }

    public function get_filter_danaCair($id_proker)
    {
    	$this->db->select('*');
        $this->db->from('tb_dana_cair');
        $this->db->join('tb_proker', 'tb_proker.id_proker = tb_dana_cair.id_proker');
        $this->db->join('tb_ta', 'tb_proker.id_ta = tb_ta.id_ta','left');
        $this->db->where('tb_proker.id_proker', $id_proker);
        $query = $this->db->get();
        return $query;
        // SELECT * FROM tb_dana_cair JOIN tb_proker ON tb_proker.id_proker = tb_dana_cair.id_proker Left join tb_ta on tb_ta.id_ta = tb_proker.id_ta WHERE tb_proker.id_proker = 286
    }
}