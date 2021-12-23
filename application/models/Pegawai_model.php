<?php

class Pegawai_model extends CI_model
{

    public function getTypePegawai($type = null)
    {
        $this->db->select('*');
        $this->db->from('pegawai');
        $this->db->where('penempatan_sebagai', $type);
        return $this->db->get()->result_array();
    }

    public function getAllPegawai()
    {
        $tanggal_absen = date('Y-m-d');
        $query = $this->db->query("SELECT * FROM pegawai ORDER BY FIELD(penempatan_sebagai, 'Kepala Sekolah','Wakil Kepala Sekolah', 'Guru', 'TU')");
        // $query = $this->db->query("SELECT * FROM pegawai WHERE pegawai.id not in (SELECT absen_manual.id_pegawai from absen_manual WHERE absen_manual.tanggal_absen = $tanggal_absen)");
        // $query = $this->db->query(("SELECT *
        // FROM pegawai
        // WHERE EXISTS (
        //        SELECT id
        //            FROM absen_manual
        //            WHERE absen_manual.id_pegawai = pegawai.id
        //            AND tanggal_absen = $tanggal_absen
        // )"));
        return $query->result_array();
    }

    public function tambahDataPegawai($data)
    {

        $this->db->insert('pegawai', $data);
    }

    public function hapusDataPegawai($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pegawai');
    }


    public function getPegawaiById($id)
    {
        return $this->db->get_where('pegawai', ['id' => $id])->row_array();
    }

    public function ubahDataPegawai($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('pegawai', $data);
    }

    // //Cari Data
    public function cariDataPegawai()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        return $this->db->get('pegawai')->result_array();
    }
    // //end Cari Data

    public function getGambarById($id)
    {
        $this->db->select('gambar');
        $this->db->from('pegawai');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }
}
