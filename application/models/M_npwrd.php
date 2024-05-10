<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_npwrd extends CI_Model {

    public function get_objek() {
        $query = $this->db->get('tb_objek');
        return $query->result();
    }
    public function get_wilayah() {
        $query = $this->db->get('tb_wilayah');
        return $query->result();
    }

    public function get_all()
    {
        return $this->db->get('tb_npwrd')->result();
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
        $this->db->where('id_npwrd', $data['id_npwrd']);
        $this->db->update($table, $data);
    }

    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    // Model M_npwrd.php
    public function is_npwrd_exists($npwrd)
    {
        $this->db->where('npwrd', $npwrd);
        $query = $this->db->get('tb_npwrd');
        return $query->num_rows() > 0;
    }

    public function get_npwrd_by_id($id)
    {
        $this->db->where('id_npwrd', $id);
        return $this->db->get('tb_npwrd')->row('npwrd');
    }



}