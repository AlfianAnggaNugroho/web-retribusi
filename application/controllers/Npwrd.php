<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Npwrd extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_npwrd');

        if (!$this->session->userdata('username')) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        $data['title'] = 'Npwrd';
        $data['npwrd'] = $this->M_npwrd->get_data('tb_npwrd')->result();
        $data['tb_objek'] = $this->M_npwrd->get_objek();
        $data['tb_wilayah'] = $this->M_npwrd->get_wilayah();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('tabel/npwrd', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Npwrd';
        $data['tb_objek'] = $this->M_npwrd->get_objek();
        $data['tb_wilayah'] = $this->M_npwrd->get_wilayah();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('form/tambah_npwrd', $data);
        $this->load->view('templates/footer');
    }

    // Controller Npwrd.php
    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $npwrd = $this->input->post('npwrd');

            // Memeriksa apakah NPWRD sudah ada dalam database
            if ($this->M_npwrd->is_npwrd_exists($npwrd)) {
                $this->form_validation->set_message('is_npwrd_exists', 'NPWRD yang dimasukan sebelumnya sudah terdaftar!');
                $this->tambah();
            } else {
                // Jika NPWRD belum ada, maka tambahkan data
                $data = array(
                    'jenis_objek' => $this->input->post('jenis_objek'),
                    'nama_objek' => $this->input->post('nama_objek'),
                    'nama_wilayah' => $this->input->post('nama_wilayah'),
                    'alamat' => $this->input->post('alamat'),
                    'npwrd' => $npwrd,
                    'keterangan' => $this->input->post('keterangan'),
                );

                $this->M_npwrd->insert_data($data, 'tb_npwrd');
                // Menampilkan Toast Alert
                $this->session->set_flashdata('toast', ['type' => 'tambah', 'message' => 'Data berhasil ditambah.']);

                redirect('npwrd');
            }
        }
    }


    public function edit($id_npwrd)
    {
        $this->_rules();

        // Membaca NPWRD asli dari database
        $original_npwrd = $this->M_npwrd->get_npwrd_by_id($id_npwrd);
        $npwrd = $this->input->post('npwrd');

        // Jika NPWRD diubah atau NPWRD asli kosong, maka validasi akan diaktifkan
        $is_npwrd_changed = ($original_npwrd !== $npwrd);
        // Jika NPWRD diubah, maka jalankan validasi
        if ($is_npwrd_changed) {
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('toast', ['type' => 'eror', 'message' => 'NPWRD sudah terdaftar!.']);
                // Jika validasi gagal, kembali ke halaman edit dengan pesan kesalahan
                $this->index();
            } else {
                // Jika NPWRD belum ada, maka tambahkan data
                $data = array(
                    'id_npwrd' => $id_npwrd,
                    'jenis_objek' => $this->input->post('jenis_objek'),
                    'nama_objek' => $this->input->post('nama_objek'),
                    'nama_wilayah' => $this->input->post('nama_wilayah'),
                    'alamat' => $this->input->post('alamat'),
                    'npwrd' => $npwrd,
                    'keterangan' => $this->input->post('keterangan'),
                );
                $this->M_npwrd->update_data($data, 'tb_npwrd');

                // Menampilkan Toast Alert
                $this->session->set_flashdata('toast', ['type' => 'edit', 'message' => 'Data berhasil diubah.']);

                redirect('npwrd');
            }
        } else {
            // NPWRD tidak diubah, langsung simpan perubahan
            $data = array(
                'id_npwrd' => $id_npwrd,
                'jenis_objek' => $this->input->post('jenis_objek'),
                'nama_objek' => $this->input->post('nama_objek'),
                'nama_wilayah' => $this->input->post('nama_wilayah'),
                'alamat' => $this->input->post('alamat'),
                'npwrd' => $npwrd,
                'keterangan' => $this->input->post('keterangan'),
            );
            $this->M_npwrd->update_data($data, 'tb_npwrd');

            // Menampilkan Toast Alert
            $this->session->set_flashdata('toast', ['type' => 'edit', 'message' => 'Data berhasil diubah.']);


            redirect('npwrd');
        }
    }



    public function delete($id)
    {
        $where = array('id_npwrd' => $id);
        $this->M_npwrd->delete($where, 'tb_npwrd');

        // Menampilkan Toast Alert
        $this->session->set_flashdata('toast', ['type' => 'delete', 'message' => 'Data berhasil dihapus.']);

        redirect('npwrd');
    }

    public function _rules()
    {
        $this->form_validation->set_rules('jenis_objek', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        ));
        $this->form_validation->set_rules('nama_objek', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        ));
        $this->form_validation->set_rules('nama_wilayah', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        ));
        $this->form_validation->set_rules('alamat', 'Data', 'required', array(
            'required' => '%s tidak boleh kosong!'
        ));
        $this->form_validation->set_rules('npwrd', 'Data', 'required|callback_is_npwrd_exists', array(
            'required' => '%s tidak boleh kosong!'
        ));
    }
    public function is_npwrd_exists($npwrd)
    {
        // Load the model and check if the NPWRD already exists in the database
        $result = $this->M_npwrd->is_npwrd_exists($npwrd);

        if ($result) {
            // NPWRD already exists, set a custom error message
            $this->form_validation->set_message('is_npwrd_exists', 'NPWRD sudah terdaftar');

            return false; // Return false to indicate validation failed
        } else {
            return true; // NPWRD is unique, validation passes
        }
    }
}