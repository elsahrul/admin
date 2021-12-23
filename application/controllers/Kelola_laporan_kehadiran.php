<?php

class kelola_laporan_kehadiran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!get_instance()->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('kelola_laporan_kehadiran_model');
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            $data['judul'] = 'Laporan Kehadiran';
            $this->load->view('templates/header', $data);
            $this->load->view('kelola_laporan_kehadiran/index');
            $this->load->view('templates/footer');
        }
    }


    ///////////////////////////////////////////////////////////-KELOLA LAPORAN GURU HARIAN-////////////////////////////////////////////

    public function laporanGuruHarian()
    {
        header('Content-Type: application/json');
        $date = $this->input->post('LihatTanggalPerhari');

        echo json_encode(array('cek' => $this->QueryGuruHarian($date, 'lihat')));
    }

    protected function QueryGuruHarian($date, $tipe)
    {
        $date_reformat = date('Y-m-d', strtotime($date));

        //////ini query standart//////
        $pns_harian = $this->db->query("SELECT pegawai.nama, absen_manual.jam_masuk, absen_manual.jam_pulang, absen_manual.tanggal_absen, status_absen.keterangan
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE absen_manual.tanggal_absen = '$date_reformat' AND pegawai.status_kepegawaian = 'PNS' AND (pegawai.penempatan_sebagai = 'Guru' OR pegawai.penempatan_sebagai = 'Kepala Sekolah' OR  pegawai.penempatan_sebagai = 'Wakil Kepala Sekolah')");

        $non_asn_harian = $this->db->query("SELECT pegawai.nama, absen_manual.jam_masuk, absen_manual.jam_pulang, absen_manual.tanggal_absen, status_absen.keterangan
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE absen_manual.tanggal_absen = '$date_reformat' AND pegawai.status_kepegawaian = 'PTK Non ASN' AND pegawai.penempatan_sebagai = 'Guru'");

        $honor_harian = $this->db->query("SELECT pegawai.nama, absen_manual.jam_masuk, absen_manual.jam_pulang, absen_manual.tanggal_absen, status_absen.keterangan
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE absen_manual.tanggal_absen = '$date_reformat' AND pegawai.status_kepegawaian = 'Honor Komite' AND pegawai.penempatan_sebagai = 'Guru'");


        $TabelGuruAbsensiHarian = '';

        $TabelGuruAbsensiHarian .= '
                        <div class="container">
                            <div class="text-center">
                                <h5><strong>REKAPITULASI KEHADIRAN GURU </strong></h5>
                                <p>
                                <h5><strong>' . date('d', strtotime($date)) . ' ' . bulan(date('m', strtotime($date))) . ' ' . date('Y') . '</strong></p>
                                </h5>
                             </div>
                        </div>
                        <table id="tabelSatu" class="table table-sm table-bordered" border="1">
                            <thead>
                                <tr>
                                    <td colspan="6" style="text-align: center;"><strong>Pegawai Negeri Sipil (PNS)</strong></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Nama</th>
                                    <th style="text-align: center;">Absen Masuk</th>
                                    <th style="text-align: center;">Absen Pulang</th>
                                    <th style="text-align: center;">Tanggal Masuk</th>
                                    <th style="text-align: center;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                            ';
        $no = 1;
        if ($pns_harian->num_rows() > 0) {
            foreach ($pns_harian->result() as $key => $value) {

                $TabelGuruAbsensiHarian .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="width:350px;">' . $value->nama . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="text-align: center;">' . $value->jam_masuk . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="text-align: center;">' . $value->jam_pulang . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="text-align: center;">' . date('d-F-Y', strtotime($value->tanggal_absen)) . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="text-align: center;">' . $value->keterangan . '</td>';
                $no++;
            }
        } else {
            $TabelGuruAbsensiHarian .= '<tr><td style="text-align: center;" colspan="6">Data tidak ditemukan</td></tr>';
        }
        $TabelGuruAbsensiHarian .= '</tbody>
                            </table>
                            <table id="tabelSatu" class="table table-sm table-bordered" border="1">
                            <thead>
                                <tr>
                                    <td colspan="10" style="text-align: center;"><strong>PTK Non ASN</strong></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Nama</th>
                                    <th style="text-align: center;">Absen Masuk</th>
                                    <th style="text-align: center;">Absen Pulang</th>
                                    <th style="text-align: center;">Tanggal Masuk</th>
                                    <th style="text-align: center;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>';
        $no = 1;
        if ($non_asn_harian->num_rows() > 0) {
            foreach ($non_asn_harian->result() as $key => $value) {

                $TabelGuruAbsensiHarian .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="width:350px;">' . $value->nama . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="text-align: center;">' . $value->jam_masuk . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="text-align: center;">' . $value->jam_pulang . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="text-align: center;">' . date('d-F-Y', strtotime($value->tanggal_absen)) . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="text-align: center;">' . $value->keterangan . '</td>';
                $no++;
            }
        } else {
            $TabelGuruAbsensiHarian .= '<tr><td style="text-align: center;" colspan="6">Data tidak ditemukan</td></tr>';
        }
        $TabelGuruAbsensiHarian .= '</tbody>
                            </table>
                            <table id="tabelSatu" class="table table-sm table-bordered" border="1">
                            <thead>
                                <tr>
                                    <td colspan="10" style="text-align: center;"><strong>Guru Honor Komite</strong></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Nama</th>
                                    <th style="text-align: center;">Absen Masuk</th>
                                    <th style="text-align: center;">Absen Pulang</th>
                                    <th style="text-align: center;">Tanggal Masuk</th>
                                    <th style="text-align: center;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>';
        $no = 1;
        if ($honor_harian->num_rows() > 0) {
            foreach ($honor_harian->result() as $key => $value) {

                $TabelGuruAbsensiHarian .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="width:350px;">' . $value->nama . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="text-align: center;">' . $value->jam_masuk . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="text-align: center;">' . $value->jam_pulang . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="text-align: center;">' . date('d-F-Y', strtotime($value->tanggal_absen)) . '</td>';
                $TabelGuruAbsensiHarian .= '<td style="text-align: center;">' . $value->keterangan . '</td>';
                $no++;
            }
        } else {
            $TabelGuruAbsensiHarian .= '<tr><td style="text-align: center;" colspan="6">Data tidak ditemukan</td></tr>';
        }

        return $TabelGuruAbsensiHarian;
    }
    ///////////////////////////////////////////////////////////-AKHIR KELOLA LAPORAN GURU HARIAN-////////////////////////////////////////////



    ///////////////////////////////////////////////////////////-KELOLA LAPORAN TU HARIAN-////////////////////////////////////////////
    public function laporanTuHarian()
    {
        header('Content-Type: application/json');
        $date = $this->input->post('LihatTanggalTuPerhari');

        echo json_encode(array('cek' => $this->QueryTuHarian($date, 'lihat')));
    }

    protected function QueryTuHarian($date, $tipe)
    {
        $date_reformat = date('Y-m-d', strtotime($date));
        //ini query standart
        $pns_harian = $this->db->query("SELECT pegawai.nama, absen_manual.jam_masuk, absen_manual.jam_pulang, absen_manual.tanggal_absen, status_absen.keterangan
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE absen_manual.tanggal_absen = '$date_reformat' AND pegawai.status_kepegawaian = 'PNS' AND pegawai.penempatan_sebagai = 'TU' ");

        $non_asn_harian = $this->db->query("SELECT pegawai.nama, absen_manual.jam_masuk, absen_manual.jam_pulang, absen_manual.tanggal_absen, status_absen.keterangan
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE absen_manual.tanggal_absen = '$date_reformat' AND pegawai.status_kepegawaian = 'PTK Non ASN' AND pegawai.penempatan_sebagai = 'TU'");

        $honor_harian = $this->db->query("SELECT pegawai.nama, absen_manual.jam_masuk, absen_manual.jam_pulang, absen_manual.tanggal_absen, status_absen.keterangan
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE absen_manual.tanggal_absen = '$date_reformat' AND pegawai.status_kepegawaian = 'Honor Komite' AND pegawai.penempatan_sebagai = 'TU'");


        $TabelTuAbsensiHarian = '';

        if ($tipe == 'cetak') {

            $TabelTuAbsensiHarian .= '';
            $TabelTuAbsensiHarian .= '';
        }

        $TabelTuAbsensiHarian .= '
                        <div class="container">
                            <div class="text-center">
                                <h5><strong>REKAPITULASI KEHADIRAN TATA USAHA DAN LAYANAN KHUSUS </strong></h5>
                                <p>
                                <h5><strong>' . date('d', strtotime($date)) . ' ' . bulan(date('m', strtotime($date))) . ' ' . date('Y') . '</strong></p>
                                </h5>
                             </div>
                        </div>
                        <table id="tabelSatu" class="table table-sm table-bordered" border="1">
                            <thead>
                                <tr>
                                    <td colspan="10" style="text-align: center;"><strong>Pegawai Negeri Sipil (PNS)</strong></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Nama</th>
                                    <th style="text-align: center;">Absen Masuk</th>
                                    <th style="text-align: center;">Absen Pulang</th>
                                    <th style="text-align: center;">Tanggal Masuk</th>
                                    <th style="text-align: center;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                            ';
        $no = 1;
        if ($pns_harian->num_rows() > 0) {
            foreach ($pns_harian->result() as $key => $value) {

                $TabelTuAbsensiHarian .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelTuAbsensiHarian .= '<td style="width:350px;">' . $value->nama . '</td>';
                $TabelTuAbsensiHarian .= '<td style="text-align: center;">' . $value->jam_masuk . '</td>';
                $TabelTuAbsensiHarian .= '<td style="text-align: center;">' . $value->jam_pulang . '</td>';
                $TabelTuAbsensiHarian .= '<td style="text-align: center;">' . date('d-F-Y', strtotime($value->tanggal_absen)) . '</td>';
                $TabelTuAbsensiHarian .= '<td style="text-align: center;">' . $value->keterangan . '</td>';
                $no++;
            }
        } else {
            $TabelTuAbsensiHarian .= '<tr><td style="text-align: center;" colspan="6">Data tidak ditemukan</td></tr>';
        }


        $TabelTuAbsensiHarian .= '</tbody>
                            </table>
                            <table id="tabelSatu" class="table table-sm table-bordered" border="1">
                            <thead>
                                <tr>
                                    <td colspan="10" style="text-align: center;"><strong>Guru Honor Komite</strong></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Nama</th>
                                    <th style="text-align: center;">Absen Masuk</th>
                                    <th style="text-align: center;">Absen Pulang</th>
                                    <th style="text-align: center;">Tanggal Masuk</th>
                                    <th style="text-align: center;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>';
        $no = 1;
        if ($honor_harian->num_rows() > 0) {
            foreach ($honor_harian->result() as  $value) {

                $TabelTuAbsensiHarian .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelTuAbsensiHarian .= '<td style="width:350px;">' . $value->nama . '</td>';
                $TabelTuAbsensiHarian .= '<td style="text-align: center;">' . $value->jam_masuk . '</td>';
                $TabelTuAbsensiHarian .= '<td style="text-align: center;">' . $value->jam_pulang . '</td>';
                $TabelTuAbsensiHarian .= '<td style="text-align: center;">' . date('d-F-Y', strtotime($value->tanggal_absen)) . '</td>';
                $TabelTuAbsensiHarian .= '<td style="text-align: center;">' . $value->keterangan . '</td>';
                $no++;
            }
        } else {
            $TabelTuAbsensiHarian .= '<tr><td style="text-align: center;" colspan="6">Data tidak ditemukan</td></tr>';
        }

        return $TabelTuAbsensiHarian;
    }
    ///////////////////////////////////////////////////////////-AKHIR KELOLA LAPORAN TU HARIAN-////////////////////////////////////////////




    ///////////////////////////////////////////////////////////-EXCELL LAPORAN GURU HARIAN-////////////////////////////////////////////
    public function exportGuruHarian()
    {

        // include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $date = $this->input->post('LihatTanggalPerhari');
        $date_reformat = date('Y-m-d', strtotime($date));


        //ini query standart
        $pns_harian = $this->db->query("SELECT pegawai.nama, absen_manual.jam_masuk, absen_manual.jam_pulang, absen_manual.tanggal_absen, status_absen.keterangan
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE absen_manual.tanggal_absen = '$date_reformat' AND pegawai.status_kepegawaian = 'PNS' AND (pegawai.penempatan_sebagai = 'Guru' OR pegawai.penempatan_sebagai = 'Kepala Sekolah' OR  pegawai.penempatan_sebagai = 'Wakil Kepala Sekolah')");

        $non_asn_harian = $this->db->query("SELECT pegawai.nama, absen_manual.jam_masuk, absen_manual.jam_pulang, absen_manual.tanggal_absen, status_absen.keterangan
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE absen_manual.tanggal_absen = '$date_reformat' AND pegawai.status_kepegawaian = 'PTK Non ASN' AND pegawai.penempatan_sebagai = 'Guru'");

        $honor_harian = $this->db->query("SELECT pegawai.nama, absen_manual.jam_masuk, absen_manual.jam_pulang, absen_manual.tanggal_absen, status_absen.keterangan
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE absen_manual.tanggal_absen = '$date_reformat' AND pegawai.status_kepegawaian = 'Honor Komite' AND pegawai.penempatan_sebagai = 'Guru'");

        $excelData = '';

        $excelData .= '<table id="tabelSatu" class="table table-sm table-bordered" border="0">
        <tr>
            <td colspan="6" style="text-align: center;"><strong>REKAPITULASI KEHADIRAN GURU</strong></td>
            </tr>
            <tr>
            <td colspan="6" style="text-align: center;"><strong>' . date('d', strtotime($date)) . ' ' . bulan(date('m', strtotime($date))) . ' ' . date('Y') . '</strong></td> 
            </tr>
            <tr>
            <td> </td>
            </tr>
        </table>
        <table id="tabelSatu" class="table table-sm table-bordered" border="1">
        <thead>
            <tr>
                <td colspan="6" style="text-align: center;"><strong>Pegawai Negeri Sipil (PNS)</strong></td>
            </tr>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Absen Masuk</th>
                <th>Absen Pulang</th>
                <th>Tanggal Masuk</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>';


        if ($pns_harian->num_rows() > 0) {
            $no = 1;
            foreach ($pns_harian->result() as $row) {
                $excelData .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $excelData .= '<td>' . $row->nama . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->jam_masuk . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->jam_pulang . '</td>';
                $excelData .= '<td style="text-align: center;">' . date('d', strtotime($row->tanggal_absen)) . ' ' . bulan(date('m', strtotime($row->tanggal_absen))) . ' ' . date('Y', strtotime($row->tanggal_absen)) . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->keterangan . '</td>';
                $no++;
            }
        } else {
            $excelData .= '<tr><td style="text-align: center;" colspan="6">Data tidak ada</td></tr>';
        }

        $excelData .= '<table id="tabelSatu" class="table table-sm table-bordered" border="1">
        <thead>
            <tr>
                <td colspan="6" style="text-align: center;"><strong>PTK Non ASN</strong></td>
            </tr>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Absen Masuk</th>
                <th>Absen Pulang</th>
                <th>Tanggal Masuk</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>';


        if ($non_asn_harian->num_rows() > 0) {
            $no = 1;
            foreach ($non_asn_harian->result() as $row) {
                $excelData .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $excelData .= '<td>' . $row->nama . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->jam_masuk . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->jam_pulang . '</td>';
                $excelData .= '<td style="text-align: center;">' . date('d', strtotime($row->tanggal_absen)) . ' ' . bulan(date('m', strtotime($row->tanggal_absen))) . ' ' . date('Y', strtotime($row->tanggal_absen)) . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->keterangan . '</td>';
                $no++;
            }
        } else {
            $excelData .= '<tr><td style="text-align: center;" colspan="6">Data tidak ada</td></tr>';
        }

        $excelData .= '<table id="tabelSatu" class="table table-sm table-bordered" border="1">
        <thead>
            <tr>
                <td colspan="6" style="text-align: center;"><strong>Guru Honor Komite</strong></td>
            </tr>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Absen Masuk</th>
                <th>Absen Pulang</th>
                <th>Tanggal Masuk</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>';


        if ($honor_harian->num_rows() > 0) {
            $no = 1;
            foreach ($honor_harian->result() as $row) {
                $excelData .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $excelData .= '<td>' . $row->nama . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->jam_masuk . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->jam_pulang . '</td>';
                $excelData .= '<td style="text-align: center;">' . date('d', strtotime($row->tanggal_absen)) . ' ' . bulan(date('m', strtotime($row->tanggal_absen))) . ' ' . date('Y', strtotime($row->tanggal_absen)) . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->keterangan . '</td>';
                $no++;
            }
        } else {
            $excelData .= '<tr><td style="text-align: center;" colspan="6">Data tidak ada</td></tr></table>
             
        ';
        }

        $excelData .= '
        <table border="0" width="100%">
        <tr><td style="text-align: center; height:50;" colspan="6"></td></tr>
        <tr><td colspan="4"></td><td colspan="2">KEPALA SMK NEGERI 1 BINTAN TIMUR</td></tr>
         <tr><td style="text-align: center; height:60;" colspan="6"></td></tr>
        <tr><td style="text-align: center;" colspan="4"></td><td  colspan="4">Yayuk Sri Mulyani Rahayu, S.Pd, MM</td></tr>
        <tr><td style="text-align: center;" colspan="4"></td><td  colspan="4">NIP. 19770421 200502 2 011</td></tr>
        ';
        $excelData .= '
        </table>';


        $filename = "Absensi_Perhari_Guru" . '.xlsx';

        header('content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachement;filename=' . $filename);

        echo $excelData;

        exit;
    }
    ///////////////////////////////////////////////////////////-AKHIR EXCELL LAPORAN GURU HARIAN-////////////////////////////////////////////



    ///////////////////////////////////////////////////////////-EXCELL LAPORAN TU HARIAN-////////////////////////////////////////////
    public function exportTuHarian()
    {
        // include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        $date = $this->input->post('LihatTanggalTuPerhari');
        $date_reformat = date('Y-m-d', strtotime($date));

        $pns_harian = $this->db->query("SELECT pegawai.nama, absen_manual.jam_masuk, absen_manual.jam_pulang, absen_manual.tanggal_absen, status_absen.keterangan
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE absen_manual.tanggal_absen = '$date_reformat' AND pegawai.status_kepegawaian = 'PNS' AND pegawai.penempatan_sebagai = 'TU'");

        $non_asn_harian = $this->db->query("SELECT pegawai.nama, absen_manual.jam_masuk, absen_manual.jam_pulang, absen_manual.tanggal_absen, status_absen.keterangan
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE absen_manual.tanggal_absen = '$date_reformat' AND pegawai.status_kepegawaian = 'PTK Non ASN' AND pegawai.penempatan_sebagai = 'TU'");

        $honor_harian = $this->db->query("SELECT pegawai.nama, absen_manual.jam_masuk, absen_manual.jam_pulang, absen_manual.tanggal_absen,     status_absen.keterangan
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE absen_manual.tanggal_absen = '$date_reformat' AND pegawai.status_kepegawaian = 'Honor Komite' AND pegawai.penempatan_sebagai = 'TU'");

        $excelData = '';

        $excelData .= '<table id="tabelSatu" class="table table-sm table-bordered" border="0">
        <tr>
            <td colspan="6" style="text-align: center;"><strong>REKAPITULASI KEHADIRAN TATA USAHA DAN LAYANAN KHUSUS</strong></td>
            </tr>
            <tr>
            <td colspan="6" style="text-align: center;"><strong>' . date('d', strtotime($date)) . ' ' . bulan(date('m', strtotime($date))) . ' ' . date('Y') . '</strong></td> 
            </tr>
            <tr>
            <td> </td>
            </tr>
        </table>
        <table id="tabelSatu" class="table table-sm table-bordered" border="1">
        <thead>
            <tr>
                <td colspan="6" style="text-align: center;"><strong>Pegawai Negeri Sipil (PNS)</strong></td>
            </tr>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Absen Masuk</th>
                <th>Absen Pulang</th>
                <th>Tanggal Masuk</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>';


        if ($pns_harian->num_rows() > 0) {
            $no = 1;
            foreach ($pns_harian->result() as $row) {
                $excelData .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $excelData .= '<td>' . $row->nama . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->jam_masuk . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->jam_pulang . '</td>';
                $excelData .= '<td style="text-align: center;">' . date('d', strtotime($row->tanggal_absen)) . ' ' . bulan(date('m', strtotime($row->tanggal_absen))) . ' ' . date('Y', strtotime($row->tanggal_absen)) . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->keterangan . '</td>';
                $no++;
            }
        } else {
            $excelData .= '<tr><td style="text-align: center;" colspan="6">Data tidak ada</td></tr>';
        }


        $excelData .= '<table id="tabelSatu" class="table table-sm table-bordered" border="1">
        <thead>
            <tr>
                <td colspan="6" style="text-align: center;"><strong>Guru Honor Komite</strong></td>
            </tr>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Absen Masuk</th>
                <th>Absen Pulang</th>
                <th>Tanggal Masuk</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>';


        if ($honor_harian->num_rows() > 0) {
            $no = 1;
            foreach ($honor_harian->result() as $row) {
                $excelData .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $excelData .= '<td>' . $row->nama . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->jam_masuk . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->jam_pulang . '</td>';
                $excelData .= '<td style="text-align: center;">' . date('d', strtotime($row->tanggal_absen)) . ' ' . bulan(date('m', strtotime($row->tanggal_absen))) . ' ' . date('Y', strtotime($row->tanggal_absen)) . '</td>';
                $excelData .= '<td style="text-align: center;">' . $row->keterangan . '</td>';
                $no++;
            }
        } else {
            $excelData .= '<tr><td style="text-align: center;" colspan="6">Data tidak ada</td></tr></table>
             
        ';
        }

        $excelData .= '
        <table border="0" width="100%">
        <tr><td style="text-align: center; height:50;" colspan="6"></td></tr>
        <tr><td colspan="4"></td><td colspan="2">KEPALA SMK NEGERI 1 BINTAN TIMUR</td></tr>
         <tr><td style="text-align: center; height:60;" colspan="6"></td></tr>
        <tr><td style="text-align: center;" colspan="4"></td><td  colspan="4">Yayuk Sri Mulyani Rahayu, S.Pd, MM</td></tr>
        <tr><td style="text-align: center;" colspan="4"></td><td  colspan="4">NIP. 19770421 200502 2 011</td></tr>
        ';
        $excelData .= '
        </table>';

        $filename = "Absensi_Perhari_TU" . '.xlsx';

        header('content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachement;filename=' . $filename);

        echo $excelData;

        exit;
    }
    ///////////////////////////////////////////////////////////-AKHIR EXCELL LAPORAN TU HARIAN-////////////////////////////////////////////




    ///////////////////////////////////////////////////////////-KELOLA LAPORAN GURU BULANAN -////////////////////////////////////////////
    public function laporanGuruBulanan()
    {
        header('Content-Type: application/json');
        $date = $this->input->post('LihatPerbulan');

        echo json_encode(array('cek' => $this->QueryGuruBulanan($date, 'lihat')));
    }

    protected function QueryGuruBulanan($date, $tipe)
    {
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $dateCount = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        //ini query standart
        $pns_harian = $this->db->query("SELECT pegawai.id as id_pegawai, pegawai.nama
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND pegawai.status_kepegawaian = 'PNS' AND (pegawai.penempatan_sebagai = 'Guru' OR pegawai.penempatan_sebagai = 'Kepala Sekolah' OR  pegawai.penempatan_sebagai = 'Wakil Kepala Sekolah') GROUP BY pegawai.nama ORDER BY FIELD(penempatan_sebagai,'Kepala Sekolah','Wakil Kepala Sekolah','Guru')");

        $non_asn_harian = $this->db->query("SELECT pegawai.id as id_pegawai, pegawai.nama
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND pegawai.status_kepegawaian = 'PTK Non ASN' AND pegawai.penempatan_sebagai = 'Guru' GROUP BY pegawai.nama");

        $honor_harian = $this->db->query("SELECT pegawai.id as id_pegawai, pegawai.nama
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND pegawai.status_kepegawaian = 'Honor Komite' AND pegawai.penempatan_sebagai = 'Guru' GROUP BY pegawai.nama");


        $TabelGuruAbsensiBulanan = '';

        //////// Ada di bagian dateCount + 7 untuk panggil banyak colspan judul utama ////////
        $TabelGuruAbsensiBulanan .= '
            <div class="container">
                <div class="text-center">
                    <h5><strong>REKAPITULASI KEHADIRAN GURU </strong></h5>
                    <p>
                    <h5><strong>Bulan ' . bulan(date('m', strtotime($date))) . ' Tahun ' . date('Y') . '</strong></p>
                    </h5>
                </div>
            </div>

        <div class="table-responsive table-bordered">
            <table border="1" width="100%">
                <tr>
                    <td colspan="' . ($dateCount + 7) . '" style="text-align: center;"><strong>Pegawai Negeri Sipil (PNS)</strong></td>
                </tr>
                <tr>
                    <th rowspan="3" style="text-align: center;"  width="20px">No</th>
                    <th rowspan="3" style="text-align: center;" width="250px">Nama</th>
                    <th colspan="' . $dateCount . '" style="text-align: center;">HARI/TANGGAL</th>
                    <th rowspan="2" colspan="5" style="text-align: center;">KETERANGAN</th>
                </tr>
                <tr style=" text-align: center;">
                    ';

        //////// ambil hari, dikonversi ke insial 1 huruf hari indonesia ////////
        // Awal Pemanggilan Bulan //

        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $day_indo = date('D', strtotime("$year-$month-$i"));
            switch ($day_indo) {
                case 'Sun':
                    $TabelGuruAbsensiBulanan .= '<th width="20px">M</th>';
                    break;

                case 'Mon':
                    $TabelGuruAbsensiBulanan .= '<th width=20px">S</th>';
                    break;

                case 'Tue':
                    $TabelGuruAbsensiBulanan .= '<th width=20px">S</th>';
                    break;

                case 'Wed':
                    $TabelGuruAbsensiBulanan .= '<th width=20px">R</th>';
                    break;

                case 'Thu':
                    $TabelGuruAbsensiBulanan .= '<th width=20px">K</th>';
                    break;

                case 'Fri':
                    $TabelGuruAbsensiBulanan .= '<th width=20px">J</th>';
                    break;

                case 'Sat':
                    $TabelGuruAbsensiBulanan .= '<th width=20px">S</th>';
                    break;

                default:
                    $TabelGuruAbsensiBulanan .= '<th>Tidak Dikatahui</th>';
                    break;
            }
        }

        // Akhir pemanggilan bulan //

        $TabelGuruAbsensiBulanan .= '
                </tr>
                <tr style="text-align: center;">
                   ';

        // Pemanggilan tanggal dengan perulangan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $TabelGuruAbsensiBulanan .= '<th>' . $i . '</th>';
        }
        // Akhir pemanggilan tanggal dengan perulangan //

        $TabelGuruAbsensiBulanan .= '
                    <td width="25px">S</td>
                    <td width="25px">I</td>
                    <td width="25px">A</td>
                    <td width="25px">C</td>
                    <td width="25px">DL</td>
                 </tr>
                            ';

        if ($pns_harian->num_rows() > 0) {
            $no = 1;
            foreach ($pns_harian->result() as $row) {
                $TabelGuruAbsensiBulanan .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelGuruAbsensiBulanan .= '<td>' . $row->nama . '</td>';

                $absensi = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai")->result();

                $hari_libur = $this->kelola_laporan_kehadiran_model->SetTanggalMerah($month, $year);

                $items = array();
                foreach ($hari_libur as $hbs) {
                    $items[] = $hbs['tanggal'];
                }

                // PUNYA DIMAS
                for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
                    if ($i < 10) {
                        if (array_search("$year-$month-0$i", $items) !== false) {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-0$i", $row->id_pegawai) .  '</td>';
                        }
                    } else {
                        if (array_search("$year-$month-$i", $items) !== false) {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-$i", $row->id_pegawai) . '</td>';
                        }
                    }
                }

                $sakit = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 2");
                $izin = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 3");
                $alpha = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 4");
                $cuti = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 5");
                $dinasluar = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 6");

                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $sakit->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $izin->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $alpha->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $cuti->num_rows() .  '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $dinasluar->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '</tr>';
                $no++;
            }
        } else {
            $TabelGuruAbsensiBulanan .= '<tr><td style="text-align: center;" colspan="' . ($dateCount + 7) . '">Data tidak ada</td></tr>';
        }

        $TabelGuruAbsensiBulanan .= '
            </table>
        </div>
                            ';



        ////////////////////////////////////////////////////////////////////**Table PTK Non ASN GURU BULANAN**////////////////////////////////////////////////////////////////////
        $TabelGuruAbsensiBulanan .= '
                            <div class="table-responsive table-bordered">
            <table border="1" width="100%">
                <tr>
                    <td colspan="' . ($dateCount + 7) . '" style="text-align: center;"><strong>PTK Non ASN</strong></td>
                </tr>
                <tr>
                    <th rowspan="3" style="text-align: center;"  width="20px">No</th>
                    <th rowspan="3" style="text-align: center;" width="250px">Nama</th>
                    <th colspan="' . $dateCount . '" style="text-align: center;">HARI/TANGGAL</th>
                    <th rowspan="2" colspan="5" style="text-align: center;">KETERANGAN</th>
                </tr>
                <tr style=" text-align: center;">
                    ';

        $TabelGuruAbsensiBulanan .= '
                </tr>
                <tr style=" text-align: center;">
                   ';
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $TabelGuruAbsensiBulanan .= '<th  width=20px">' . $i . '</th>';
        }
        $TabelGuruAbsensiBulanan .= '
                    <td width="25px">S</td>
                    <td width="25px">I</td>
                    <td width="25px">A</td>
                    <td width="25px">C</td>
                    <td width="25px">DL</td>
                 </tr>
                            ';

        if ($non_asn_harian->num_rows() > 0) {
            $no = 1;
            foreach ($non_asn_harian->result() as $row) {
                $TabelGuruAbsensiBulanan .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelGuruAbsensiBulanan .= '<td>' . $row->nama . '</td>';

                $absensi = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai")->result();

                $hari_libur = $this->kelola_laporan_kehadiran_model->SetTanggalMerah($month, $year);

                $items = array();
                foreach ($hari_libur as $hbs) {
                    $items[] = $hbs['tanggal'];
                }

                // PUNYA DIMAS
                for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
                    if ($i < 10) {
                        if (array_search("$year-$month-0$i", $items) !== false) {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-0$i", $row->id_pegawai) .  '</td>';
                        }
                    } else {
                        if (array_search("$year-$month-$i", $items) !== false) {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-$i", $row->id_pegawai) . '</td>';
                        }
                    }
                }

                $sakit = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 2");
                $izin = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 3");
                $alpha = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 4");
                $cuti = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 5");
                $dinasluar = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 6");

                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $sakit->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $izin->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $alpha->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $cuti->num_rows() .  '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $dinasluar->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '</tr>';
                $no++;
            }
        } else {
            $TabelGuruAbsensiBulanan .= '<tr><td style="text-align: center;" colspan="' . ($dateCount + 7) . '">Data tidak ada</td></tr>';
        }

        $TabelGuruAbsensiBulanan .= '
            </table>
            
        </div>
                            ';


        ////////////////////////////////////////////////////////////////////**Table HONOR KOMITE BULANAN**////////////////////////////////////////////////////////////////////
        $TabelGuruAbsensiBulanan .= '
                <div class="table-responsive table-bordered">
        <table border="1" width="100%">
        <tr>
        <td colspan="' . ($dateCount + 7) . '" style="text-align: center;"><strong>Honor Komite</strong></td>
        </tr>
        <tr>
        <th rowspan="3" style="text-align: center;"  width="20px">No</th>
        <th rowspan="3" style="text-align: center;" width="250px">Nama</th>
        <th colspan="' . $dateCount . '" style="text-align: center;">HARI/TANGGAL</th>
        <th rowspan="2" colspan="5" style="text-align: center;">KETERANGAN</th>
        </tr>
        <tr style=" text-align: center;">
        ';


        $TabelGuruAbsensiBulanan .= '
        </tr>
        <tr style=" text-align: center;">
        ';
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $TabelGuruAbsensiBulanan .= '<th  width=20px">' . $i . '</th>';
        }
        $TabelGuruAbsensiBulanan .= '
        <td width="25px">S</td>
        <td width="25px">I</td>
        <td width="25px">A</td>
        <td width="25px">C</td>
        <td width="25px">DL</td>
        </tr>
                ';

        if ($honor_harian->num_rows() > 0) {
            $no = 1;
            foreach ($honor_harian->result() as $row) {
                $TabelGuruAbsensiBulanan .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelGuruAbsensiBulanan .= '<td>' . $row->nama . '</td>';

                $absensi = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai")->result();

                $hari_libur = $this->kelola_laporan_kehadiran_model->SetTanggalMerah($month, $year);

                $items = array();
                foreach ($hari_libur as $hbs) {
                    $items[] = $hbs['tanggal'];
                }

                // PUNYA DIMAS
                for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
                    if ($i < 10) {
                        if (array_search("$year-$month-0$i", $items) !== false) {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-0$i", $row->id_pegawai) .  '</td>';
                        }
                    } else {
                        if (array_search("$year-$month-$i", $items) !== false) {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-$i", $row->id_pegawai) . '</td>';
                        }
                    }
                }

                // foreach ($absensi->result() as $absen) {
                //     if ($absen->status_absen == 2) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> S </td>';
                //     } else if ($absen->status_absen == 3) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> I </td>';
                //     } else if ($absen->status_absen == 4) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> - </td>';
                //     } else if ($absen->status_absen == 5) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> C </td>';
                //     } else if ($absen->status_absen == 6) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> DL </td>';
                //     }
                // }
                $sakit = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 2");
                $izin = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 3");
                $alpha = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 4");
                $cuti = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 5");
                $dinasluar = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 6");

                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $sakit->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $izin->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $alpha->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $cuti->num_rows() .  '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $dinasluar->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '</tr>';
                $no++;
            }
        } else {
            $TabelGuruAbsensiBulanan .= '<tr><td style="text-align: center;" colspan="' . ($dateCount + 7) . '">Data tidak ada</td></tr>';
        }

        $TabelGuruAbsensiBulanan .= '
        </table>
        </div>
                ';
        return $TabelGuruAbsensiBulanan;
    }
    ///////////////////////////////////////////////////////////-AKHIR KELOLA LAPORAN GURU BULANAN -///////////////////////////////////////////////////////////



    ///////////////////////////////////////////////////////////-EXCELL LAPORAN GURU BULANAN-///////////////////////////////////////////////////////////

    public function exportGuruBulanan()
    {

        // include APPPATH . 'third_party/PHPExcel/PHPExcel.php';//
        $date = $this->input->post('LihatPerbulan');
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $dateCount = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $start = new DateTime(date($year . '-' . $month . '-01'));
        $start->format('Y-m-d');
        $interval = new DateInterval('P1D');
        $end = new DateTime(date($year . '-' . $month . '-t'));
        /////kondisi untuk tampilkan tanggal dalam 1 bulan: kondisi pertama untuk 31 hari, kedua untuk 30 hari, ketiga untuk 29 hari (tahun habis bagi 4) dan keempat untuk 28 hari (tidak habis bagi empat)
        if ($month == '01' || $month == '03' || $month == '05' || $month == '07' || $month == '08' || $month == '10' || $month == '12') {
            $end->modify('+1 day')->format('Y-m-d');
            $period = new DatePeriod($start, $interval, $end);
        } else if ($month == '04' || $month == '06' || $month == '09' || $month == '11') {
            $period = new DatePeriod($start, $interval, $end);
        } else if ($month == '02' && $year % 2 == 0) {
            $end->modify('-1 day')->format('Y-m-d');
            $period = new DatePeriod($start, $interval, $end);
        } else if ($month == '02' && $year % 2 != 0) {
            $end->modify('-2 day')->format('Y-m-d');
            $period = new DatePeriod($start, $interval, $end);
        }


        //ini query standart
        $pns_harian = $this->db->query("SELECT pegawai.id as id_pegawai, pegawai.nama
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND pegawai.status_kepegawaian = 'PNS' AND pegawai.penempatan_sebagai = 'Guru' OR pegawai.penempatan_sebagai = 'Kepala Sekolah' OR  pegawai.penempatan_sebagai = 'Wakil Kepala Sekolah'
            GROUP BY pegawai.nama ORDER BY FIELD(penempatan_sebagai,'Kepala Sekolah','Wakil Kepala Sekolah','Guru')");

        $non_asn_harian = $this->db->query("SELECT pegawai.id as id_pegawai, pegawai.nama
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND pegawai.status_kepegawaian = 'PTK Non ASN' AND pegawai.penempatan_sebagai = 'Guru' GROUP BY pegawai.nama");

        $honor_harian = $this->db->query("SELECT pegawai.id as id_pegawai, pegawai.nama
            FROM absen_manual
            INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
            INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
            WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND pegawai.status_kepegawaian = 'Honor Komite' AND pegawai.penempatan_sebagai = 'Guru' GROUP BY pegawai.nama");


        $TabelGuruAbsensiBulanan = '';
        // Ada di bagian dateCount + 7 untuk panggil banyak colspan judul utama //

        $TabelGuruAbsensiBulanan .= '<table id="tabelSatu" class="table table-sm table-bordered" border="0">
        <tr>
            <td colspan="38" style="text-align: center;"><strong>REKAPITULASI KEHADIRAN GURU</strong></td>
            </tr>
            <tr>
            <td colspan="38" style="text-align: center;"><strong>Bulan ' .  bulan(date('m', strtotime($date))) . ' Tahun ' . date('Y') . '</strong></td> 
            </tr>
            <tr>
            <td> </td>
            </tr>
        </table>

        <div class="table-responsive">
            <table border="1" width="100%">
                <tr>
                    <td colspan="' . ($dateCount + 7) . '" style="text-align: center;"><strong>Pegawai Negeri Sipil (PNS)</strong></td>
                </tr>
                <tr>
                    <th rowspan="3" style="text-align: center;">No</th>
                    <th rowspan="3" style="text-align: center;" width="200px">Nama</th>
                    <th colspan="' . $dateCount . '" style="text-align: center;">HARI/TANGGAL</th>
                    <th rowspan="2" colspan="5" style="text-align: center;">KETERANGAN</th>
                </tr>
                <tr style=" text-align: center;">
                    ';

        // Ambil hari, dikonversi ke insial 1 huruf hari indonesia //
        // Pemanggilan bulan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $day_indo = date('D', strtotime("$year-$month-$i"));
            switch ($day_indo) {
                case 'Sun':
                    $TabelGuruAbsensiBulanan .= '<th>M</th>';
                    break;

                case 'Mon':
                    $TabelGuruAbsensiBulanan .= '<th>S</th>';
                    break;

                case 'Tue':
                    $TabelGuruAbsensiBulanan .= '<th>S</th>';
                    break;

                case 'Wed':
                    $TabelGuruAbsensiBulanan .= '<th>R</th>';
                    break;

                case 'Thu':
                    $TabelGuruAbsensiBulanan .= '<th>K</th>';
                    break;

                case 'Fri':
                    $TabelGuruAbsensiBulanan .= '<th>J</th>';
                    break;

                case 'Sat':
                    $TabelGuruAbsensiBulanan .= '<th>S</th>';
                    break;

                default:
                    $TabelGuruAbsensiBulanan .= '<th>Tidak Dikatahui</th>';
                    break;
            }
        }
        // Akhir pemanggilan bulan //

        $TabelGuruAbsensiBulanan .= '
                </tr>
                <tr style=" text-align: center;">
                   ';
        // Pemanggilan tanggal dengan perulangan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $TabelGuruAbsensiBulanan .= '<th>' . $i . '</th>';
        }
        $TabelGuruAbsensiBulanan .= '
                    <td width="30px">S</td>
                    <td width="30px">I</td>
                    <td width="30px">A</td>
                    <td width="30px">C</td>
                    <td width="30px">DL</td>
                 </tr>
                            ';

        if ($pns_harian->num_rows() > 0) {
            $no = 1;
            foreach ($pns_harian->result() as $row) {
                $TabelGuruAbsensiBulanan .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelGuruAbsensiBulanan .= '<td>' . $row->nama . '</td>';

                $absensi = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai");

                $hari_libur = $this->kelola_laporan_kehadiran_model->SetTanggalMerah($month, $year);

                $items = array();
                foreach ($hari_libur as $hbs) {
                    $items[] = $hbs['tanggal'];
                }

                // PUNYA DIMAS
                for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
                    if ($i < 10) {
                        if (array_search("$year-$month-0$i", $items) !== false) {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-0$i", $row->id_pegawai) .  '</td>';
                        }
                    } else {
                        if (array_search("$year-$month-$i", $items) !== false) {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-$i", $row->id_pegawai) . '</td>';
                        }
                    }
                }
                // tampilin status kehadiran di tiap tiap cell pada tabel
                // for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
                //     if ($i < 10) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-0$i", $row->id_pegawai) . '</td>';
                //     } else {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-$i", $row->id_pegawai) . '</td>';
                //     }
                // }
                // foreach ($absensi->result() as $absen) {
                //     if ($absen->status_absen == 2) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> S </td>';
                //     } else if ($absen->status_absen == 3) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> I </td>';
                //     } else if ($absen->status_absen == 4) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> - </td>';
                //     } else if ($absen->status_absen == 5) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> C </td>';
                //     } else if ($absen->status_absen == 6) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> DL </td>';
                //     }
                // }
                $sakit = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 2");
                $izin = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 3");
                $alpha = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 4");
                $cuti = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 5");
                $dinasluar = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 6");

                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $sakit->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $izin->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $alpha->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $cuti->num_rows() .  '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $dinasluar->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '</tr>';
                $no++;
            }
        } else {
            $TabelGuruAbsensiBulanan .= '<tr><td style="text-align: center;" colspan="' . ($dateCount + 7) . '">Data tidak ada</td></tr>';
        }

        $TabelGuruAbsensiBulanan .= '
            </table>
        </div>
                            ';



        ////////////////////////////////////////////////////////////////////** Table PTK Non ASN EXCELL BULANAN **////////////////////////////////////////////////////////////////////
        $TabelGuruAbsensiBulanan .= '
                            <div class="table-responsive">
            <table border="1" width="100%">
                <tr>
                    <td colspan="' . ($dateCount + 7) . '" style="text-align: center;"><strong>PTK Non ASN</strong></td>
                </tr>
                <tr>
                    <th rowspan="3" style="text-align: center;">No</th>
                    <th rowspan="3" style="text-align: center;" width="200px">Nama</th>
                    <th colspan="' . $dateCount . '" style="text-align: center;">HARI/TANGGAL</th>
                    <th rowspan="2" colspan="5" style="text-align: center;">KETERANGAN</th>
                </tr>
                <tr style=" text-align: center;">
                    ';
        // Ambil hari, dikonversi ke insial 1 huruf hari indonesia //
        // Ambil hari, dikonversi ke insial 1 huruf hari indonesia //
        // Pemanggilan bulan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $day_indo = date('D', strtotime("$year-$month-$i"));
            switch ($day_indo) {
                case 'Sun':
                    $TabelGuruAbsensiBulanan .= '<th>M</th>';
                    break;

                case 'Mon':
                    $TabelGuruAbsensiBulanan .= '<th>S</th>';
                    break;

                case 'Tue':
                    $TabelGuruAbsensiBulanan .= '<th>S</th>';
                    break;

                case 'Wed':
                    $TabelGuruAbsensiBulanan .= '<th>R</th>';
                    break;

                case 'Thu':
                    $TabelGuruAbsensiBulanan .= '<th>K</th>';
                    break;

                case 'Fri':
                    $TabelGuruAbsensiBulanan .= '<th>J</th>';
                    break;

                case 'Sat':
                    $TabelGuruAbsensiBulanan .= '<th>S</th>';
                    break;

                default:
                    $TabelGuruAbsensiBulanan .= '<th>Tidak Dikatahui</th>';
                    break;
            }
        }
        // Akhir pemanggilan bulan //

        $TabelGuruAbsensiBulanan .= '
                </tr>
                <tr style=" text-align: center;">
                   ';
        // Pemanggilan tanggal dengan perulangan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $TabelGuruAbsensiBulanan .= '<th>' . $i . '</th>';
        }
        $TabelGuruAbsensiBulanan .= '
                    <td width="30px">S</td>
                    <td width="30px">I</td>
                    <td width="30px">A</td>
                    <td width="30px">C</td>
                    <td width="30px">DL</td>
                 </tr>
                            ';

        if ($non_asn_harian->num_rows() > 0) {
            $no = 1;
            foreach ($non_asn_harian->result() as $row) {
                $TabelGuruAbsensiBulanan .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelGuruAbsensiBulanan .= '<td>' . $row->nama . '</td>';

                $absensi = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai");

                $hari_libur = $this->kelola_laporan_kehadiran_model->SetTanggalMerah($month, $year);

                $items = array();
                foreach ($hari_libur as $hbs) {
                    $items[] = $hbs['tanggal'];
                }

                // PUNYA DIMAS
                for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
                    if ($i < 10) {
                        if (array_search("$year-$month-0$i", $items) !== false) {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-0$i", $row->id_pegawai) .  '</td>';
                        }
                    } else {
                        if (array_search("$year-$month-$i", $items) !== false) {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-$i", $row->id_pegawai) . '</td>';
                        }
                    }
                }

                // tampilin status kehadiran di tiap tiap cell pada tabel
                // for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
                //     if ($i < 10) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-0$i", $row->id_pegawai) . '</td>';
                //     } else {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-$i", $row->id_pegawai) . '</td>';
                //     }
                // }
                // foreach ($absensi->result() as $absen) {
                //     if ($absen->status_absen == 2) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> S </td>';
                //     } else if ($absen->status_absen == 3) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> I </td>';
                //     } else if ($absen->status_absen == 4) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> - </td>';
                //     } else if ($absen->status_absen == 5) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> C </td>';
                //     } else if ($absen->status_absen == 6) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> DL </td>';
                //     }
                // }
                $sakit = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 2");
                $izin = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 3");
                $alpha = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 4");
                $cuti = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 5");
                $dinasluar = $this->db->query("SELECT absen_manual.status_absen
                    FROM absen_manual
                    INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                    WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 6");

                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $sakit->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $izin->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $alpha->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $cuti->num_rows() .  '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $dinasluar->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '</tr>';
                $no++;
            }
        } else {
            $TabelGuruAbsensiBulanan .= '<tr><td style="text-align: center;" colspan="' . ($dateCount + 7) . '">Data tidak ada</td></tr>';
        }

        $TabelGuruAbsensiBulanan .= '
            </table>
        </div>
                            ';



        ////////////////////////////////////////////////////////////////////** Table Honor Komite EXCELL BULANAN **////////////////////////////////////////////////////////////////////

        $TabelGuruAbsensiBulanan .= '
                <div class="table-responsive">
        <table border="1" width="100%">
        <tr>
        <td colspan="' . ($dateCount + 7) . '" style="text-align: center;"><strong>Honor Komite</strong></td>
        </tr>
        <tr>
        <th rowspan="3" style="text-align: center;">No</th>
        <th rowspan="3" style="text-align: center;" width="200px">Nama</th>
        <th colspan="' . $dateCount . '" style="text-align: center;">HARI/TANGGAL</th>
        <th rowspan="2" colspan="5" style="text-align: center;">KETERANGAN</th>
        </tr>
        <tr style=" text-align: center;">
        ';

        // Ambil hari, dikonversi ke insial 1 huruf hari indonesia //
        // Ambil hari, dikonversi ke insial 1 huruf hari indonesia //
        // Pemanggilan bulan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $day_indo = date('D', strtotime("$year-$month-$i"));
            switch ($day_indo) {
                case 'Sun':
                    $TabelGuruAbsensiBulanan .= '<th>M</th>';
                    break;

                case 'Mon':
                    $TabelGuruAbsensiBulanan .= '<th>S</th>';
                    break;

                case 'Tue':
                    $TabelGuruAbsensiBulanan .= '<th>S</th>';
                    break;

                case 'Wed':
                    $TabelGuruAbsensiBulanan .= '<th>R</th>';
                    break;

                case 'Thu':
                    $TabelGuruAbsensiBulanan .= '<th>K</th>';
                    break;

                case 'Fri':
                    $TabelGuruAbsensiBulanan .= '<th>J</th>';
                    break;

                case 'Sat':
                    $TabelGuruAbsensiBulanan .= '<th>S</th>';
                    break;

                default:
                    $TabelGuruAbsensiBulanan .= '<th>Tidak Dikatahui</th>';
                    break;
            }
        }
        // Akhir pemanggilan bulan //

        $TabelGuruAbsensiBulanan .= '
                </tr>
                <tr style=" text-align: center;">
                   ';
        // Pemanggilan tanggal dengan perulangan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $TabelGuruAbsensiBulanan .= '<th>' . $i . '</th>';
        }
        $TabelGuruAbsensiBulanan .= '
        <td width="30px">S</td>
        <td width="30px">I</td>
        <td width="30px">A</td>
        <td width="30px">C</td>
        <td width="30px">DL</td>
        </tr>
                ';

        if ($honor_harian->num_rows() > 0) {
            $no = 1;
            foreach ($honor_harian->result() as $row) {
                $TabelGuruAbsensiBulanan .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelGuruAbsensiBulanan .= '<td>' . $row->nama . '</td>';

                $absensi = $this->db->query("SELECT absen_manual.status_absen
        FROM absen_manual
        INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
        WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai");

                $hari_libur = $this->kelola_laporan_kehadiran_model->SetTanggalMerah($month, $year);

                $items = array();
                foreach ($hari_libur as $hbs) {
                    $items[] = $hbs['tanggal'];
                }

                // PUNYA DIMAS
                for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
                    if ($i < 10) {
                        if (array_search("$year-$month-0$i", $items) !== false) {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-0$i", $row->id_pegawai) .  '</td>';
                        }
                    } else {
                        if (array_search("$year-$month-$i", $items) !== false) {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-$i", $row->id_pegawai) . '</td>';
                        }
                    }
                }
                // tampilin status kehadiran di tiap tiap cell pada tabel
                // for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
                //     if ($i < 10) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-0$i", $row->id_pegawai) . '</td>';
                //     } else {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-$i", $row->id_pegawai) . '</td>';
                //     }
                // }

                // foreach ($absensi->result() as $absen) {
                //     if ($absen->status_absen == 2) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> S </td>';
                //     } else if ($absen->status_absen == 3) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> I </td>';
                //     } else if ($absen->status_absen == 4) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> - </td>';
                //     } else if ($absen->status_absen == 5) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> C </td>';
                //     } else if ($absen->status_absen == 6) {
                //         $TabelGuruAbsensiBulanan .= '<td style="text-align: center;"> DL </td>';
                //     }
                // }
                $sakit = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 2");
                $izin = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 3");
                $alpha = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 4");
                $cuti = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 5");
                $dinasluar = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 6");

                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $sakit->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $izin->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $alpha->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $cuti->num_rows() .  '</td>';
                $TabelGuruAbsensiBulanan .= '<td style="text-align: center;">' . $dinasluar->num_rows() . '</td>';
                $TabelGuruAbsensiBulanan .= '</tr>';
                $no++;
            }
        } else {
            $TabelGuruAbsensiBulanan .= '<tr><td style="text-align: center;" colspan="' . ($dateCount + 7) . '">Data tidak ada</td></tr>';
        }

        $TabelGuruAbsensiBulanan .= '
        </table>
        <table border="0" width="100%">
        ';

        $TabelGuruAbsensiBulanan .= '
        <tr><td style="text-align: center; height:50;" colspan="35"></td></tr>
        <tr><td style="text-align: center;" colspan="2"></td><td style="text-align: center; background-color: red;"></td><td ></td><td colspan="8">Libur Hari Minggu / hari-hari Besar</td><td colspan="2"></td><td colspan="5">A = Alfa</td><td colspan="12"></td><td  colspan="7">KEPALA SMK NEGERI 1 BINTAN TIMUR</td></tr>
        <tr><td style="text-align: center;" colspan="2"></td><td>S</td><td></td><td colspan="8">Sakit</td><td colspan="2"></td><td colspan="5">C = Cuti</td><td colspan="9"></td></tr>
        <tr><td style="text-align: center;" colspan="2"></td><td>I</td><td></td><td colspan="8">Izin</td><td colspan="2"></td><td colspan="5">DL = Dinas Luar</td><td colspan="9"></td></tr>
        <tr><td style="text-align: center; height:40;" colspan="35" ></td></tr>
        <tr><td style="text-align: center;" colspan="31"></td><td  colspan="7">Yayuk Sri Mulyani Rahayu, S.Pd, MM</td></tr>
        <tr><td style="text-align: center;" colspan="31"></td><td  colspan="7">NIP. 19770421 200502 2 011</td></tr>
        ';
        $TabelGuruAbsensiBulanan .= '
        </table>
        </div>
                ';


        $filename = "Absensi_Perbulan_Guru" . '.xlsx';

        header('content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachement;filename=' . $filename);

        echo $TabelGuruAbsensiBulanan;

        exit;
    }


    ////////////////////////////////////////////////////////////////////** KELOLA LAPORAN TU PERBULAN **////////////////////////////////////////////////////////////////////
    public function laporanTuBulanan()
    {
        header('Content-Type: application/json');
        $date = $this->input->post('LihatTuPerbulan');

        echo json_encode(array('cek' => $this->QueryTuBulanan($date, 'lihat')));
    }

    protected function QueryTuBulanan($date, $tipe)
    {
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $dateCount = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $start = new DateTime(date($year . '-' . $month . '-01'));
        $start->format('Y-m-d');
        $interval = new DateInterval('P1D');
        $end = new DateTime(date($year . '-' . $month . '-t'));
        //kondisi untuk tampilkan tanggal dalam 1 bulan: kondisi pertama untuk 31 hari, kedua untuk 30 hari, ketiga untuk 29 hari (tahun habis bagi 4) dan keempat untuk 28 hari (tidak habis bagi empat)
        if ($month == '01' || $month == '03' || $month == '05' || $month == '07' || $month == '08' || $month == '10' || $month == '12') {
            $end->modify('+1 day')->format('Y-m-d');
            $period = new DatePeriod($start, $interval, $end);
        } else if ($month == '04' || $month == '06' || $month == '09' || $month == '11') {
            $period = new DatePeriod($start, $interval, $end);
        } else if ($month == '02' && $year % 2 == 0) {
            $end->modify('-1 day')->format('Y-m-d');
            $period = new DatePeriod($start, $interval, $end);
        } else if ($month == '02' && $year % 2 != 0) {
            $end->modify('-2 day')->format('Y-m-d');
            $period = new DatePeriod($start, $interval, $end);
        }


        //ini query standart
        $pns_harian = $this->db->query("SELECT pegawai.id as id_pegawai, pegawai.nama
             FROM absen_manual
             INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
             WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND pegawai.status_kepegawaian = 'PNS' AND pegawai.penempatan_sebagai = 'TU'
             GROUP BY pegawai.nama");

        $honor_harian = $this->db->query("SELECT pegawai.id as id_pegawai, pegawai.nama
             FROM absen_manual
             INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
             INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
             WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND pegawai.status_kepegawaian = 'Honor Komite' AND pegawai.penempatan_sebagai = 'TU' GROUP BY pegawai.nama");


        $TabelTuAbsensiBulanan = '';
        // ada di bagian dateCount + 7 untuk panggil banyak colspan judul utama //
        $TabelTuAbsensiBulanan .= '
             <div class="container">
                 <div class="text-center">
                     <h5><strong>REKAPITULASI KEHADIRAN TATA USAHA DAN LAYANAN KHUSUS </strong></h5>
                     <p>
                     <h5><strong>Bulan ' . bulan(date('m', strtotime($date))) . ' Tahun ' . date('Y') . '</strong></p>
                     </h5>
                 </div>
             </div>
 
         <div class="table-responsive  table-bordered">
             <table border="1" width="100%">
                 <tr>
                     <td colspan="' . ($dateCount + 7) . '" style="text-align: center;"><strong>Pegawai Negeri Sipil (PNS)</strong></td>
                 </tr>
                 <tr>
                     <th rowspan="3" style="text-align: center;"  width="20px">No</th>
                     <th rowspan="3" style="text-align: center;" width="250px">Nama</th>
                     <th colspan="' . $dateCount . '" style="text-align: center;">HARI/TANGGAL</th>
                     <th rowspan="2" colspan="5" style="text-align: center;">KETERANGAN</th>
                 </tr>
                 <tr style=" text-align: center;">
                     ';

        // Ambil hari, dikonversi ke insial 1 huruf hari indonesia //
        // Pemanggilan bulan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $day_indo = date('D', strtotime("$year-$month-$i"));
            switch ($day_indo) {
                case 'Sun':
                    $TabelTuAbsensiBulanan .= '<th width=20px">M</th>';
                    break;

                case 'Mon':
                    $TabelTuAbsensiBulanan .= '<th width=20px">S</th>';
                    break;

                case 'Tue':
                    $TabelTuAbsensiBulanan .= '<th width=20px">S</th>';
                    break;

                case 'Wed':
                    $TabelTuAbsensiBulanan .= '<th width=20px">R</th>';
                    break;

                case 'Thu':
                    $TabelTuAbsensiBulanan .= '<th width=20px">K</th>';
                    break;

                case 'Fri':
                    $TabelTuAbsensiBulanan .= '<th width=20px">J</th>';
                    break;

                case 'Sat':
                    $TabelTuAbsensiBulanan .= '<th width=20px">S</th>';
                    break;

                default:
                    $TabelTuAbsensiBulanan .= '<th>Tidak Dikatahui</th>';
                    break;
            }
        }
        // Akhir pemanggilan bulan //

        $TabelTuAbsensiBulanan .= '
                </tr>
                <tr style=" text-align: center;">
                   ';
        // Pemanggilan tanggal dengan perulangan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $TabelTuAbsensiBulanan .= '<th>' . $i . '</th>';
        }
        // Akhir pemanggilan tanggal dengan perulangan //

        $TabelTuAbsensiBulanan .= '
                     <td width="25px">S</td>
                     <td width="25px">I</td>
                     <td width="25px">A</td>
                     <td width="25px">C</td>
                     <td width="25px">DL</td>
                  </tr>
                             ';

        if ($pns_harian->num_rows() > 0) {
            $no = 1;
            foreach ($pns_harian->result() as $row) {
                $TabelTuAbsensiBulanan .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelTuAbsensiBulanan .= '<td>' . $row->nama . '</td>';

                $absensi = $this->db->query("SELECT absen_manual.status_absen
                     FROM absen_manual
                     INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                     WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai");

                $hari_libur = $this->kelola_laporan_kehadiran_model->SetTanggalMerah($month, $year);

                $items = array();
                foreach ($hari_libur as $hbs) {
                    $items[] = $hbs['tanggal'];
                }

                // PUNYA DIMAS
                for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
                    if ($i < 10) {
                        if (array_search("$year-$month-0$i", $items) !== false) {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-0$i", $row->id_pegawai) .  '</td>';
                        }
                    } else {
                        if (array_search("$year-$month-$i", $items) !== false) {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-$i", $row->id_pegawai) . '</td>';
                        }
                    }
                }

                $sakit = $this->db->query("SELECT absen_manual.status_absen
                     FROM absen_manual
                     INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                     WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 2");
                $izin = $this->db->query("SELECT absen_manual.status_absen
                     FROM absen_manual
                     INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                     WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 3");
                $alpha = $this->db->query("SELECT absen_manual.status_absen
                     FROM absen_manual
                     INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                     WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 4");
                $cuti = $this->db->query("SELECT absen_manual.status_absen
                     FROM absen_manual
                     INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                     WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 5");
                $dinasluar = $this->db->query("SELECT absen_manual.status_absen
                     FROM absen_manual
                     INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                     WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 6");

                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $sakit->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $izin->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $alpha->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $cuti->num_rows() .  '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $dinasluar->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '</tr>';
                $no++;
            }
        } else {
            $TabelTuAbsensiBulanan .= '<tr><td style="text-align: center;" colspan="' . ($dateCount + 7) . '">Data tidak ada</td></tr>';
        }

        $TabelTuAbsensiBulanan .= '
             </table>
         </div>
                             ';

        ////////////////////////////////////////////////////////////////////** Table Honor Komite **////////////////////////////////////////////////////////////////////
        $TabelTuAbsensiBulanan .= '
                 <div class="table-responsive  table-bordered">
         <table border="1" width="100%">
         <tr>
         <td colspan="' . ($dateCount + 7) . '" style="text-align: center;"><strong>Honor Komite</strong></td>
         </tr>
         <tr>
         <th rowspan="3" style="text-align: center;"  width="20px">No</th>
         <th rowspan="3" style="text-align: center;" width="250px">Nama</th>
         <th colspan="' . $dateCount . '" style="text-align: center;">HARI/TANGGAL</th>
         <th rowspan="2" colspan="5" style="text-align: center;">KETERANGAN</th>
         </tr>
         <tr style=" text-align: center;">
         ';

        // Ambil hari, dikonversi ke insial 1 huruf hari indonesia //
        // Pemanggilan bulan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $day_indo = date('D', strtotime("$year-$month-$i"));
            switch ($day_indo) {
                case 'Sun':
                    $TabelTuAbsensiBulanan .= '<th>M</th>';
                    break;

                case 'Mon':
                    $TabelTuAbsensiBulanan .= '<th>S</th>';
                    break;

                case 'Tue':
                    $TabelTuAbsensiBulanan .= '<th>S</th>';
                    break;

                case 'Wed':
                    $TabelTuAbsensiBulanan .= '<th>R</th>';
                    break;

                case 'Thu':
                    $TabelTuAbsensiBulanan .= '<th>K</th>';
                    break;

                case 'Fri':
                    $TabelTuAbsensiBulanan .= '<th>J</th>';
                    break;

                case 'Sat':
                    $TabelTuAbsensiBulanan .= '<th>S</th>';
                    break;

                default:
                    $TabelTuAbsensiBulanan .= '<th>Tidak Dikatahui</th>';
                    break;
            }
        }
        // Akhir pemanggilan bulan //

        $TabelTuAbsensiBulanan .= '
                </tr>
                <tr style=" text-align: center;">
                   ';
        // Pemanggilan tanggal dengan perulangan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $TabelTuAbsensiBulanan .= '<th width="20px">' . $i . '</th>';
        }
        // Akhir pemanggilan tanggal dengan perulangan //

        $TabelTuAbsensiBulanan .= '
         <td width="25px">S</td>
         <td width="25px">I</td>
         <td width="25px">A</td>
         <td width="25px">C</td>
         <td width="25px">DL</td>
         </tr>
                 ';

        if ($honor_harian->num_rows() > 0) {
            $no = 1;
            foreach ($honor_harian->result() as $row) {
                $TabelTuAbsensiBulanan .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelTuAbsensiBulanan .= '<td>' . $row->nama . '</td>';

                $absensi = $this->db->query("SELECT absen_manual.status_absen
         FROM absen_manual
         INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
         WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai");

                $hari_libur = $this->kelola_laporan_kehadiran_model->SetTanggalMerah($month, $year);

                $items = array();
                foreach ($hari_libur as $hbs) {
                    $items[] = $hbs['tanggal'];
                }

                // PUNYA DIMAS
                for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
                    if ($i < 10) {
                        if (array_search("$year-$month-0$i", $items) !== false) {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-0$i", $row->id_pegawai) .  '</td>';
                        }
                    } else {
                        if (array_search("$year-$month-$i", $items) !== false) {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-$i", $row->id_pegawai) . '</td>';
                        }
                    }
                }
                // foreach ($absensi->result() as $absen) {
                //     if ($absen->status_absen == 2) {
                //         $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> S </td>';
                //     } else if ($absen->status_absen == 3) {
                //         $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> I </td>';
                //     } else if ($absen->status_absen == 4) {
                //         $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> - </td>';
                //     } else if ($absen->status_absen == 5) {
                //         $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> C </td>';
                //     } else if ($absen->status_absen == 6) {
                //         $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> DL </td>';
                //     }
                // }
                $sakit = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 2");
                $izin = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 3");
                $alpha = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 4");
                $cuti = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 5");
                $dinasluar = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 6");

                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $sakit->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $izin->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $alpha->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $cuti->num_rows() .  '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $dinasluar->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '</tr>';
                $no++;
            }
        } else {
            $TabelTuAbsensiBulanan .= '<tr><td style="text-align: center;" colspan="' . ($dateCount + 7) . '">Data tidak ada</td></tr>';
        }

        $TabelTuAbsensiBulanan .= '
         </table>
         </div>
                 ';
        return $TabelTuAbsensiBulanan;
    }

    ////////////////////////////////////////////////////////////////////**AKHIR  LAPORAN TU BULANAN **////////////////////////////////////////////////////////////////////



    ////////////////////////////////////////////////////////////////////** EXCELL LAPORAN TU PERBULAN **////////////////////////////////////////////////////////////////////
    public function exportTuBulanan()
    {

        // include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $date = $this->input->post('LihatTuPerbulan');
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $dateCount = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $start = new DateTime(date($year . '-' . $month . '-01'));
        $start->format('Y-m-d');
        $interval = new DateInterval('P1D');
        $end = new DateTime(date($year . '-' . $month . '-t'));
        //kondisi untuk tampilkan tanggal dalam 1 bulan: kondisi pertama untuk 31 hari, kedua untuk 30 hari, ketiga untuk 29 hari (tahun habis bagi 4) dan keempat untuk 28 hari (tidak habis bagi empat)
        if ($month == '01' || $month == '03' || $month == '05' || $month == '07' || $month == '08' || $month == '10' || $month == '12') {
            $end->modify('+1 day')->format('Y-m-d');
            $period = new DatePeriod($start, $interval, $end);
        } else if ($month == '04' || $month == '06' || $month == '09' || $month == '11') {
            $period = new DatePeriod($start, $interval, $end);
        } else if ($month == '02' && $year % 2 == 0) {
            $end->modify('-1 day')->format('Y-m-d');
            $period = new DatePeriod($start, $interval, $end);
        } else if ($month == '02' && $year % 2 != 0) {
            $end->modify('-2 day')->format('Y-m-d');
            $period = new DatePeriod($start, $interval, $end);
        }


        // ini query standart //
        $pns_harian = $this->db->query("SELECT pegawai.id as id_pegawai, pegawai.nama
             FROM absen_manual
             INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
             WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND pegawai.status_kepegawaian = 'PNS' AND pegawai.penempatan_sebagai = 'TU'
             GROUP BY pegawai.nama");

        $honor_harian = $this->db->query("SELECT pegawai.id as id_pegawai, pegawai.nama
             FROM absen_manual
             INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
             INNER JOIN status_absen ON absen_manual.status_absen=status_absen.id
             WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND pegawai.status_kepegawaian = 'Honor Komite' AND pegawai.penempatan_sebagai = 'TU' GROUP BY pegawai.nama");


        $TabelTuAbsensiBulanan = '';

        // Ada di bagian dateCount + 7 untuk panggil banyak colspan judul utama //
        $TabelTuAbsensiBulanan .= '<table id="tabelSatu" class="table table-sm table-bordered" border="0">
        <tr>
            <td colspan="38" style="text-align: center;"><strong>REKAPITULASI KEHADIRAN TATA USAHA DAN LAYANAN KHUSUS</strong></td>
            </tr>
            <tr>
            <td colspan="38" style="text-align: center;"><strong>Bulan ' .  bulan(date('m', strtotime($date))) . ' Tahun ' . date('Y') . '</strong></td> 
            </tr>
            <tr>
            <td> </td>
            </tr>
        </table>
 
         <div class="table-responsive">
             <table border="1" width="100%">
                 <tr>
                     <td colspan="' . ($dateCount + 7) . '" style="text-align: center;"><strong>Pegawai Negeri Sipil (PNS)</strong></td>
                 </tr>
                 <tr>
                     <th rowspan="3" style="text-align: center;">No</th>
                     <th rowspan="3" style="text-align: center;" width="270px">Nama</th>
                     <th colspan="' . $dateCount . '" style="text-align: center;">HARI/TANGGAL</th>
                     <th rowspan="2" colspan="5" style="text-align: center;">KETERANGAN</th>
                 </tr>
                 <tr style=" text-align: center;">
                     ';
        // Ambil hari, dikonversi ke insial 1 huruf hari indonesia //
        // Pemanggilan bulan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $day_indo = date('D', strtotime("$year-$month-$i"));
            switch ($day_indo) {
                case 'Sun':
                    $TabelTuAbsensiBulanan .= '<th>M</th>';
                    break;

                case 'Mon':
                    $TabelTuAbsensiBulanan .= '<th>S</th>';
                    break;

                case 'Tue':
                    $TabelTuAbsensiBulanan .= '<th>S</th>';
                    break;

                case 'Wed':
                    $TabelTuAbsensiBulanan .= '<th>R</th>';
                    break;

                case 'Thu':
                    $TabelTuAbsensiBulanan .= '<th>K</th>';
                    break;

                case 'Fri':
                    $TabelTuAbsensiBulanan .= '<th>J</th>';
                    break;

                case 'Sat':
                    $TabelTuAbsensiBulanan .= '<th>S</th>';
                    break;

                default:
                    $TabelTuAbsensiBulanan .= '<th>Tidak Dikatahui</th>';
                    break;
            }
        }
        // Akhir pemanggilan bulan //

        $TabelTuAbsensiBulanan .= '
                </tr>
                <tr style=" text-align: center;">
                   ';
        // Pemanggilan tanggal dengan perulangan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $TabelTuAbsensiBulanan .= '<th>' . $i . '</th>';
        }
        // Akhir pemanggilan tanggal dengan perulangan //
        $TabelTuAbsensiBulanan .= '
                     <td width="30px">S</td>
                     <td width="30px">I</td>
                     <td width="30px">A</td>
                     <td width="30px">C</td>
                     <td width="30px">DL</td>
                  </tr>
                             ';

        if ($pns_harian->num_rows() > 0) {
            $no = 1;
            foreach ($pns_harian->result() as $row) {
                $TabelTuAbsensiBulanan .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelTuAbsensiBulanan .= '<td>' . $row->nama . '</td>';

                $absensi = $this->db->query("SELECT absen_manual.status_absen
                     FROM absen_manual
                     INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                     WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai");

                $hari_libur = $this->kelola_laporan_kehadiran_model->SetTanggalMerah($month, $year);

                $items = array();
                foreach ($hari_libur as $hbs) {
                    $items[] = $hbs['tanggal'];
                }

                // PUNYA DIMAS
                for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
                    if ($i < 10) {
                        if (array_search("$year-$month-0$i", $items) !== false) {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-0$i", $row->id_pegawai) .  '</td>';
                        }
                    } else {
                        if (array_search("$year-$month-$i", $items) !== false) {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-$i", $row->id_pegawai) . '</td>';
                        }
                    }
                }
                // foreach ($absensi->result() as $absen) {
                //     if ($absen->status_absen == 2) {
                //         $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> S </td>';
                //     } else if ($absen->status_absen == 3) {
                //         $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> I </td>';
                //     } else if ($absen->status_absen == 4) {
                //         $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> - </td>';
                //     } else if ($absen->status_absen == 5) {
                //         $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> C </td>';
                //     } else if ($absen->status_absen == 6) {
                //         $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> DL </td>';
                //     }
                // }
                $sakit = $this->db->query("SELECT absen_manual.status_absen
                     FROM absen_manual
                     INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                     WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 2");
                $izin = $this->db->query("SELECT absen_manual.status_absen
                     FROM absen_manual
                     INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                     WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 3");
                $alpha = $this->db->query("SELECT absen_manual.status_absen
                     FROM absen_manual
                     INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                     WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 4");
                $cuti = $this->db->query("SELECT absen_manual.status_absen
                     FROM absen_manual
                     INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                     WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 5");
                $dinasluar = $this->db->query("SELECT absen_manual.status_absen
                     FROM absen_manual
                     INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                     WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 6");

                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $sakit->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $izin->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $alpha->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $cuti->num_rows() .  '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $dinasluar->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '</tr>';
                $no++;
            }
        } else {
            $TabelTuAbsensiBulanan .= '<tr><td style="text-align: center;" colspan="' . ($dateCount + 7) . '">Data tidak ada</td></tr>';
        }

        $TabelTuAbsensiBulanan .= '
             </table>
         </div>
                             ';



        ////////////////////////////////////////////////////////////////////** Table Honor Komite EXCELL BULANAN**////////////////////////////////////////////////////////////////////
        $TabelTuAbsensiBulanan .= '
                 <div class="table-responsive">
         <table border="1" width="100%">
         <tr>
         <td colspan="' . ($dateCount + 7) . '" style="text-align: center;"><strong>Honor Komite</strong></td>
         </tr>
         <tr>
         <th rowspan="3" style="text-align: center;">No</th>
         <th rowspan="3" style="text-align: center;" width="270px">Nama</th>
         <th colspan="' . $dateCount . '" style="text-align: center;">HARI/TANGGAL</th>
         <th rowspan="2" colspan="5" style="text-align: center;">KETERANGAN</th>
         </tr>
         <tr style=" text-align: center;">
         ';

        // Ambil hari, dikonversi ke insial 1 huruf hari indonesia //
        // Pemanggilan bulan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $day_indo = date('D', strtotime("$year-$month-$i"));
            switch ($day_indo) {
                case 'Sun':
                    $TabelTuAbsensiBulanan .= '<th>M</th>';
                    break;

                case 'Mon':
                    $TabelTuAbsensiBulanan .= '<th>S</th>';
                    break;

                case 'Tue':
                    $TabelTuAbsensiBulanan .= '<th>S</th>';
                    break;

                case 'Wed':
                    $TabelTuAbsensiBulanan .= '<th>R</th>';
                    break;

                case 'Thu':
                    $TabelTuAbsensiBulanan .= '<th>K</th>';
                    break;

                case 'Fri':
                    $TabelTuAbsensiBulanan .= '<th>J</th>';
                    break;

                case 'Sat':
                    $TabelTuAbsensiBulanan .= '<th>S</th>';
                    break;

                default:
                    $TabelTuAbsensiBulanan .= '<th>Tidak Dikatahui</th>';
                    break;
            }
        }
        // Akhir pemanggilan bulan //

        $TabelTuAbsensiBulanan .= '
                </tr>
                <tr style=" text-align: center;">
                   ';
        // Pemanggilan tanggal dengan perulangan //
        for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
            $TabelTuAbsensiBulanan .= '<th>' . $i . '</th>';
        }
        // Akhir pemanggilan tanggal dengan perulangan //
        $TabelTuAbsensiBulanan .= '
         <td width="30px">S</td>
         <td width="30px">I</td>
         <td width="30px">A</td>
         <td width="30px">C</td>
         <td width="30px">DL</td>
         </tr>
                 ';

        if ($honor_harian->num_rows() > 0) {
            $no = 1;
            foreach ($honor_harian->result() as $row) {
                $TabelTuAbsensiBulanan .= '<tr><td style="text-align: center;">' . $no . '</td>';
                $TabelTuAbsensiBulanan .= '<td>' . $row->nama . '</td>';

                $absensi = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai");

                $hari_libur = $this->kelola_laporan_kehadiran_model->SetTanggalMerah($month, $year);

                $items = array();
                foreach ($hari_libur as $hbs) {
                    $items[] = $hbs['tanggal'];
                }

                // PUNYA DIMAS
                for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
                    if ($i < 10) {
                        if (array_search("$year-$month-0$i", $items) !== false) {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-0$i", $row->id_pegawai) .  '</td>';
                        }
                    } else {
                        if (array_search("$year-$month-$i", $items) !== false) {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center; background-color: red;"></td>';
                        } else {
                            $TabelTuAbsensiBulanan .= '<td style="text-align: center;"> ' . $this->_checkAbsenHarian("$year-$month-$i", $row->id_pegawai) . '</td>';
                        }
                    }
                }


                $sakit = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND YEAR(absen_manual.tanggal_absen) = $year AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 2");
                $izin = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 3");
                $alpha = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 4");
                $cuti = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 5");
                $dinasluar = $this->db->query("SELECT absen_manual.status_absen
                FROM absen_manual
                INNER JOIN pegawai ON absen_manual.id_pegawai=pegawai.id
                WHERE MONTH(absen_manual.tanggal_absen) = $month AND absen_manual.id_pegawai = $row->id_pegawai AND absen_manual.status_absen = 6");

                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $sakit->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $izin->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $alpha->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $cuti->num_rows() .  '</td>';
                $TabelTuAbsensiBulanan .= '<td style="text-align: center;">' . $dinasluar->num_rows() . '</td>';
                $TabelTuAbsensiBulanan .= '</tr>';
                $no++;
            }
        } else {
            $TabelTuAbsensiBulanan .= '<tr><td style="text-align: center;" colspan="' . ($dateCount + 7) . '">Data tidak ada</td></tr>';
        }

        $TabelTuAbsensiBulanan .= '
         </table>
         <table border="0" width="100%">
        ';

        $TabelTuAbsensiBulanan .= '
        <tr><td style="text-align: center; height:50;" colspan="35"></td></tr>
        <tr><td style="text-align: center;" colspan="2"></td><td style="text-align: center; background-color: red;"></td><td ></td><td colspan="8">Libur Hari Minggu / hari-hari Besar</td><td colspan="2"></td><td colspan="5">A = Alfa</td><td colspan="12"></td><td  colspan="7">KEPALA SMK NEGERI 1 BINTAN TIMUR</td></tr>
        <tr><td style="text-align: center;" colspan="2"></td><td>S</td><td></td><td colspan="8">Sakit</td><td colspan="2"></td><td colspan="5">C = Cuti</td><td colspan="9"></td></tr>
        <tr><td style="text-align: center;" colspan="2"></td><td>I</td><td></td><td colspan="8">Izin</td><td colspan="2"></td><td colspan="5">DL = Dinas Luar</td><td colspan="9"></td></tr>
        <tr><td style="text-align: center; height:40;" colspan="35" ></td></tr>
        <tr><td style="text-align: center;" colspan="31"></td><td  colspan="7">Yayuk Sri Mulyani Rahayu, S.Pd, MM</td></tr>
        <tr><td style="text-align: center;" colspan="31"></td><td  colspan="7">NIP. 19770421 200502 2 011</td></tr>
        ';
        $TabelTuAbsensiBulanan .= '
        </table>
         </div>
                 ';


        $filename = "Absensi_Perbulan_Tu" . '.xlsx';

        header('content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachement;filename=' . $filename);

        echo $TabelTuAbsensiBulanan;

        exit;
    }
    ///////////////////////////////////////////////////////////-AKHIR EXCELL LAPORAN TU PERBULAN-////////////////////////////////////////////



    ///////////////////////////////////////////////////////////-CEK KETERANGAN ABSEN-////////////////////////////////////////////
    public function _checkAbsenHarian($tanggal, $id_pegawai)
    {
        $absensi = $this->kelola_laporan_kehadiran_model->checkAbsensiHarian($tanggal, $id_pegawai);
        $singkatan = [
            "Hadir" => '&#10003;',
            "Sakit" => "S",
            "Izin"  => "I",
            "Alpha" => "A",
            "Cuti"  => "C",
            "Dinas Luar" => "DL"
        ];

        if ($absensi != null) {
            return $singkatan[$absensi->keterangan];
        } else {
            return '';
        }
    }
    ///////////////////////////////////////////////////////////-AKHIR CEK KETERANGAN ABSEN-////////////////////////////////////////////

    ///////////////////////////////////////////////////////////-CEK KETERANGAN HARI BESAR NASIONAL-////////////////////////////////////////////
    // public function _checkHariBesar($month, $year, $i)
    // {
    //     $hari_libur = $this->kelola_laporan_kehadiran_model->SetTanggalMerah($month, $year);

    //     foreach ($hari_libur as $hbs) {
    //         return date('d', strtotime($hbs['tanggal']));
    //     }
    // }
    ///////////////////////////////////////////////////////////-AKHIR CEK HARI BESAR NASIONAL-////////////////////////////////////////////
}
