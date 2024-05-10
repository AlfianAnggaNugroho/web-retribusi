<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_petugas');

        if (!$this->session->userdata('username')) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        $data['title'] = 'Petugas';
        $data['petugas'] = $this->M_petugas->get_data('tb_petugas')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('tabel/petugas', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Petugas';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('form/tambah_petugas');
        $this->load->view('templates/footer');
    }

    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE ) {
            $this->tambah();
        } else {
            $data = array(
                'nama_petugas' => $this->input->post('nama_petugas'),
                'no_telp' => $this->input->post('no_telp'),
                'alamat' => $this->input->post('alamat'),
            );

            $this->M_petugas->insert_data($data, 'tb_petugas');
            $this->session->set_flashdata('toast', ['type' => 'tambah', 'message' => 'Data berhasil ditambah.']);
            redirect('petugas');
        }
    }

    public function edit ($id_petugas)
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'id_petugas' => $id_petugas,
                'nama_petugas' => $this->input->post('nama_petugas'),
                'no_telp' => $this->input->post('no_telp'),
                'alamat' => $this->input->post('alamat'),
            );
            $this->M_petugas->update_data($data, 'tb_petugas');

            $this->session->set_flashdata('toast', ['type' => 'edit', 'message' => 'Data berhasil diubah.']);
            redirect('petugas');
        }
    }

    public function delete($id)
    {
        $where = array('id_petugas' => $id);
        $this->M_petugas->delete($where, 'tb_petugas');

        $this->session->set_flashdata('toast', ['type' => 'delete', 'message' => 'Data berhasil dihapus.']);
        redirect('petugas');       
        
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_petugas', 'Form', 'required', array(
            'required' => '%s Tidak boleh kosong!'
        ));
        $this->form_validation->set_rules('no_telp', 'Form', 'required', array(
            'required' => '%s Tidak boleh kosong!'
        ));
        $this->form_validation->set_rules('alamat', 'Form', 'required', array(
            'required' => '%s Tidak boleh kosong!'
        ));
    }
}