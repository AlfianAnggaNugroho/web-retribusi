<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profile extends CI_Model {

    public function get_data($table)
    {
        return $this->db->get($table); 
    }

    public function update_data($data, $table)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->update($table, $data);
    }

    public function get_data_user($username)
    {
        return $this->db->get_where('tb_user', array('username' => $username));
    }



}