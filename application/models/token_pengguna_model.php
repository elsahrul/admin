<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Token_pengguna_model extends CI_Model
{
    public function getAllTokenpengguna()
    {
        $this->db->select('pegawai.nama,token_pengguna.id AS id_token,token_pengguna.token');
        $this->db->join('pegawai', 'pegawai.id=token_pengguna.id_pegawai');

        return $this->db->get('token_pengguna')->result_array();
    }

    public function hapusSemuaToken()
    {
        return $this->db->empty_table('token_pengguna');
    }

    public function hapusToken($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('token_pengguna');
    }
}
