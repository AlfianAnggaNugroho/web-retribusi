<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_struk extends CI_Model {

    public function get_data($table)
    {
        return $this->db->get($table); 
    }

    public function get_retribusi_by_id($retribusiId) {
      $query = $this->db->get_where('tb_retribusi', array('id_retribusi' => $retribusiId));
      return $query->row();
    }
  

}