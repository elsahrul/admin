<?php

class Kelola_absensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!get_instance()->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('kelola_absensi_model');
        $this->load->model('Pegawai_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['pegawai'] = $this->Pegawai_model->getAllPegawai();
        $data['hari_libur'] = $this->kelola_absensi_model->getAllHarilibur();

        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            //Keyword Pencarian
            if ($this->input->post('keyword')) {
                $data['pegawai'] = $this->kelola_absensi_model->cariDataPegawai();
            }
            //end keyword pencarian


            $data['judul'] = 'Kelola Data Absensi';
            $this->load->view('templates/header', $data);
            $this->load->view('Kelola_absensi/waktu_absensi');
            $this->load->view('templates/footer');

            $this->form_validation->set_rules('masuk', 'required');
            $this->form_validation->set_rules('pulang', 'Pulang', 'required');
            $this->form_validation->set_rules('toleransi', 'Toleransi', 'required');
            if ($this->form_validation->run() == FALSE) {
            } else {
                $this->kelola_absensi_model->tambahWaktuAbsensi();
                $this->session->set_flashdata('flash', 'Waktu Behasil Ditambahkan');
                redirect('Kelola_absensi');
            }
        }
    }

    public function absen($id, $status)
    {
        $this->kelola_absensi_model->absenPegawai($id, $status);
        redirect('Kelola_perizinan');
    }

    public function HariLibur()
    {
        $this->form_validation->set_rules('tanggal', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        if ($this->form_validation->run() == FALSE) {
        } else {
            $this->kelola_absensi_model->tambahHariLibur();
            $this->session->set_flashdata('flash', 'Hari Libur Berhasil Ditambahkan');
            redirect('Kelola_absensi');
        }
    }


    //Hapus Data hari besar
    public function hapus($id)
    {

        $this->kelola_absensi_model->hapusLibur($id);
        $this->session->set_flashdata('flash', 'Hari Libur Berhasil Dihapus');
        redirect('kelola_absensi');
    }
    //end Hapus Data


}
