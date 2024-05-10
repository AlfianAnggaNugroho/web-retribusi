<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_retribusi_b_bayar extends CI_Model
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

    public function get_data_sorted($table, $order_by, $order_type)
    {
        $this->db->order_by($order_by, $order_type);
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

    public function get_data_by_id($id)
    {
        $this->db->where('id_retribusi', $id);
        return $this->db->get('tb_retribusi_b_byr')->row();
    }

    public function delete_data($id)
    {
        $this->db->where('id_retribusi', $id);
        $this->db->delete('tb_retribusi_b_byr');
    }


}