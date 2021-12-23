<?php

class kelola_perizinan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!get_instance()->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('kelola_absensi_model');
        $this->load->model('Pegawai_model');
    }
    public function index()
    {
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['pegawai'] = $this->Pegawai_model->getAllPegawai();

        // echo '<pre>';
        // print_r($data['pegawai']);
        // echo '</pre>';
        // die;

        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            //Keyword Pencarian
            if ($this->input->post('keyword')) {
                $data['pegawai'] = $this->kelola_absensi_model->cariDataPegawai();
            }
            //end keyword pencarian


            $data['judul'] = 'Kelola Data Perizinan';
            $this->load->view('templates/header', $data);
            $this->load->view('Kelola_absensi/kelola_perizinan');
            $this->load->view('templates/footer');
        }
    }

    public function absen($id, $status)
    {
        $this->kelola_absensi_model->absenPegawai($id, $status);
        redirect('Kelola_absensi');
    }
}
