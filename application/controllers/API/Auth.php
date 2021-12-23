<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

    }

    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');


        if ($email == '' || $password == '') {
            echo json_encode([
                'status' => 'failed',
                'message' => 'Email dan Password tidak boleh kosong'
            ]);
        } else {
            //validasinya success
            $this->_login($email, $password);
        }
    }



    private function _login($email, $password)
    {
        $admin = $this->db->get_where('pegawai', ['email' => $email])->row_array();

        if ($admin) {

            // cek password
            if (password_verify($password, $admin['password'])) {

                $data = [
                    'name' => $admin['nama'],
                    'email' => $admin['email'],
                    'status_no_induk' => $admin['status_nomor_induk'],
                    'no_induk' => $admin['nomor_induk'],
                    // 'foto_profil' => base_url('assets/img/') . $admin['gambar']
                    'foto_profil' => base_url() . 'assets/img/' . $admin['gambar']
                ];

                $this->session->set_userdata($data);

                echo json_encode([
                    'status' => 'success',
                    'message' => 'Success login',
                    'data' => $data
                ]);
            } else {
                echo json_encode([
                    'status' => 'fail',
                    'message' => 'Passowrd salah'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'fail',
                'message' => 'Email belum terdaftar'
            ]);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');

        echo json_encode([
            'status' => 'success',
            'message' => 'Akun berhasil logout'
        ]);
    }
}
