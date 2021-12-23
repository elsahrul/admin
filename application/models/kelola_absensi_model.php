<?php

class kelola_absensi_model extends CI_model
{
    public function getMasuk()
    {
        return $this->db->get('waktu_absensi')->result_array();
    }

    public function tambahWaktuAbsensi()
    {
        $dataWaktu = $this->db->query("SELECT * FROM `waktu_absensi` ORDER BY id DESC LIMIT 1")->row_array();
        if ($dataWaktu == null) {

            $data = [
                "masuk" => $this->input->post('masuk', true),
                "pulang" => $this->input->post('pulang', true),
                "toleransi" => $this->input->post('toleransi', true),
            ];

            $this->db->insert('waktu_absensi', $data);
        } else {

            $data = [
                "masuk" => $this->input->post('masuk', true),
                "pulang" => $this->input->post('pulang', true),
                "toleransi" => $this->input->post('toleransi', true),
            ];

            $this->db->update('waktu_absensi', $data, ['id' => $dataWaktu['id']]);
        }
    }

    public function tambahHariLibur()
    {
        $data = [
            "tanggal" => $this->input->post('tanggal', true),
            "keterangan" => $this->input->post('keterangan', true),
        ];

        $this->db->insert('hari_libur', $data);
    }

    public function absenPegawai($id, $status)
    {
        $data = [
            "id_pegawai" => $id,
            "status_absen" => $status,
            "jam_masuk" => "-",
            "jam_pulang" => "-",
            "tanggal_absen" => date("Y-m-d"),
        ];

        $this->db->insert('absen_manual', $data);
    }

    //Cari Data
    public function cariDataPegawai()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        return $this->db->get('pegawai')->result_array();
    }
    //end Cari Data


    public function getAllHarilibur()
    {
        return $this->db->get('hari_libur')->result_array();
    }


    public function getDataAbsenHarian($tanggal_hari_ini, $status_absen)
    {
        if ($status_absen == 1) {
            $query = $this->db->select('*')
                ->join('pegawai', 'pegawai.id = absen_manual.id_pegawai')
                ->where('absen_manual.tanggal_absen', $tanggal_hari_ini)
                ->where('absen_manual.status_absen', 1)
                ->get('absen_manual');
        } else if ($status_absen == null) {
            $query = $this->db->select('*')
                ->join('pegawai', 'pegawai.id = absen_manual.id_pegawai')
                ->where('absen_manual.tanggal_absen', $tanggal_hari_ini)
                ->where('absen_manual.status_absen !=', 1)
                ->get('absen_manual');
        }

        return $query->result_array();
    }

    public function hapusLibur($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('hari_libur');
    }
}
