<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tambah_data_retribusi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tambah');

    }

    public function index()
    {
        if (!$this->session->userdata('username')) {
            redirect(base_url('login'));
        }
        $data['title'] = 'Tambah data retribusi';
        $data['retribusi'] = $this->M_tambah->get_data('tb_retribusi')->result();
        $data['retribusi_b_bayar'] = $this->M_tambah->get_data('tb_retribusi_b_byr')->result();
        $data['tb_petugas'] = $this->M_tambah->get_petugas();
        $data['tb_npwrd'] = $this->M_tambah->get_npwrd();
        $data['tb_wilayah'] = $this->M_tambah->get_wilayah();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('tabel/tambah_data_retribusi', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah data retribusi';
        $data['tb_petugas'] = $this->M_tambah->get_petugas();
        $data['tb_npwrd'] = $this->M_tambah->get_npwrd();
        $data['tb_wilayah'] = $this->M_tambah->get_wilayah();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('tabel/tambah_data_retribusi', $data);
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

            // Cek Status, dan tambahkan data ke tabel yang sesuai
            if ($data['status'] == 'Belum Bayar') {
                // Jika status "Belum Bayar," tidak perlu mengisi nilai_retribusi dan keterangan
                $this->M_tambah->insert_data($data, 'tb_retribusi_b_byr');
                $this->session->set_flashdata('toast', ['type' => 'tambah', 'message' => 'Data berhasil ditambah.']);
                redirect('retribusi_b_bayar'); // Redirect ke retribusi_b_bayar jika Status "Belum Bayar"
            } elseif ($data['status'] == 'Sudah Bayar') {
                // Jika status "Sudah Bayar," tambahkan nilai_retribusi dan keterangan jika ada
                $data['nilai_retribusi'] = $this->input->post('nilai_retribusi');
                $data['keterangan'] = $this->input->post('keterangan');

                $this->M_tambah->insert_data($data, 'tb_retribusi');
                $this->session->set_flashdata('toast', ['type' => 'tambah', 'message' => 'Data berhasil ditambah.']);
                
                // Check if the "Simpan & Cetak" button was clicked
                if ($this->input->post('btn_submit_simpan') == 'Simpan & Cetak') {
                    // Get the ID of the newly inserted data
                    $retribusiId = $this->db->insert_id();
                    // Menggunakan JavaScript untuk membuka tab baru
                    echo '<script>window.open("' . base_url("cetak_struk/index/$retribusiId") . '", "_blank");</script>';
                    
                } else {
                    // Redirect to the relevant page after saving data
                    $this->session->set_flashdata('toast', ['type' => 'tambah', 'message' => 'Data berhasil ditambah.']);
                    redirect('retribusi');
                }
            }

        }
    }



    public function _rules()
    {
        $this->form_validation->set_rules('nama_petugas', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        )
        );
        $this->form_validation->set_rules('nama_objek', 'Silahkan', 'required', array(
            'required' => '%s pilih datanya terlebih dahulu!'
        )
        );
        $this->form_validation->set_rules('nama_wilayah', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        )
        );
        // Aturan validasi opsional untuk Nilai Retribusi saat status "Belum Bayar" dipilih
        if ($this->input->post('status') !== 'Belum Bayar') {
            $this->form_validation->set_rules('nilai_retribusi', 'Data', 'required', array(
                'required' => '%s tidak boleh kosong!'
            )
            );
        }
        $this->form_validation->set_rules('status', 'Silahkan', 'required', array(
            'required' => '%s pilih status terlebih dahulu!'
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