<?php

class Token_pengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!get_instance()->session->userdata('email')) {
            redirect('auth');
        }

        $this->load->model('Token_pengguna_model');
    }

    public function index()
    {
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['token_pengguna'] = $this->Token_pengguna_model->getAllTokenpengguna();

        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            $data['judul'] = 'Token Pengguna';
            $this->load->view('templates/header', $data);
            $this->load->view('kelola_absensi/token_pengguna', $data);
            $this->load->view('templates/footer');
        }
    }
    public function hapusTokenPengguna()
    {
        $this->Token_pengguna_model->hapusSemuaToken();
        $this->session->set_flashdata('flash', 'Semua token pengguna berhasil dihapus');
        redirect('token_pengguna');
    }

    //Hapus Data hari besar
    public function hapus($id)
    {
        $this->Token_pengguna_model->hapusToken($id);
        $this->session->set_flashdata('flash', 'Token pengguna berhasil dihapus');
        redirect('token_pengguna');
    }
    //end Hapus Data


}
