<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_koord extends CI_Model
{
	public function get_koord()
    {
        $this->db->select('*');
        $this->db->from('tb_koord');
        $this->db->join('tb_matakuliah', 'tb_matakuliah.id_mk = tb_koord.id_mk');
        $this->db->join('tb_dosendalam', 'tb_dosendalam.id_dosendalam = tb_koord.id_dosendalam');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_matakuliah.id_kelas', 'left');
        $query = $this->db->get();
        return $query;
    }

    public function get_dosenDalam()
    {
        $this->db->select('*');
        $this->db->from('tb_dosendalam');
        $query = $this->db->get();
        return $query;
    }

    public function get_koordEdit($id)
    {
        $this->db->select('*');
        $this->db->from('tb_koord');
        $this->db->join('tb_matakuliah', 'tb_matakuliah.id_mk = tb_koord.id_mk');
        $this->db->join('tb_dosendalam', 'tb_dosendalam.id_dosendalam = tb_koord.id_dosendalam');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_matakuliah.id_kelas', 'left');
        $this->db->where('id_koord', $id);        
        $query = $this->db->get();
        return $query;
    }

    public function get_ta()
    {
        $this->db->select('*');
        $this->db->from('tb_ta');
        $query = $this->db->get();
        return $query;
    }

    public function insertimport($data)
    {
        $this->db->insert_batch('tb_dosenluar', $data);
    }

    public function get_filterKoord($bulan1, $bulan2, $kelas)
    {
        $this->db->select('*');
        $this->db->from('tb_koord');
        $this->db->join('tb_matakuliah', 'tb_matakuliah.id_mk = tb_koord.id_mk');
        $this->db->join('tb_dosendalam', 'tb_dosendalam.id_dosendalam = tb_koord.id_dosendalam');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_matakuliah.id_kelas', 'left');
        $this->db->where('bulanpertama', $bulan1);
        $this->db->where('bulankedua', $bulan2);
        $this->db->where('tb_kelas.id_kelas', $kelas);
        $query = $this->db->get();
        return $query;
    }
}
