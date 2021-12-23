<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{

    // fungsi check login
    function get_barcode()
    {
        $this->db->get_where('barcode', ['id' => 1])->row();
    }

    // fungsi check login
    function update_barcode($created_at, $expired_at)
    {
        $this->db->set('created_at', $created_at);
        $this->db->set('expired_at', $expired_at);
        $this->db->where('id', 1);
        $this->db->update('barcode');
    }

    public function getAbsenConfig()
    {
        $this->db->select('*');
        $this->db->from('waktu_absensi');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();

        return $query->row();
    }

    public function j_guru()
    {
        $query = $this->db->get_where('pegawai', ['penempatan_sebagai' => 'Guru']);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function j_tata_usaha()
    {
        $query = $this->db->get_where('pegawai', ['penempatan_sebagai' => 'TU']);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function j_kepala_sekolah()
    {
        $query = $this->db->get_where('pegawai', ['penempatan_sebagai' => 'Kepala Sekolah']);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function j_w_kepala_sekolah()
    {
        $query = $this->db->get_where('pegawai', ['penempatan_sebagai' => 'Wakil Kepala Sekolah']);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
}
