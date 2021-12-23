<?php

class kelola_laporan_kehadiran_model extends CI_model
{

    //keloladata absensi
    public function rangeDate($date)
    {

        $query = $this->db->select('*')
            ->where('tanggal_absen', $date)
            ->join('pegawai', 'pegawai.id = absen_manual.id_pegawai')
            ->get('absen_manual');

        return $query->result_array();
    }
    //akhir keloladata absensi

    public function checkAbsensiHarian($date, $id_pegawai)
    {
        $query = $this->db->select('*')
            ->where('tanggal_absen', $date)
            ->where('id_pegawai', $id_pegawai)
            ->join('status_absen', 'status_absen.id = absen_manual.status_absen')
            ->get('absen_manual');

        return $query->row();
    }


    public function SetTanggalMerah($month, $year)
    {

        $query = $this->db->query("SELECT tanggal FROM hari_libur WHERE MONTH(tanggal) = '$month' AND YEAR(tanggal) = '$year'");

        return $query->result_array();
    }
}
