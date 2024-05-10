<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tambah extends CI_Model
{

    public function get_petugas()
    {
        $query = $this->db->get('tb_petugas');
        return $query->result();
    }

    public function get_npwrd()
    {
        $query = $this->db->get('tb_npwrd');
        return $query->result();
    }

    public function get_wilayah()
    {
        $query = $this->db->get('tb_wilayah');
        return $query->result();
    }

    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update_data($data, $table)
    {
        $this->db->where('id_retribusi', $data['id_retribusi']);
        $this->db->update($table, $data);
    }

    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

}