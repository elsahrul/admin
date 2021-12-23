<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!get_instance()->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('kelola_absensi_model');
        $this->load->model('home_model');
    }


    // public function halaman_absen()
    // {
    //     $data['judul'] = 'Halaman Absen';
    //     $this->load->view('home/halaman_absen');
    // }

    public function index()
    {
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();


        $tanggalHariIni = date('Y-m-d', time());
        $data['absenMasukHariIni'] = $this->kelola_absensi_model->getDataAbsenHarian($tanggalHariIni, 1);
        $data['absenTidakMasukHariIni'] = $this->kelola_absensi_model->getDataAbsenHarian(date('Y-m-d'), null);

        $data['j_guru'] = $this->home_model->j_guru();
        $data['j_tatausaha'] = $this->home_model->j_tata_usaha();
        $data['j_kepala_sekolah'] = $this->home_model->j_kepala_sekolah();
        $data['j_w_kepala_sekolah'] = $this->home_model->j_w_kepala_sekolah();

        $data['total_guru'] =  ($data['j_guru'] +  $data['j_kepala_sekolah'] +  $data['j_w_kepala_sekolah']);

        // var_dump($data['total_guru']);
        // die;




        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            $data['judul'] = 'Halaman Home';
            $this->load->view('templates/header', $data);
            $this->load->view('home/index');
            $this->load->view('templates/footer');
        }
    }
}
