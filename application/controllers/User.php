<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');

        
    }

    public function index()
    {
        if (!$this->session->userdata('username')) {
            redirect(base_url('login'));
        }
        
        $data['title'] = 'Users';
        $data['user'] = $this->M_user->get_data('tb_user')->result();
        $data['token_generate'] = $this->token_generate();
        $this->session->set_userdata($data);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('login/user', $data);
        $this->load->view('templates/footer');
    }

    public function token_generate()
    {
        return $tokens = md5(uniqid(rand(), true));
    }

    private function hash_password($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    



    public function tambah()
    {
        
        $data['title'] = 'Tambah User';
        $data['token_generate'] = $this->token_generate();
        $this->session->set_userdata($data);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('form/tambah_user');
        $this->load->view('templates/footer');
    }


    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            // Periksa apakah token sesuai
            if ($this->session->userdata('token_generate') === $this->input->post('token')) {
                $username = $this->input->post('username', TRUE);
                $us_level = $this->input->post('us_level', TRUE);
                $password = $this->input->post('password', TRUE);

                $data = array(
                    'username' => $username,
                    'us_level' => $us_level,
                    'password' => $this->hash_password($password),
                );

                $this->M_user->insert($data, 'tb_user');

                $this->session->set_flashdata('toast', ['type' => 'tambah', 'message' => 'Data berhasil ditambah.']);
                redirect('user');
            } else {
                // Token tidak sesuai, lakukan penanganan kesalahan di sini
                echo "Token tidak sesuai. Penanganan kesalahan di sini.";
            }
        }
    }




              public function edit($id_user)
              {
                  $this->_rules();
              
                  if ($this->form_validation->run() == FALSE) {
                      $this->index();
                  } else {
                      // Periksa apakah token sesuai
                      if ($this->session->userdata('token_generate') === $this->input->post('token')) {
                          $data = array(
                              'id_user' => $id_user,
                              'username' => $this->input->post('username'),
                              'us_level' => $this->input->post('us_level'),
                          );
              
                          // Jika password diisi, hash password baru
                          $password = $this->input->post('password');
                          if (!empty($password)) {
                              $data['password'] = $this->hash_password($password);
                          }
              
                          $where = array('id_user' => $id_user);
                          $this->M_user->update_data($data, 'tb_user');
              
                          $this->session->set_flashdata('toast', ['type' => 'edit', 'message' => 'Data berhasil diubah.']);
                          redirect('user');
                      } else {
                          // Token tidak sesuai, lakukan penanganan kesalahan di sini
                          echo "Token tidak sesuai. Penanganan kesalahan di sini.";
                      }
                  }
              }
              
              
              
              
    
    public function delete($id)
    {
        
        $id = $this->uri->segment(3);
        $where = array('id_user' => $id);
        $this->M_user->delete('tb_user',$where);

        $this->session->set_flashdata('toast', ['type' => 'delete', 'message' => 'Data berhasil dihapus.']);
        redirect('user');       
        
    }

    public function _rules()
    {
        $this->form_validation->set_rules('username', 'Username', 'required', array(
            'required' => '%s harus di isi!'
        ));
        $this->form_validation->set_rules('password','Password','required', array(
            'required' => '%s harus di isi!'
        ));
    }
}