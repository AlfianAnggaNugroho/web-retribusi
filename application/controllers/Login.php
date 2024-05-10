<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_login');
        
    }

    public function index()
    {
        // Pengecekan apakah pengguna sudah login
        if ($this->session->userdata('status') === 'login') {
            redirect(base_url('dashboard')); // Ganti dengan URL halaman yang sesuai
        } else {
            // Jika belum login, tampilkan halaman login
            $data['token_generate'] = $this->token_generate();
            $this->session->set_userdata($data);
            $this->load->view('login/login', $data);
        }
		
    }

    public function token_generate(){
        return $tokens = md5(uniqid(rand(), true));
    }

    public function proses_login(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);

            if ($this->session->userdata('token_generate') === $this->input->post('token')) {
                $cek = $this->M_login->cek_user('tb_user', $username);
                if ($cek->num_rows() != 1) {
                    $this->session->set_flashdata('msg', 'Username belum terdaftar!');
                    redirect(base_url('login'));
                } else {
                    $isi = $cek->row();
                    if (password_verify($password, $isi->password) === TRUE) {
                        $data_session = array(
                            'id_user' => $isi->id_user,
                            'username' => $username,
                            'status' => 'login',
                            'last_login' => $isi->last_login,
                            'us_level' => $isi->us_level // Menyimpan level pengguna dalam sesi
                        );

                        $this->M_login->edit_user(['username' => $username], ['last_login' => date('Y-m-d H:i:s')]);
                        $this->session->set_userdata($data_session);
                        $this->check_login();
                        redirect(base_url('dashboard'));
                    } else {
                        $this->session->set_flashdata('msg', 'Username atau Password salah!');
                        redirect(base_url('login'));
                    }
                }
            } else {
                redirect(base_url('login'));
            }
        } else {
            $this->load->view('login/login');
        }
    }

    private function check_login()
    {
        if (!$this->session->userdata('username')) {
            redirect(base_url('login'));

        }
       
    }

    public function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('status');
        redirect(base_url('login'));
    }  
}?>