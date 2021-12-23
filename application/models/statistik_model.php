<?php

class statistik_model extends CI_model
{


    public function getDataGuruMasuk($tanggal)
    {
        $query = $this->db->select("absen_manual.status_absen, absen_manual.tanggal_absen")
            ->join('pegawai', 'pegawai.id = absen_manual.id_pegawai')
            ->where('absen_manual.tanggal_absen', $tanggal)
            ->where('absen_manual.status_absen', 1)
            ->where("(pegawai.penempatan_sebagai = 'Guru' OR pegawai.penempatan_sebagai ='Kepala Sekolah' OR pegawai.penempatan_sebagai = 'Wakil Kepala Sekolah')")
            ->get('absen_manual');

        return $query->result_array();
    }

    public function getDataGuruTidakMasuk($tanggal)
    {
        $query = $this->db->select("absen_manual.status_absen, absen_manual.tanggal_absen")
            ->join('pegawai', 'pegawai.id = absen_manual.id_pegawai')
            ->where('absen_manual.tanggal_absen', $tanggal)
            ->where('absen_manual.status_absen != 1')
            ->where("(pegawai.penempatan_sebagai = 'Guru' OR pegawai.penempatan_sebagai ='Kepala Sekolah' OR pegawai.penempatan_sebagai = 'Wakil Kepala Sekolah')")
            ->get('absen_manual');

        return $query->result_array();
    }

    public function getDataTUMasuk($tanggal)
    {
        $query = $this->db->select("absen_manual.status_absen, absen_manual.tanggal_absen")
            ->join('pegawai', 'pegawai.id = absen_manual.id_pegawai')
            ->where('absen_manual.tanggal_absen', $tanggal)
            ->where('absen_manual.status_absen', 1)
            ->where("pegawai.penempatan_sebagai = 'TU'")
            ->get('absen_manual');

        return $query->result_array();
    }

    public function getDataTUTidakMasuk($tanggal)
    {
        $query = $this->db->select("absen_manual.status_absen, absen_manual.tanggal_absen")
            ->join('pegawai', 'pegawai.id = absen_manual.id_pegawai')
            ->where('absen_manual.tanggal_absen', $tanggal)
            ->where('absen_manual.status_absen != 1')
            ->where("pegawai.penempatan_sebagai = 'TU'")
            ->get('absen_manual');

        return $query->result_array();
    }

    public function getStatistikAbsen($bulan, $tahun, $id_pegawai, $status_absen)
    {
        $query = $this->db->select("pegawai.nama, absen_manual.tanggal_absen")
            ->join('pegawai', 'pegawai.id = absen_manual.id_pegawai')
            ->where('MONTH(absen_manual.tanggal_absen)', $bulan)
            ->where('YEAR(absen_manual.tanggal_absen)', $tahun)
            ->where('pegawai.id', $id_pegawai)
            ->where('absen_manual.status_absen', $status_absen)
            ->get('absen_manual');

        return $query->result_array();
    }
}
