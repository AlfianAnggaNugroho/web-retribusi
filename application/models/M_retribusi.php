<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_retribusi extends CI_Model {

    public function get_petugas() {
        $query = $this->db->get('tb_petugas');
        return $query->result();
    }

    public function get_npwrd() {
        $query = $this->db->get('tb_npwrd');
        return $query->result();
    }

    public function get_wilayah() {
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

    public function sum_retribusi()
    {
        $sql = "SELECT sum(nilai_retribusi) as nilai_retribusi FROM tb_retribusi";
        $result = $this->db->query($sql);
        return $result->row()->nilai_retribusi;
    }

}