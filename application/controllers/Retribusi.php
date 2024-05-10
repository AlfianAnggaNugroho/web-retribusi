<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Retribusi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_retribusi');

    }

    public function index()
    {
        if (!$this->session->userdata('username')) {
            redirect(base_url('login'));
        }
        $data['title'] = 'Sudah bayar retribusi';
        // Ubah query untuk mengurutkan data berdasarkan tanggal terbaru
        $data['retribusi'] = $this->M_retribusi->get_data_sorted('tb_retribusi', 'id_retribusi', 'DESC')->result();
        $data['tb_petugas'] = $this->M_retribusi->get_petugas();
        $data['tb_npwrd'] = $this->M_retribusi->get_npwrd();
        $data['tb_wilayah'] = $this->M_retribusi->get_wilayah();
        $data['sumretribusi'] = $this->M_retribusi->sum_retribusi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('tabel/retribusi', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Sudah bayar retribusi';
        $data['tb_petugas'] = $this->M_retribusi->get_petugas();
        $data['tb_npwrd'] = $this->M_retribusi->get_npwrd();
        $data['tb_wilayah'] = $this->M_retribusi->get_wilayah();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('form/tambah_retribusi', $data);
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
                'nama_objek' => $this->input->post('nama_objek'),
                'nama_wilayah' => $this->input->post('nama_wilayah'),
                'alamat' => $this->input->post('alamat'),
                'npwrd' => $this->input->post('npwrd'),
                'nilai_retribusi' => $this->input->post('nilai_retribusi'),
                'keterangan' => $this->input->post('keterangan'),
                'tanggal' => $this->input->post('tanggal'),
            );

            $this->M_retribusi->insert_data($data, 'tb_retribusi');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Data berhasil ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('retribusi');
        }
    }

    public function edit ($id_retribusi)
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'id_retribusi' => $id_retribusi,
                'nama_petugas' => $this->input->post('nama_petugas'),
                'nama_objek' => $this->input->post('nama_objek'),
                'nama_wilayah' => $this->input->post('nama_wilayah'),
                'alamat' => $this->input->post('alamat'),
                'npwrd' => $this->input->post('npwrd'),
                'nilai_retribusi' => $this->input->post('nilai_retribusi'),
                'keterangan' => $this->input->post('keterangan'),
                'tanggal' => $this->input->post('tanggal'),
            );
            $this->M_retribusi->update_data($data, 'tb_retribusi');

            $this->session->set_flashdata('toast', ['type' => 'edit', 'message' => 'Data berhasil diubah.']);
            redirect('retribusi');
        }
    }

    public function delete($id)
    {
        $where = array('id_retribusi' => $id);
        $this->M_retribusi->delete($where, 'tb_retribusi');

        $this->session->set_flashdata('toast', ['type' => 'delete', 'message' => 'Data berhasil dihapus.']);
        redirect('retribusi');       
        
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_petugas', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        ));
        $this->form_validation->set_rules('nama_objek', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        ));
        $this->form_validation->set_rules('nama_wilayah', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        ));
        $this->form_validation->set_rules('nilai_retribusi', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        ));
        $this->form_validation->set_rules('tanggal', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        ));
        $this->form_validation->set_rules('alamat', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        ));
    }

}