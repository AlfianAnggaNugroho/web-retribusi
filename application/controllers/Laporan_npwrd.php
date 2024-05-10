<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_npwrd extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_laporan');
    }

    public function index()
    {
        $data['title'] = 'Laporan NPWRD';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('report/laporan_npwrd', $data);
        $this->load->view('templates/footer');
    }
}