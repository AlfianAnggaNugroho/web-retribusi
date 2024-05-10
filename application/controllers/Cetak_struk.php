<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak_struk extends CI_Controller {
  
    public function __construct() {
        parent::__construct();
        $this->load->model('M_struk'); // Load the retribusi_model
    }
    
    public function index($retribusiId) {
      $data['retribusi'] = $this->M_struk->get_retribusi_by_id($retribusiId);
      $this->load->view('report/cetak_struk', $data);
    }
  
}