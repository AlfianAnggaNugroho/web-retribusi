<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Retribusi_b_bayar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_retribusi_b_bayar');

    }

    public function index()
    {
        if (!$this->session->userdata('username')) {
            redirect(base_url('login'));
        }
        $data['title'] = 'Belum bayar retribusi';
        $data['retribusi_b_bayar'] = $this->M_retribusi_b_bayar->get_data_sorted('tb_retribusi_b_byr', 'id_retribusi', 'DESC')->result();
        $data['tb_petugas'] = $this->M_retribusi_b_bayar->get_petugas();
        $data['tb_npwrd'] = $this->M_retribusi_b_bayar->get_npwrd();
        $data['tb_wilayah'] = $this->M_retribusi_b_bayar->get_wilayah();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('tabel/retribusi_b_bayar', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah data retribusi';
        $data['tb_petugas'] = $this->M_retribusi_b_bayar->get_petugas();
        $data['tb_npwrd'] = $this->M_retribusi_b_bayar->get_npwrd();
        $data['tb_wilayah'] = $this->M_retribusi_b_bayar->get_wilayah();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('form/tambah_retribusi_b_bayar', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = array(
                'nama_petugas' => $this->input->post('nama_petugas'),
                'nama_objek' => $this->input->post('nama_objek'),
                'nama_wilayah' => $this->input->post('nama_wilayah'),
                'alamat' => $this->input->post('alamat'),
                'npwrd' => $this->input->post('npwrd'),
                'status' => $this->input->post('status'),
                'tanggal' => $this->input->post('tanggal'),
            );

            $this->M_retribusi_b_bayar->insert_data($data, 'tb_retribusi_b_byr');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Data berhasil ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('retribusi_b_bayar');
        }
    }

    public function edit($id_retribusi)
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
                'tanggal' => $this->input->post('tanggal'),
            );
            $this->M_retribusi_b_bayar->update_data($data, 'tb_retribusi_b_byr');

            $this->session->set_flashdata('toast', ['type' => 'edit', 'message' => 'Data berhasil diubah.']);
            redirect('retribusi_b_bayar');
        }
    }

    public function delete($id)
    {
        $where = array('id_retribusi' => $id);
        $this->M_retribusi_b_bayar->delete($where, 'tb_retribusi_b_byr');

        $this->session->set_flashdata('toast', ['type' => 'delete', 'message' => 'Data berhasil dihapus.']);
        redirect('retribusi_b_bayar');

    }

    public function bayar($id_retribusi_bayar)
    {
        // Ambil data dari tb_retribusi_b_byr berdasarkan ID
        $data_bayar = $this->M_retribusi_b_bayar->get_data_by_id($id_retribusi_bayar);

        if ($data_bayar) {
            // Ambil tanggal bayar saat ini
            $tanggal_bayar = date('Y-m-d H:i:s');

            // Persiapkan data untuk dimasukkan ke tb_retribusi
            $data_retribusi = array(
                'nama_petugas' => $data_bayar->nama_petugas,
                'nama_objek' => $data_bayar->nama_objek,
                'nama_wilayah' => $data_bayar->nama_wilayah,
                'alamat' => $data_bayar->alamat,
                'npwrd' => $data_bayar->npwrd,
                'nilai_retribusi' => $this->input->post('nilai_retribusi'),
                // Nilai Retribusi dari form
                'keterangan' => $this->input->post('keterangan'),
                // Keterangan dari form
                'status' => 'Sudah Bayar',
                // Ubah status menjadi "Sudah Bayar"
                'tanggal' => $tanggal_bayar // Update tanggal menjadi tanggal bayar
            );

            // Masukkan data ke tb_retribusi
            $this->M_retribusi_b_bayar->insert_data($data_retribusi, 'tb_retribusi');

            // Hapus data dari tb_retribusi_b_byr
            $this->M_retribusi_b_bayar->delete_data($id_retribusi_bayar);

            $this->session->set_flashdata('toast', ['type' => 'bayar', 'message' => 'Berhasil melakukan pembayaran']);



            // Redirect ke halaman yang sesuai
            redirect('retribusi_b_bayar');
        } else {
            // Tampilkan pesan kesalahan jika data tidak ditemukan
            echo "Data tidak ditemukan.";
        }
    }




    public function _rules()
    {
        $this->form_validation->set_rules('nama_petugas', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        )
        );
        $this->form_validation->set_rules('nama_objek', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        )
        );
        $this->form_validation->set_rules('nama_wilayah', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        )
        );
        $this->form_validation->set_rules('tanggal', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        )
        );
        $this->form_validation->set_rules('alamat', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        )
        );
    }

}