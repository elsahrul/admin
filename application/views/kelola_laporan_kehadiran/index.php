        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Cetak Laporan Kehadiran</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Laporan Kehadiran</li>
                </ol>
            </div>


            <div class="card">
                <div class="card-body">
                    <ol class="breadcrumb mb-4">
                        <div class="sb-nav-link-icon"><i class="fas fa-book fa-fw"></i></div>
                        <li class="breadcrumb-item active">Pilih laporan perhari atau perbulan yang ingin di lihat..</li>
                    </ol>

                    <!--/////////////////////* Awal Opsi Perhari-Perbulan */////////////////////-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow mb-3">
                                <div class="card-body">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a href="" data-target="#perhari" data-toggle="tab" class="nav-link active">Perhari</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="" data-target="#perbulan" data-toggle="tab" class="nav-link">Perbulan</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/////////////////////* Akhir Opsi Perhari-Perbulan */////////////////////-->

                    <div class="tab-content py-4">
                        <!--/////////////////////* Awal Opsi Laporan Perhari */////////////////////-->
                        <div class="tab-pane active" id="perhari">
                            <div class="row">
                                <div class="col-md">
                                    <div class="card shadow">
                                        <ol class="breadcrumb mb-4">
                                            <div class="sb-nav-link-icon"><i class="fas fa-book fa-fw"></i></div>
                                            <li class="breadcrumb-item active">Pilih laporan yang ingin dilihat</li>
                                        </ol>

                                        <!--/////////////////////* Awal Opsi Laporan Guru-TU */////////////////////-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card shadow mb-3">
                                                    <div class="card-body">
                                                        <ul class="nav nav-tabs">
                                                            <li class="nav-item">
                                                                <a href="" data-target="#guru_perhari" data-toggle="tab" class="nav-link active">Guru</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="" data-target="#tu_perhari" data-toggle="tab" class="nav-link">Staf</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/////////////////////* Akhir Opsi Laporan Guru-TU */////////////////////-->


                                        <!--/////////////////////* Awal Laporan Perhari */////////////////////-->
                                        <div class="tab-content py-4">
                                            <!--/////////////////////* Awal Laporan Guru Perhari */////////////////////-->
                                            <div class="tab-pane active" id="guru_perhari">
                                                <div class="card-body">
                                                    <div class="row" style="margin-left: 1px;">
                                                        <table border="0" style="width: 30%;">
                                                            <tr>
                                                                <form data-route="<?= base_url('kelola_laporan_kehadiran/laporanGuruHarian') ?>" id="SetLihatGuruHarian" role="form" method="POST" accept-charset="utf-8">
                                                                    <td><input type="date" id="LihatTanggalHari" class="form-control" name="LihatTanggalPerhari" required></td>
                                                                    <td style="text-align: center;">
                                                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-eye mr-2"></i>lihat</button>
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                        </table>
                                                        <table border="0" style="width: 40%;">
                                                            <tr>
                                                                <form action="<?= base_url('kelola_laporan_kehadiran/exportGuruHarian') ?>" role="form" method="POST" accept-charset="utf-8">
                                                                    <td><button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-file-excel mr-2"></i>Export Excel</button></td>
                                                                    <td>
                                                                        <input type="date" id="LihatTanggalPerhari" class="form-control invisible" name="LihatTanggalPerhari" required>
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                        </table>
                                                    </div>

                                                    <br>
                                                    <div class="card-header">
                                                        <i class="fas fa-table mr-1"></i>
                                                        Data Kehadiran Pegawai
                                                    </div>

                                                    <br>
                                                    <!--/////////////////////* Awal Tabel Guru Perhari */////////////////////-->
                                                    <div id="TabelGuruAbsensiHarian">
                                                        <div class="container">
                                                            <div class="text-center">
                                                                <h5><strong>REKAPITULASI KEHADIRAN GURU </strong></h5>
                                                                <p>
                                                                <h5><strong>Tanggal</strong></p>
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

                                                                <tr>
                                                                    <td colspan="6" style="text-align: center;">Masukan pencarian tanggal</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <table id="tabelSatu" class="table table-sm table-bordered" border="1">
                                                            <thead>
                                                                <tr>
                                                                    <td colspan="6" style="text-align: center;"><strong>PTK Non ASN</strong></td>
                                                                </tr>
                                                                <th style="text-align: center;">No</th>
                                                                <th style="text-align: center;">Nama</th>
                                                                <th style="text-align: center;">Absen Masuk</th>
                                                                <th style="text-align: center;">Absen Pulang</th>
                                                                <th style="text-align: center;">Tanggal Masuk</th>
                                                                <th style="text-align: center;">Keterangan</th>
                                                            </thead>
                                                            <tbody>

                                                                <tr>
                                                                    <td colspan="6" style="text-align: center;">Masukan pencarian tanggal</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <table id="tabelSatu" class="table table-sm table-bordered" border="1">
                                                            <thead>
                                                                <tr>
                                                                    <td colspan="6" style="text-align: center;"><strong>Guru Honor Komite</strong></td>
                                                                </tr>
                                                                <th style="text-align: center;">No</th>
                                                                <th style="text-align: center;">Nama</th>
                                                                <th style="text-align: center;">Absen Masuk</th>
                                                                <th style="text-align: center;">Absen Pulang</th>
                                                                <th style="text-align: center;">Tanggal Masuk</th>
                                                                <th style="text-align: center;">Keterangan</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="6" style="text-align: center;">Masukan pencarian tanggal</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--/////////////////////* Akhir Tabel Guru Perhari */////////////////////-->
                                                </div>
                                            </div>
                                            <!--/////////////////////* Akhir Laporan Guru Perhari */////////////////////-->

                                            <!--/////////////////////* Awal Laporan TU Perhari */////////////////////-->
                                            <div class="tab-pane" id="tu_perhari">
                                                <div class="card-body">
                                                    <div class="row" style="margin-left: 1px;">
                                                        <table border="0" style="width: 30%;">
                                                            <tr>
                                                                <form data-route="<?= base_url('kelola_laporan_kehadiran/laporanTuHarian') ?>" id="SetLihatTuHarian" role="form" method="POST" accept-charset="utf-8">
                                                                    <td><input type="date" id="LihatTanggalTuHari" class="form-control" name="LihatTanggalTuPerhari" required></td>
                                                                    <td style="text-align: center;">
                                                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-eye mr-2"></i>lihat</button>
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                        </table>
                                                        <table border="0" style="width: 40%;">
                                                            <tr>
                                                                <form action="<?= base_url('kelola_laporan_kehadiran/exportTuHarian') ?>" role="form" method="POST" accept-charset="utf-8">
                                                                    <td><button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-file-excel mr-2"></i>Export Excel</button></td>
                                                                    <td>
                                                                        <input type="date" id="LihatTanggalTuPerhari" class="form-control invisible" name="LihatTanggalTuPerhari" required>
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                        </table>
                                                    </div>

                                                    <br>
                                                    <div class="card-header">
                                                        <i class="fas fa-table mr-1"></i>
                                                        Data Kehadiran Pegawai
                                                    </div>
                                                    <br>

                                                    <!--/////////////////////* Awal Tabel TU Perhari */////////////////////-->
                                                    <div id="TabelTuAbsensiHarian">
                                                        <div class="container">
                                                            <div class="text-center">
                                                                <h5><strong>REKAPITULASI KEHADIRAN TATA USAHA DAN LAYANAN KHUSUS </strong></h5>
                                                                <p>
                                                                <h5><strong>Tanggal </strong></p>
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
                                                                <tr>
                                                                    <td colspan="6" style="text-align: center;">Masukan pencarian tanggal</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <!--  Tabel Ini Belum DIGunakan Dulu
                                            <table id="tabelSatu" class="table table-sm table-bordered" border="1">
                                                <thead>
                                                    <tr>
                                                        <td colspan="6" style="text-align: center;"><strong>PTK Non ASN</strong></td>
                                                    </tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Absen Masuk</th>
                                                    <th>Absen Pulang</th>
                                                    <th>Tanggal Masuk</th>
                                                    <th>Keterangan</th>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td colspan="6" style="text-align: center;">Masukan pencarian tanggal</td>
                                                    </tr>
                                                </tbody>
                                            </table> -->

                                                        <table id="tabelSatu" class="table table-sm table-bordered" border="1">
                                                            <thead>
                                                                <tr>
                                                                    <td colspan="6" style="text-align: center;"><strong>Guru Honor Komite</strong></td>
                                                                </tr>
                                                                <th style="text-align: center;">No</th>
                                                                <th style="text-align: center;">Nama</th>
                                                                <th style="text-align: center;">Absen Masuk</th>
                                                                <th style="text-align: center;">Absen Pulang</th>
                                                                <th style="text-align: center;">Tanggal Masuk</th>
                                                                <th style="text-align: center;">Keterangan</th>
                                                            </thead>
                                                            <tbody>

                                                                <tr>
                                                                    <td colspan="6" style="text-align: center;">Masukan pencarian tanggal</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--/////////////////////* Akhir Tabel Guru Perhari */////////////////////-->
                                                </div>
                                            </div>
                                            <!--/////////////////////* Awal Laporan TU Perhari */////////////////////-->
                                        </div>
                                        <!--/////////////////////* Akhir Laporan Perhari */////////////////////-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/////////////////////* Akhir Opsi Laporan Perhari */////////////////////-->


                        <!--/////////////////////* Awal Opsi Laporan Perbulan */////////////////////-->
                        <div class="tab-pane" id="perbulan">
                            <div class="row">
                                <div class="col-md">
                                    <div class="card shadow">
                                        <ol class="breadcrumb mb-4">
                                            <div class="sb-nav-link-icon"><i class="fas fa-book fa-fw"></i></div>
                                            <li class="breadcrumb-item active">Pilih laporan yang ingin dilihat</li>
                                        </ol>

                                        <!--/////////////////////* Awal Opsi Laporan Guru-TU */////////////////////-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card shadow mb-3">
                                                    <div class="card-body">
                                                        <ul class="nav nav-tabs">
                                                            <li class="nav-item">
                                                                <a href="" data-target="#guru_perbulan" data-toggle="tab" class="nav-link active">Guru</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="" data-target="#tu_perbulan" data-toggle="tab" class="nav-link">Staf</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/////////////////////* Akhir Opsi Laporan Guru-TU */////////////////////-->


                                        <div class="tab-content py-4">
                                            <!--/////////////////////* Awal Guru Perbulan*/////////////////////-->
                                            <div class="tab-pane active" id="guru_perbulan">
                                                <div class="card-body">
                                                    <div class="row" style="margin-left: 1px;">
                                                        <table border="0" style="width: 30%;">
                                                            <tr>
                                                                <form data-route="<?= base_url('kelola_laporan_kehadiran/laporanGuruBulanan') ?>" id="SetLihatGuruBulanan" role="form" method="POST" accept-charset="utf-8">
                                                                    <td><input type="text" id="LihatBulan" class="form-control" name="LihatPerbulan" required></td>
                                                                    <td style="text-align: center;">
                                                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-eye mr-2"></i>lihat</button>
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                        </table>
                                                        <table border="0" style="width: 20%;">
                                                            <tr>
                                                                <form action="<?= base_url('kelola_laporan_kehadiran/exportGuruBulanan') ?>" role="form" method="POST" accept-charset="utf-8">
                                                                    <td><input type="hidden" id="LihatPerbulan" class="form-control" name="LihatPerbulan" required>
                                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-file-excel mr-2"></i>Export Excel</button>
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <br>
                                                    <!-- lihat dan cetak laporan -->


                                                    <!-- tampil data kehadiran bulanan -->
                                                    <div class="card-header">
                                                        <i class="fas fa-table mr-1"></i>
                                                        Data Kehadiran Pegawai
                                                    </div>
                                                    <br>
                                                    <!-- Card Body -->
                                                    <div id="TabelGuruAbsensiBulanan">
                                                        <div class="container">
                                                            <div class="text-center">
                                                                <h5><strong>REKAPITULASI KEHADIRAN GURU </strong></h5>
                                                                <p>
                                                                <h5><strong>BULAN</strong></p>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                        <div class="table-responsive table-sm table-bordered">
                                                            <table border="1" width="100%">
                                                                <tr>
                                                                    <td colspan="35" style="text-align: center;"><strong>Pegawai Negeri Sipil (PNS)</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <th rowspan="3" style="text-align: center;" width="30">No</th>
                                                                    <th rowspan="3" style="text-align: center;" width="300px">Nama</th>
                                                                    <th colspan="28" style="text-align: center;">HARI/TANGGAL</th>
                                                                    <th rowspan="2" colspan="5" style="text-align: center;">KETERANGAN</th>
                                                                </tr>
                                                                <tr style="text-align: center;">
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                </tr>
                                                                <tr style=" text-align: center;">
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td width="30px">S</td>
                                                                    <td width="30px">I</td>
                                                                    <td width="30px">A</td>
                                                                    <td width="30px">C</td>
                                                                    <td width="30px">DL</td>

                                                                <tr style=" text-align: center;">
                                                                    <td colspan="35" style="text-align: center;">Masukan pencarian tanggal</td>
                                                                </tr>
                                                            </table>
                                                        </div>

                                                        <div class="table-responsive table-sm table-bordered">
                                                            <table border="1" width="100%">
                                                                <tr>
                                                                    <td colspan="35" style="text-align: center;"><strong>PTK Non ASN</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <th rowspan="3" style="text-align: center;" width="30">No</th>
                                                                    <th rowspan="3" style="text-align: center;" width="300px">Nama</th>
                                                                    <!-- <th colspan="35" style="text-align: center;">HARI/TANGGAL</th> -->
                                                                </tr>
                                                                <tr style=" text-align: center;">
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th colspan="5">KETERANGAN</th>
                                                                </tr>
                                                                <tr style=" text-align: center;">
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td width="30px">S</td>
                                                                    <td width="30px">I</td>
                                                                    <td width="30px">A</td>
                                                                    <td width="30px">C</td>
                                                                    <td width="30px">DL</td>
                                                                <tr style=" text-align: center;">
                                                                    <td colspan="35" style="text-align: center;">Masukan pencarian tanggal</td>

                                                                </tr>

                                                            </table>
                                                        </div>

                                                        <div class="table-responsive table-sm table-bordered">
                                                            <table border="1" width="100%">
                                                                <tr>
                                                                    <td colspan="35" style="text-align: center;"><strong>Guru Honor Komite</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <th rowspan="3" style="text-align: center;" width="30">No</th>
                                                                    <th rowspan="3" style="text-align: center;" width="300px">Nama</th>
                                                                    <!-- <th colspan="35" style="text-align: center;">HARI/TANGGAL</th> -->
                                                                </tr>
                                                                <tr style=" text-align: center;">
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th colspan="5">KETERANGAN</th>
                                                                </tr>
                                                                <tr style=" text-align: center;">
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td width="30px">S</td>
                                                                    <td width="30px">I</td>
                                                                    <td width="30px">A</td>
                                                                    <td width="30px">C</td>
                                                                    <td width="30px">DL</td>
                                                                <tr style=" text-align: center;">
                                                                    <td colspan="35" style="text-align: center;">Masukan pencarian tanggal</td>

                                                                </tr>

                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--/////////////////////* Akhir Guru Perbulan*/////////////////////-->



                                            <!--/////////////////////* Awal TU Perbulan*/////////////////////-->
                                            <div class="tab-pane" id="tu_perbulan">
                                                <div class="card-body">
                                                    <div class="row" style="margin-left: 1px;">
                                                        <table border="0" style="width: 30%;">
                                                            <tr>
                                                                <form data-route="<?= base_url('kelola_laporan_kehadiran/laporanTuBulanan') ?>" id="SetLihatTuBulanan" role="form" method="POST" accept-charset="utf-8">
                                                                    <td><input type="text" id="LihatTuBulan" class="form-control" name="LihatTuPerbulan" required></td>
                                                                    <td style="text-align: center;">
                                                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-eye mr-2"></i>lihat</button>
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                        </table>
                                                        <table border="0" style="width: 20%;">
                                                            <tr>
                                                                <form action="<?= base_url('kelola_laporan_kehadiran/exportTuBulanan') ?>" role="form" method="POST" accept-charset="utf-8">
                                                                    <td><input type="hidden" id="LihatTuPerbulan" class="form-control" name="LihatTuPerbulan" required>
                                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-file-excel mr-2"></i>Export Excel</button>
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <br>
                                                    <!-- lihat dan cetak laporan -->


                                                    <!-- tampil data kehadiran bulanan -->
                                                    <div id="TabelTuAbsensiBulanan">
                                                        <div class="card-header">
                                                            <i class="fas fa-table mr-1"></i>
                                                            Data Kehadiran Pegawai
                                                        </div>
                                                        <br>
                                                        <!-- Card Body -->
                                                        <div class="container">
                                                            <div class="text-center">
                                                                <h5><strong>REKAPITULASI KEHADIRAN TATA USAHA DAN LAYANAN KHUSUS</strong></h5>
                                                                <p>
                                                                <h5><strong>BULAN </strong></p>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                        <div class="table-responsive table-sm table-bordered">
                                                            <table border="1" width="100%">
                                                                <tr>
                                                                    <td colspan="35" style="text-align: center;"><strong>Pegawai Negeri Sipil (PNS)</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <th rowspan="3" style="text-align: center;">No</th>
                                                                    <th rowspan="3" style="text-align: center;" width="200px">Nama</th>
                                                                    <th colspan="28" style="text-align: center;">HARI/TANGGAL</th>
                                                                    <th rowspan="2" colspan="5" style="text-align: center;">KETERANGAN</th>
                                                                </tr>
                                                                <tr style=" text-align: center;">
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                </tr>
                                                                <tr style=" text-align: center;">
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th></th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th></th>
                                                                    <th> </th>
                                                                    <th></th>
                                                                    <td width="30px">S</td>
                                                                    <td width="30px">I</td>
                                                                    <td width="30px">A</td>
                                                                    <td width="30px">C</td>
                                                                    <td width="30px">DL</td>
                                                                <tr style=" text-align: center;">
                                                                    <td colspan="35" style="text-align: center;">Masukan pencarian tanggal</td>
                                                                </tr>
                                                            </table>
                                                        </div>


                                                        <div class="table-responsive table-sm table-bordered">
                                                            <table border="1" width="100%">
                                                                <tr>
                                                                    <td colspan="35" style="text-align: center;"><strong>Guru Honor Komite</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <th rowspan="3" style="text-align: center;">No</th>
                                                                    <th rowspan="3" style="text-align: center;" width="200px">Nama</th>
                                                                    <th colspan="28" style="text-align: center;">HARI/TANGGAL</th>
                                                                    <th rowspan="2" colspan="5" style="text-align: center;">KETERANGAN</th>
                                                                </tr>
                                                                <tr style=" text-align: center;">
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                </tr>
                                                                <tr style=" text-align: center;">
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <th> </th>
                                                                    <td width="30px">S</td>
                                                                    <td width="30px">I</td>
                                                                    <td width="30px">A</td>
                                                                    <td width="30px">C</td>
                                                                    <td width="30px">DL</td>
                                                                <tr style=" text-align: center;">
                                                                    <td colspan="35" style="text-align: center;">Masukan pencarian tanggal</td>
                                                                </tr>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--/////////////////////* Akhir TU Perbulan */////////////////////-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Logout -->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah kamu yakin ingin keluar?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
                            <a href="<?= base_url('auth/logout'); ?>" class="btn btn-primary">Keluar</a>
                        </div>
                    </div>
                </div>
            </div>



        </div>