<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Objek extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_objek');

        if (!$this->session->userdata('username')) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        $data['title'] = 'Jenis Objek';
        $data['objek'] = $this->M_objek->get_data('tb_objek')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('tabel/objek', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Jenis Objek';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('form/tambah_objek');
        $this->load->view('templates/footer');
    }

    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE ) {
            $this->tambah();
        } else {
            $data = array(
                'nama_objek' => $this->input->post('nama_objek'),
            );

            $this->M_objek->insert_data($data, 'tb_objek');
            $this->session->set_flashdata('toast', ['type' => 'tambah', 'message' => 'Data berhasil ditambah.']);
            redirect('objek');
        }
    }

    public function edit ($id_objek)
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'id_objek' => $id_objek,
                'nama_objek' => $this->input->post('nama_objek'),
            );
            $this->M_objek->update_data($data, 'tb_objek');

            $this->session->set_flashdata('toast', ['type' => 'edit', 'message' => 'Data berhasil diubah.']);
            redirect('objek');
        }
    }

    public function delete($id)
    {
        $where = array('id_objek' => $id);
        $this->M_objek->delete($where, 'tb_objek');

        $this->session->set_flashdata('toast', ['type' => 'delete', 'message' => 'Data berhasil dihapus.']);
        redirect('objek');       
        
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_objek', 'Form', 'required', array(
            'required' => '%s Tidak boleh kosong!'
        ));
    }
}