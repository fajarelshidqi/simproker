<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_proposal extends CI_Model
{
    public function get_proker()
    {
        $this->db->select('*');
        $this->db->from('tb_proker');
        $this->db->join('tb_ta', 'tb_proker.id_ta = tb_ta.id_ta');
        $query = $this->db->get();
        return $query;
    }

    public function get_filter_proker($id_proker)
    {
        $this->db->select('*');
        $this->db->from('tb_proker');
        $this->db->join('tb_ta', 'tb_ta.id_ta = tb_proker.id_ta');
        $this->db->where('id_proker', $id_proker);
        $query = $this->db->get();
        return $query;
    }

    public function get_filter_proposal($id_proker)
    {
        $this->db->select('*');
        $this->db->from('tb_proposal');
        $this->db->join('tb_proker', 'tb_proker.id_proker = tb_proposal.id_proker');
        $this->db->join('tb_ta', 'tb_ta.id_ta = tb_proker.id_ta', 'left');
        $this->db->where('tb_proposal.id_proker', $id_proker);
        $query = $this->db->get();
        return $query;
    }

	public function get_proposal()
    {
        $this->db->select('tb_proposal.*, tb_proker.nama_proker, tb_proker.dana_proker, tb_ta.tahun_ajaran, no_surat_proposal, tanggal_proposal, dana_proposal');
        $this->db->from('tb_proposal');
        $this->db->join('tb_proker', 'tb_proker.id_proker = tb_proposal.id_proker');
        $this->db->join('tb_ta', 'tb_ta.id_ta = tb_proker.id_ta', 'left');
        $this->db->order_by('id_proposal', 'DESC');
        $query = $this->db->get();
        return $query;
    }

	public function get_joinProposal($id)
	{
		$this->db->select('*');
		$this->db->from('tb_proposal');
		$this->db->join('tb_proker', 'tb_proker.id_proker=tb_proposal.id_proker');
		$this->db->where('id_proposal', $id);
		$query = $this->db->get();
		return $query;
	}

	public function insertimport($data)
    {
        $this->db->insert_batch('tb_proker', $data);
    }
}
