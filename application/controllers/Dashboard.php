<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_dashboard');      
        
    }

    public function index()
    {
        if (!$this->session->userdata('username')) {
            redirect(base_url('login')); // Redirect ke halaman login jika belum login
        }
    
        $data['title'] = 'Dashboard';
        $data['username'] = $this->session->userdata('username');
    
        $this->load->model('M_dashboard'); // Load model M_dashboard
    
        // Mengambil jumlah data retribusi berdasarkan tanggal hari ini
        $tanggalHariIni = date("Y-m-d"); // Format tanggal hari ini
        $data['dataRetribusi'] = $this->M_dashboard->getTotalRetribusiByDate(date('Y-m-d'));
        $data['jumlahDataRetribusi'] = $this->M_dashboard->countRetribusiByDate();
        $data['jumlahBelumBayar'] = $this->M_dashboard->numrows('tb_retribusi_b_byr');

        // Mendapatkan tanggal bulan lalu
        $tanggalBulanLalu = date('Y-m', strtotime('-1 month'));

        // Mengirim data ke tampilan
        $data['dataBulanlalu'] = $this->M_dashboard->getTotalRetribusiByLastMonth($tanggalBulanLalu);
        $data['jumlahDataBulanlalu'] = $this->M_dashboard->countRetribusiByLastMonth($tanggalBulanLalu);

        // Mengambil jumlah data NPWRD
        $data['dataNPWRD'] = $this->M_dashboard->numrows('tb_npwrd');
    
        // Mengambil jumlah data User
        $data['dataPetugas'] = $this->M_dashboard->numrows('tb_petugas');
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
    
}