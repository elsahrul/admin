<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi_model extends CI_Model
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
}
