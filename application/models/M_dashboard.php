<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    public function get_data($table)
    {
        return $this->db->get($table); 
    }

    public function numrows($tabel)
    {
        $query = $this->db->select()
                        ->from($tabel)
                        ->get();
        return $query->num_rows();
    }

    public function getTotalRetribusiByDate($tanggal)
    {
        // Gantilah bagian ini dengan logika untuk menghitung total nilai retribusi
        // berdasarkan tanggal yang diberikan
        $this->db->where('tanggal', $tanggal);
        $this->db->select_sum('nilai_retribusi');
        $query = $this->db->get('tb_retribusi');
        return $query->row()->nilai_retribusi;
    }

    public function countRetribusiByDate() {
        // Menghitung jumlah data retribusi berdasarkan tanggal hari ini
        $today = date('Y-m-d');
        $this->db->where('tanggal', $today);
        $query = $this->db->get('tb_retribusi');
        return $query->num_rows();
    }

    public function getTotalRetribusiByLastMonth($tanggal)
    {
        $this->db->where("DATE_FORMAT(tanggal, '%Y-%m') = '$tanggal'", null, false);
        $this->db->select_sum('nilai_retribusi');
        $query = $this->db->get('tb_retribusi');

        if ($query->num_rows() > 0) {
            return $query->row()->nilai_retribusi;
        } else {
            return 0; // Mengembalikan 0 jika tidak ada data pada bulan lalu
        }
    }

    public function countRetribusiByLastMonth($tanggal) {
        $this->db->where("DATE_FORMAT(tanggal, '%Y-%m') = '$tanggal'", null, false);
        $query = $this->db->get('tb_retribusi');
        return $query->num_rows();
    }



    


}