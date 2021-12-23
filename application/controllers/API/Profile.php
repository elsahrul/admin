<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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

    public function index()
    {
        $token = $this->input->get('token');
        $email = $this->session->userdata('email');

        $dataProfile = $this->db->get_where('pegawai', ['email' => $email])->row();

        $this->db->where('id_pegawai', $dataProfile->id);
        $this->db->where('token', $token);
        $checkToken = $this->db->get('token_pengguna')->row();

        if ($checkToken) {
            echo json_encode([
                'status' => 'success',
                'data' => $dataProfile
            ]);
        } else {
            echo json_encode([
                'status' => 'failed',
                'data' => []
            ]);
        }
    }
}
