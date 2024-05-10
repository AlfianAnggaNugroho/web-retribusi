<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_profile');

        if (!$this->session->userdata('username')) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        $data['title'] = 'Profile pengguna';
        $data['user'] = $this->M_profile->get_data('tb_user')->result();
        $data['token_generate'] = $this->token_generate();
        $this->session->set_userdata($data);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('login/profile', $data);
        $this->load->view('templates/footer');
    }


    public function token_generate()
    {
        return $tokens = md5(uniqid(rand(), true));
    }

    private function hash_password($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function edit($id_user)
    {
        $this->_rules();
        
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            // Periksa apakah token sesuai
            $token = $this->input->post('token');
            if ($token === $this->session->userdata('token_generate')) {
                $data = array(
                    'id_user' => $id_user,
                    'username' => $this->input->post('username'),
                );

                // Jika password diisi, hash password baru
                $password = $this->input->post('password');
                if (!empty($password)) {
                    $data['password'] = $this->hash_password($password);
                }

                $where = array('id_user' => $id_user);
                $this->M_profile->update_data($data, 'tb_user', $where);

                $this->session->set_flashdata('toast', ['type' => 'edit', 'message' => 'Data berhasil diubah.']);
                redirect('profile');
            } else {
                // Token tidak sesuai, lakukan penanganan kesalahan di sini
                echo "Token tidak sesuai. Penanganan kesalahan di sini.";
            }
        }
    }


  public function _rules()
    {
        $this->form_validation->set_rules('username', 'Username', 'required', array(
            'required' => '%s harus di isi!'
        ));
        $this->form_validation->set_rules('password','Password','required', array(
            'required' => '%s harus di isi!'
        ));
        $this->form_validation->set_rules('confirm_password','Password','required', array(
          'required' => '%s harus sama!'
      ));
    }

}