<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Token extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

        if ($this->session->userdata('email') == null) {
            echo json_encode([
                'status' => 'failed',
                'message' => 'Not authenticated'
            ]);

            die;
        }
    }

    public function verifikasi_token()
    {
        $token = $this->input->post('token');
        $email = $this->session->userdata('email');
        $dataProfile = $this->db->get_where('pegawai', ['email' => $email])->row();

        
        $this->db->where('id_pegawai', $dataProfile->id);
        $this->db->where('token', $token);
        $checkToken = $this->db->get('token_pengguna')->row();

         if ($checkToken) {

            echo json_encode([
                'status' => 'success',
                'data' => []
            ]);
        } else {
            echo json_encode([
                'status' => 'failed',
                'data' => []
            ]);
        }
        
    }

    public function insert_token()
    {
        $token = $this->input->post('token');
        $email = $this->session->userdata('email');
        $dataProfile = $this->db->get_where('pegawai', ['email' => $email])->row();

        $checkToken = $this->db->get_where('token_pengguna', ['id_pegawai' => $dataProfile->id])->row();

        if ($checkToken) {
            echo json_encode([
                'status' => 'failed',
                'data' => []
            ]);
            
        } else {
            $data = [
                'id_pegawai' => $dataProfile->id,
                'token' => $token,
                'tanggal_dibuat' => date('d-M-Y, h:i:s')
            ];

            $this->db->insert('token_pengguna', $data);

            echo json_encode([
                'status' => 'success',
                'data' => []
            ]);
        }
    }
}
