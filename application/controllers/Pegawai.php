<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!get_instance()->session->userdata('email')) {
            redirect('auth');
        }

        $this->load->model('Pegawai_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
    }
    public function index()
    {
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Pegawai_model');

        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            $data['judul'] = 'Data Pegawai';
            $data['pegawai'] = $this->Pegawai_model->getAllPegawai();


            //Keyword Pencarian
            if ($this->input->post('keyword')) {
                $data['pegawai'] = $this->Pegawai_model->cariDataPegawai();
            }
            //end keyword pencarian


            $this->load->view('templates/header', $data);
            $this->load->view('pegawai/index', $data);
            $this->load->view('templates/footer');
        }
    }



    //Tambah Data
    public function tambah()
    {
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Form Tambah Data Pegawai';

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nomor_induk', 'Nomor Induk', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('ttl', 'Tempat Tanggal Lahir', 'required');
        $this->form_validation->set_rules('pendidikan_jurusan', 'Pendidikan Jurusan', 'required');
        $this->form_validation->set_rules('pangkat_gol', 'Pangkat - Gol. Ruang', 'required');
        $this->form_validation->set_rules('nomor_tgl_sk', 'Nomor Tanggal SK', 'required');
        $this->form_validation->set_rules('pangkat_terakhir', 'Pangkat Terakhir', 'required');
        $this->form_validation->set_rules('tugas_disekolah', 'Tugas Disekolah Ini', 'required');
        $this->form_validation->set_rules('mengajar_mp', 'Mengajar Mata Pelajaran', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('pegawai/tambah');
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './assets/img/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 500;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                echo "Gagal Tambah";
            } else {

                $gambar = $this->upload->data();
                $gambar = $gambar['file_name'];
                $nama = $this->input->post('nama', true);
                $status_nomor_induk = $this->input->post('status_nomor_induk', true);
                $nomor_induk = $this->input->post('nomor_induk', true);
                $email = $this->input->post('email', true);
                $password =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $jabatan = $this->input->post('jabatan', true);
                $ttl = $this->input->post('ttl', true);
                $jenis_kelamin = $this->input->post('jenis_kelamin', true);
                $pendidikan_jurusan = $this->input->post('pendidikan_jurusan', true);
                $penempatan_sebagai = $this->input->post('penempatan_sebagai', true);
                $status_kepegawaian = $this->input->post('status_kepegawaian', true);
                $pangkat_gol = $this->input->post('pangkat_gol', true);
                $nomor_tgl_sk = $this->input->post('nomor_tgl_sk', true);
                $pangkat_terakhir = $this->input->post('pangkat_terakhir', true);
                $tugas_disekolah = $this->input->post('tugas_disekolah', true);
                $mengajar_mp = $this->input->post('mengajar_mp', true);

                $data = array(
                    'nama' => $nama,
                    'status_nomor_induk' => $status_nomor_induk,
                    'nomor_induk' => $nomor_induk,
                    'email' => $email,
                    'password' => $password,
                    'jabatan' => $jabatan,
                    'ttl' => $ttl,
                    'jenis_kelamin' => $jenis_kelamin,
                    'pendidikan_jurusan' => $pendidikan_jurusan,
                    'penempatan_sebagai' => $penempatan_sebagai,
                    'status_kepegawaian' => $status_kepegawaian,
                    'pangkat_gol' => $pangkat_gol,
                    'nomor_tgl_sk' => $nomor_tgl_sk,
                    'pangkat_terakhir' => $pangkat_terakhir,
                    'tugas_disekolah' => $tugas_disekolah,
                    'mengajar_mp' => $mengajar_mp,
                    'gambar' => $gambar
                );

                $this->Pegawai_model->tambahDataPegawai($data);

                $this->session->set_flashdata('flash', 'Pegawai Berhasil Ditambahkan');
                redirect('pegawai');
            }
        }
    }
    //end Tambah Data

    //Hapus Data
    public function hapus($id)
    {
        $gambar_lama = $this->Pegawai_model->getGambarById($id);
        $path = './assets/img/' . $gambar_lama['gambar'];

        if (file_exists($path)) {
            unlink($path);
        }

        $this->Pegawai_model->hapusDataPegawai($id);
        $this->session->set_flashdata('flash', 'Pegawai Berhasil Dihapus');
        redirect('pegawai');
    }
    //end Hapus Data


    //Detail Data
    public function detail($id)
    {
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Detail Data Pegawai';
        $data['pegawai'] = $this->Pegawai_model->getPegawaiById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('pegawai/detail', $data);
        $this->load->view('templates/footer');
    }
    //end Detail Data


    //Ubah Data
    public function ubah($id)
    {
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Form Ubah Data Pegawai';
        $data['pegawai'] = $this->Pegawai_model->getPegawaiById($id);
        $data['status_nomor_induk'] = ['NIP', 'NRGT', 'NRPTK'];
        $data['jenis_kelamin'] = ['Perempuan', 'Laki-Laki'];
        $data['penempatan_sebagai'] = ['Kepala Sekolah', 'Wakil Kepala Sekolah', 'Guru', 'TU'];
        $data['status_kepegawaian'] = ['PNS', 'PTK Non ASN', 'Honor Komite'];

        $this->load->view('templates/header', $data);
        $this->load->view('pegawai/ubah', $data);
        $this->load->view('templates/footer');
    }
    //end Ubah Data

    public function ubahData()
    {
        $id = $this->input->post('id');

        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Form Ubah Data Pegawai';
        $data['pegawai'] = $this->Pegawai_model->getPegawaiById($id);
        $data['status_nomor_induk'] = ['NIP', 'NRGT', 'NRPTK'];
        $data['jenis_kelamin'] = ['Perempuan', 'Laki- Laki'];
        $data['penempatan_sebagai'] = ['Kepala Sekolah', 'Wakil Kepala Sekolah', 'Guru', 'TU'];
        $data['status_kepegawaian'] = ['PNS', 'PTK Non ASN', 'Honor Komite'];

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nomor_induk', 'Nomor Induk', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('ttl', 'Tempat Tanggal Lahir', 'required');
        $this->form_validation->set_rules('pendidikan_jurusan', 'Pendidikan Jurusan', 'required');
        $this->form_validation->set_rules('pangkat_gol', 'Pangkat - Gol. Ruang', 'required');
        $this->form_validation->set_rules('nomor_tgl_sk', 'Nomor Tanggal SK', 'required');
        $this->form_validation->set_rules('pangkat_terakhir', 'Pangkat Terakhir', 'required');
        $this->form_validation->set_rules('tugas_disekolah', 'Tugas Disekolah Ini', 'required');
        $this->form_validation->set_rules('mengajar_mp', 'Mengajar Mata Pelajaran', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('pegawai/ubah', $data);
            $this->load->view('templates/footer');
        } else {

            $gambar_lama = $this->Pegawai_model->getGambarById($id);
            $path = './assets/img/' . $gambar_lama['gambar'];

            if (file_exists($path)) {
                unlink($path);
            }

            $config['upload_path']          = './assets/img/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {

                $gambar = $this->upload->data();
                $gambar = $gambar['file_name'];
                $nama = $this->input->post('nama', true);
                $status_nomor_induk = $this->input->post('status_nomor_induk', true);
                $nomor_induk = $this->input->post('nomor_induk', true);
                $email = $this->input->post('email', true);
                $password = $this->input->post('password', true);
                $jabatan = $this->input->post('jabatan', true);
                $ttl = $this->input->post('ttl', true);
                $jenis_kelamin = $this->input->post('jenis_kelamin', true);
                $pendidikan_jurusan = $this->input->post('pendidikan_jurusan', true);
                $penempatan_sebagai = $this->input->post('penempatan_sebagai', true);
                $status_kepegawaian = $this->input->post('status_kepegawaian', true);
                $pangkat_gol = $this->input->post('pangkat_gol', true);
                $nomor_tgl_sk = $this->input->post('nomor_tgl_sk', true);
                $pangkat_terakhir = $this->input->post('pangkat_terakhir', true);
                $tugas_disekolah = $this->input->post('tugas_disekolah', true);
                $mengajar_mp = $this->input->post('mengajar_mp', true);

                $data = array(
                    'nama' => $nama,
                    'status_nomor_induk' => $status_nomor_induk,
                    'nomor_induk' => $nomor_induk,
                    'email' => $email,
                    'password' => $password,
                    'jabatan' => $jabatan,
                    'ttl' => $ttl,
                    'jenis_kelamin' => $jenis_kelamin,
                    'pendidikan_jurusan' => $pendidikan_jurusan,
                    'penempatan_sebagai' => $penempatan_sebagai,
                    'status_kepegawaian' => $status_kepegawaian,
                    'pangkat_gol' => $pangkat_gol,
                    'nomor_tgl_sk' => $nomor_tgl_sk,
                    'pangkat_terakhir' => $pangkat_terakhir,
                    'tugas_disekolah' => $tugas_disekolah,
                    'mengajar_mp' => $mengajar_mp,
                    'gambar' => $gambar
                );

                $this->Pegawai_model->ubahDataPegawai($id, $data);

                $this->session->set_flashdata('flash', 'Pegawai Berhasil dirubah');
                redirect('pegawai');
            } else {

                $nama = $this->input->post('nama', true);
                $status_nomor_induk = $this->input->post('status_nomor_induk', true);
                $nomor_induk = $this->input->post('nomor_induk', true);
                $email = $this->input->post('email', true);
                $password = $this->input->post('password', true);
                $jabatan = $this->input->post('jabatan', true);
                $ttl = $this->input->post('ttl', true);
                $jenis_kelamin = $this->input->post('jenis_kelamin', true);
                $pendidikan_jurusan = $this->input->post('pendidikan_jurusan', true);
                $penempatan_sebagai = $this->input->post('penempatan_sebagai', true);
                $status_kepegawaian = $this->input->post('status_kepegawaian', true);
                $pangkat_gol = $this->input->post('pangkat_gol', true);
                $nomor_tgl_sk = $this->input->post('nomor_tgl_sk', true);
                $pangkat_terakhir = $this->input->post('pangkat_terakhir', true);
                $tugas_disekolah = $this->input->post('tugas_disekolah', true);
                $mengajar_mp = $this->input->post('mengajar_mp', true);

                $data = array(
                    'nama' => $nama,
                    'status_nomor_induk' => $status_nomor_induk,
                    'nomor_induk' => $nomor_induk,
                    'email' => $email,
                    'password' => $password,
                    'jabatan' => $jabatan,
                    'ttl' => $ttl,
                    'jenis_kelamin' => $jenis_kelamin,
                    'pendidikan_jurusan' => $pendidikan_jurusan,
                    'penempatan_sebagai' => $penempatan_sebagai,
                    'status_kepegawaian' => $status_kepegawaian,
                    'pangkat_gol' => $pangkat_gol,
                    'nomor_tgl_sk' => $nomor_tgl_sk,
                    'pangkat_terakhir' => $pangkat_terakhir,
                    'tugas_disekolah' => $tugas_disekolah,
                    'mengajar_mp' => $mengajar_mp
                );

                $this->Pegawai_model->ubahDataPegawai($id, $data);

                $this->session->set_flashdata('flash', 'Dirubah Tanpa Gambar');
                redirect('pegawai');
            }
        }
    }
}
