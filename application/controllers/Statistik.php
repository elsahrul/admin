<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Statistik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!get_instance()->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('statistik_model');
        $this->load->model('Pegawai_model');
    }

    public function index()
    {
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        // $data['hari_libur'] = $this->kelola_absensi_model->getAllHaribesarnasional();

        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            $data['pegawai'] = $this->Pegawai_model->getAllPegawai();

            $data['judul'] = 'Halaman Home';
            $this->load->view('templates/header', $data);
            $this->load->view('statistik/statistik');
            $this->load->view('templates/footer');
        }
    }

    public function getChartLine()
    {

        $absen['guru_masuk'] = [];
        $absen['guru_tidak_masuk'] = [];
        $absen['tu_masuk'] = [];
        $absen['tu_tidak_masuk'] = [];

        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); $i++) {
            if ($i < 10) {
                $guru_masuk = $this->statistik_model->getDataGuruMasuk(date('Y') . '-' . date('m') . '-0' . $i);
                $guru_tidak_masuk = $this->statistik_model->getDataGuruTidakMasuk(date('Y') . '-' . date('m') . '-0' . $i);
                $tu_masuk = $this->statistik_model->getDataTUMasuk(date('Y') . '-' . date('m') . '-0' . $i);
                $tu_tidak_masuk = $this->statistik_model->getDataTUTidakMasuk(date('Y') . '-' . date('m') . '-0' . $i);
            } else {
                $guru_masuk = $this->statistik_model->getDataGuruMasuk(date('Y') . '-' . date('m') . '-' . $i);
                $guru_tidak_masuk = $this->statistik_model->getDataGuruTidakMasuk(date('Y') . '-' . date('m') . '-' . $i);
                $tu_masuk = $this->statistik_model->getDataTUMasuk(date('Y') . '-' . date('m') . '-' . $i);
                $tu_tidak_masuk = $this->statistik_model->getDataTUTidakMasuk(date('Y') . '-' . date('m') . '-' . $i);
            }
            $absen['guru_masuk'][] = count($guru_masuk);
            $absen['guru_tidak_masuk'][] = count($guru_tidak_masuk);
            $absen['tu_masuk'][] = count($tu_masuk);
            $absen['tu_tidak_masuk'][] = count($tu_tidak_masuk);
        }

        echo json_encode(['kehadiran' => $absen]);
    }

    public function getChartLinePerMonth($month, $year)
    {

        $absen['guru_masuk'] = [];
        $absen['guru_tidak_masuk'] = [];
        $absen['tu_masuk'] = [];
        $absen['tu_tidak_masuk'] = [];

        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            if ($i < 10) {
                $guru_masuk = $this->statistik_model->getDataGuruMasuk($year . '-' . $month . '-0' . $i);
                $guru_tidak_masuk = $this->statistik_model->getDataGuruTidakMasuk($year . '-' . $month . '-0' . $i);
                $tu_masuk = $this->statistik_model->getDataTUMasuk($year . '-' . $month . '-0' . $i);
                $tu_tidak_masuk = $this->statistik_model->getDataTUTidakMasuk($year . '-' . $month . '-0' . $i);
            } else {
                $guru_masuk = $this->statistik_model->getDataGuruMasuk($year . '-' . $month . '-' . $i);
                $guru_tidak_masuk = $this->statistik_model->getDataGuruTidakMasuk($year . '-' . $month . '-' . $i);
                $tu_masuk = $this->statistik_model->getDataTUMasuk($year . '-' . $month . '-' . $i);
                $tu_tidak_masuk = $this->statistik_model->getDataTUTidakMasuk($year . '-' . $month . '-' . $i);
            }
            $absen['guru_masuk'][] = count($guru_masuk);
            $absen['guru_tidak_masuk'][] = count($guru_tidak_masuk);
            $absen['tu_masuk'][] = count($tu_masuk);
            $absen['tu_tidak_masuk'][] = count($tu_tidak_masuk);
        }

        echo json_encode(['kehadiran' => $absen]);
    }

    public function getStatistikAbsen($id_pegawai)
    {

        $statistik['statistik'] = [];

        $sakit = $this->statistik_model->getStatistikAbsen(date('m'), date('Y'), $id_pegawai, 2);
        $izin = $this->statistik_model->getStatistikAbsen(date('m'), date('Y'), $id_pegawai, 3);
        $alpha = $this->statistik_model->getStatistikAbsen(date('m'), date('Y'), $id_pegawai, 4);
        $cuti = $this->statistik_model->getStatistikAbsen(date('m'), date('Y'), $id_pegawai, 5);
        $dinasluar = $this->statistik_model->getStatistikAbsen(date('m'), date('Y'), $id_pegawai, 6);

        $statistik['nama'][] = $sakit;
        $statistik['sakit'][] = count($sakit);
        $statistik['izin'][] = count($izin);
        $statistik['alpha'][] = count($alpha);
        $statistik['cuti'][] = count($cuti);
        $statistik['dinasluar'][] = count($dinasluar);

        echo json_encode(['statistikkehadiran' => $statistik]);
    }

    public function getStatistikAbsenPerMonth($id_pegawai, $month, $year)
    {

        $statistik['statistik'] = [];

        $sakit = $this->statistik_model->getStatistikAbsen($month, $year, $id_pegawai, 2);
        $izin = $this->statistik_model->getStatistikAbsen($month, $year, $id_pegawai, 3);
        $alpha = $this->statistik_model->getStatistikAbsen($month, $year, $id_pegawai, 4);
        $cuti = $this->statistik_model->getStatistikAbsen($month, $year, $id_pegawai, 5);
        $dinasluar = $this->statistik_model->getStatistikAbsen($month, $year, $id_pegawai, 6);

        $statistik['nama'][] = $sakit;
        $statistik['sakit'][] = count($sakit);
        $statistik['izin'][] = count($izin);
        $statistik['alpha'][] = count($alpha);
        $statistik['cuti'][] = count($cuti);
        $statistik['dinasluar'][] = count($dinasluar);

        echo json_encode(['statistikkehadiran' => $statistik]);
    }
}
