<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!get_instance()->session->userdata('email')) {
            redirect('auth');
        }

        $this->load->model('Pegawai_model');
    }

    public function guru()
    {
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_guru'] = $this->Pegawai_model->getTypePegawai('Guru');
        $data['data_kepala_sekolah'] = $this->Pegawai_model->getTypePegawai('Kepala Sekolah');
        $data['data_wakil_kepala_sekolah'] = $this->Pegawai_model->getTypePegawai('Wakil Kepala Sekolah');


        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            $data['judul'] = 'Data Guru';
            $this->load->view('templates/header', $data);
            $this->load->view('data_pegawai/data_guru', $data);
            $this->load->view('templates/footer');
        }
    }

    public function tu()
    {
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_tu'] = $this->Pegawai_model->getTypePegawai('TU');

        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else
            $data['judul'] = 'Data TU';
        $this->load->view('templates/header', $data);
        $this->load->view('data_pegawai/data_tu', $data);
        $this->load->view('templates/footer');
    }
}
