<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_b_bayar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_laporan');

        if (!$this->session->userdata('username')) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        $data['title'] = 'Laporan belum bayar';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('report/laporan_b_bayar', $data);
        $this->load->view('templates/footer');
    }
}