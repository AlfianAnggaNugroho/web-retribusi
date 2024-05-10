<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_wilayah');

        if (!$this->session->userdata('username')) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        $data['title'] = 'wilayah';
        $data['wilayah'] = $this->M_wilayah->get_data('tb_wilayah')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('tabel/wilayah', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah wilayah';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('form/tambah_wilayah');
        $this->load->view('templates/footer');
    }

    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE ) {
            $this->tambah();
        } else {
            $data = array(
                'nama_wilayah' => $this->input->post('nama_wilayah'),
            );

            $this->M_wilayah->insert_data($data, 'tb_wilayah');
            $this->session->set_flashdata('toast', ['type' => 'tambah', 'message' => 'Data berhasil ditambah.']);
            redirect('wilayah');
        }
    }

    public function edit ($id_wilayah)
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'id_wilayah' => $id_wilayah,
                'nama_wilayah' => $this->input->post('nama_wilayah'),
            );
            $this->M_wilayah->update_data($data, 'tb_wilayah');

            $this->session->set_flashdata('toast', ['type' => 'edit', 'message' => 'Data berhasil diubah.']);
            redirect('wilayah');
        }
    }

    public function delete($id)
    {
        $where = array('id_wilayah' => $id);
        $this->M_wilayah->delete($where, 'tb_wilayah');

        $this->session->set_flashdata('toast', ['type' => 'delete', 'message' => 'Data berhasil dihapus.']);
        redirect('wilayah');       
        
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_wilayah', 'Nama wilayah', 'required', array(
            'required' => '%s Tidak boleh kosong!'
        ));
    }
}