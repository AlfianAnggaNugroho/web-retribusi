<?php

class M_user extends CI_Model
{

    public function get_data($table)
    {
        return $this->db->get($table); 
    }

  public function insert($data,$tabel)
  {
    $this->db->insert($tabel,$data);
  }

  public function select($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
  }

  public function update($tabel,$data,$where)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function update_data($data, $table)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->update($table, $data);
    }

  public function delete($tabel,$where)
  {
    $this->db->where($where);
    $this->db->delete($tabel);
  }


  public function update_password($tabel,$where,$data)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }


  public function numrows($tabel)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->get();
    return $query->num_rows();
  }

  public function kecuali($tabel,$username)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where_not_in('username',$username)
                      ->get();

    return $query->result();
  }

  public function join($tabel,$tabeljoin,$join){
    $this->db->join($tabeljoin,$join);
    $this->db->get($tabel);

  }


}



 ?>