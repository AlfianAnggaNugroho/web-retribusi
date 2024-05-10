<?php

class M_login extends CI_Model{

  public function cek_username($tabel,$username){
    return $this->db->select('username')
             ->from($tabel)
             ->where('username',$username)
             ->get()->result();
  }

  public function cek_user($tabel,$username){
    return  $this->db->select('*')
               ->from($tabel)
               ->where('username',$username)
               ->get();
  }

  function edit_user($where, $data)
	{
		$this->db->where($where);
		return $this->db->update('tb_user', $data);
	}

}?>