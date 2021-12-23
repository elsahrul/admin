<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

        $this->load->model('Absensi_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function absen_action($absen_at, $type)
    {
        if ($this->session->userdata('email') == null) {
            echo json_encode([
                'status' => 'failed',
                'message' => 'Not authenticated'
            ]);

            die;
        }

        // $getExpiredBarcodeDB = $this->db->get_where('barcode', ['id' => 1])->row()->expired_at;
        $getExpiredBarcodeDB = $this->input->post('expired_barcode');

        $arrSplit = explode(".", $absen_at);
        $getDay = $arrSplit[0];
        $getAbsenAt = $arrSplit[1];

        // echo "ini yang dari DB : $getExpiredBarcodeDB, ini yang dari Scan : $getAbsenAt";
        // die;

        if ($getDay == date('D')) {
            if ($getAbsenAt <= $getExpiredBarcodeDB) {

                $getPeopleAbsen = $this->db->get_where('pegawai', ['email' => $this->session->userdata("email")])->row();
                $getAbsenConfig = $this->Absensi_model->getAbsenConfig();

                if ($type == 'jam_masuk') {

                    // ABSEN MASUKKK

                    $checkIsUserAbsen =  $this->db->get_where('absen_manual', ['id_pegawai' => $getPeopleAbsen->id, 'tanggal_absen' => date('Y-m-d')])->row();

                    if (empty($checkIsUserAbsen)) {
                        $this->db->insert('absen_manual', ['id_pegawai' => $getPeopleAbsen->id, 'status_absen' => 1, 'jam_masuk' => date('H:i', $getAbsenAt), 'jam_pulang' => '-', 'tanggal_absen' => date('Y-m-d', $getAbsenAt)]);
                    } else {
                    }

                    echo json_encode([
                        'status' => 'success',
                        'message' =>  'Berhasil absen masuk',
                        'data' => $this->session->userdata('email')
                    ]);
                }
                if ($type == 'jam_pulang') {

                    // ABSEN PULANGG
                    $this->db->update('absen_manual', ['jam_pulang' => date('H:i', $getAbsenAt)], ['id_pegawai' => $getPeopleAbsen->id]);

                    echo json_encode([
                        'status' => 'success',
                        'message' =>  'Berhasil absen pulang',
                        'data' => $this->session->userdata('email')
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'failed',
                    'message' =>  'Gagal absen, barcode expired!'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'failed',
                'message' =>  'Gagal absen, barcode expired!'
            ]);
        }
    }

    public function checkAllowAbsenFromMobile($type)
    {
        // cek apakah sudah absen atau belum
        $email = $this->input->get('email');
        // $getPeopleAbsen = $this->db->get_where('pegawai', ['email' => $this->session->userdata("email")])->row();
        $getPeopleAbsen = $this->db->get_where('pegawai', ['email' => $email])->row();
        $checkIsUserAbsen =  $this->db
            ->get_where(
                'absen_manual',
                [
                    'id_pegawai' => $getPeopleAbsen->id,
                    'tanggal_absen' => date('Y-m-d', time())
                ]
            )
            ->row_array();
        $checkIsUserAbsenPulang =  $this->db
            ->get_where(
                'absen_manual',
                [
                    'id_pegawai' => $getPeopleAbsen->id,
                    'tanggal_absen' => date('Y-m-d', time())
                ]
            )
            ->row_array();

        // var_dump($checkIsUserAbsen);
        // die;


        if ($type == "jam_masuk") {
            if ($checkIsUserAbsen == null) {
                echo json_encode([
                    'status' => 'success',
                    'data'   => [
                        'type_absen' => 'jam_masuk',
                        'isActive' => true,
                    ]
                ]);
            } else {
                echo json_encode([
                    'status' => 'success',
                    'data'   => [
                        'type_absen' => 'jam_masuk',
                        'isActive' => false,
                    ]
                ]);
            }
        } else {
            if ($checkIsUserAbsenPulang != null && $checkIsUserAbsenPulang['jam_pulang'] == '-') {
                echo json_encode([
                    'status' => 'success',
                    'data'   => [
                        'type_absen' => 'jam_pulang',
                        'isActive' => true,
                    ]
                ]);
            } else {
                echo json_encode([
                    'status' => 'success',
                    'data'   => [
                        'type_absen' => 'jam_pulang',
                        'isActive' => false,
                    ]
                ]);
            }
        }
    }

    public function generate_barcode()
    {
        $created_at = $this->input->post('created_at');
        $expired_at = $this->input->post('expired_at');

        if ($created_at == '' || $expired_at == '') {
            http_response_code(200);

            echo json_encode([
                'status' => 'failed',
                'message' =>  'Created at dan Expired at harus diisi!'
            ]);
        } else {
            $this->Absensi_model->update_barcode($created_at, $expired_at);

            if ($this->db->affected_rows() > 0) {
                http_response_code(201);

                echo json_encode([
                    'status' => 'success',
                    'message' =>  'Barcode berhasil diupdate'
                ]);
            } else {
                http_response_code(200);

                echo json_encode([
                    'status' => 'failed',
                    'message' =>  'Barcode gagal diupdate'
                ]);
            }
        }
    }

    public function get_waktu_absen()
    {
        $dataWaktu = $this->db->query("SELECT * FROM `waktu_absensi` ORDER BY id DESC LIMIT 1")->row_array();
        echo json_encode([
            'status' => 'success',
            'data'   => [
                'masuk' => $dataWaktu['masuk'],
                'pulang' => $dataWaktu['pulang']
            ]
        ]);
    }
}
