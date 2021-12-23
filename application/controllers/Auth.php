<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('kelola_absensi_model');
    }

    public function index()
    {
        $data['absenMasukHariIni'] = $this->kelola_absensi_model->getDataAbsenHarian(date('Y-m-d'), 1);
        $data['absenTidakMasukHariIni'] = $this->kelola_absensi_model->getDataAbsenHarian(date('Y-m-d'), null);

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Login Admin';
            $this->load->view('auth/halaman_absen',  $data);
        } else {
            //validasinya success
            $this->_login();
        }
    }



    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $admin = $this->db->get_where('admin', ['email' => $email])->row_array();

        // var_dump($admin);
        // die;
        // Jika admin ada 
        if ($admin) {

            // cek password
            if (password_verify($password, $admin['password'])) {

                $data = [
                    'email' => $admin['email']
                ];

                $this->session->set_userdata($data);
                redirect('home');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password salah!
                  </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email belum ada!
              </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Berhasil Keluar
          </div>');
        redirect('auth');
    }
}
