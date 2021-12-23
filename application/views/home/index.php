        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>

            <div class="row mb-3">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Informasi Guru</div>
                                    <hr>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: 40px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><?= $total_guru ?></div>
                                </div>
                                <div class="col-auto" style="margin-bottom: -10%;">
                                    <i class="fas fa-users fa-3x text-Secondary"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a class="m-0 small text-primary card-link" href="<?= base_url(); ?>data_pegawai/guru">View More <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Annual) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Informasi Staf Tata Usaha</div>
                                    <hr>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: 40px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><?= $j_tatausaha ?></div>
                                </div>
                                <div class="col-auto" style="margin-bottom: -10%;">
                                    <i class="fas fa-users fa-3x text-Secondary"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a class="m-0 small text-primary card-link" href="<?= base_url(); ?>data_pegawai/tu">View More <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <?php
                                    $pegawai = $this->db->query(" SELECT nama, status_nomor_induk, nomor_induk, gambar FROM `pegawai` WHERE penempatan_sebagai = 'Kepala Sekolah' ORDER BY id DESC LIMIT 1 ")->row_array();
                                    echo '<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kepala Sekolah</div>
                                    <hr>
                            <div class="h6 mb-0 font-weight-bold text-gray-800" style="font-size: 15px;">' . $pegawai['nama'] . '
                                <p>' . $pegawai['status_nomor_induk'] . ' : ' . $pegawai['nomor_induk'] . ' </p>
                            </div>
                            </div>
                            <div class="col-auto" style="margin-bottom: -13%">
                                <img class="img-profile " src="assets/img/' . $pegawai['gambar'] . '" width="55">
                            </div>
                        ';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>


                <ol class="breadcrumb mb-2">
                    <div class="sb-nav-link-icon"><i class="fas fa-book fa-fw"></i></div>
                    <li class="breadcrumb-item active">Sistem Absensi SMK N 1 Bintan Timur</li>
                </ol>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title"><strong>PEGAWAI MASUK</strong></h6>
                                <table class="table align-items-center table-bordered" id="pgwmasuk">
                                    <thead class="thead-light">
                                        <tr style="font-size: small;">
                                            <th style="text-align: center;">Nama</th>
                                            <th style="text-align: center;">Penempatan</th>
                                            <th style="text-align: center;">Keterangan</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($absenMasukHariIni as $d) : ?>
                                            <tr>
                                                <td style="font-size: 85%;"><?= $d['nama'] ?></td>
                                                <td style="font-size: 85%;"><?= $d['penempatan_sebagai'] ?></td>
                                                <td><span class="badge badge-success" style="width: 100%; pointer-events: none; text-decoration: none;"><?= $d['jam_masuk'] ?></span></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title"><strong>PEGAWAI TIDAK MASUK</strong></h6>
                                <table class="table align-items-center table-bordered" id="pgwtidakmasuk">
                                    <thead class="thead-light">
                                        <tr style="font-size: small;">
                                            <th style="text-align: center;">Nama</th>
                                            <th style="text-align: center;">Penempatan</th>
                                            <th style="text-align: center;">Keterangan</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($absenTidakMasukHariIni as $d) : ?>
                                            <tr>
                                                <td style="font-size: 85%;"><?= $d['nama'] ?></td>
                                                <td style="font-size: 85%;"><?= $d['penempatan_sebagai'] ?></td>
                                                <td>
                                                    <?php if ($d['status_absen'] == 2) {
                                                        echo '<span class="badge badge-warning" style="width: 100%; pointer-events: none; text-decoration: none;">Sakit</span>';
                                                    } else if ($d['status_absen'] == 3) {
                                                        echo '<span class="badge badge-info" style="width: 100%; pointer-events: none; text-decoration: none;">Izin</span>';
                                                    } else if ($d['status_absen'] == 4) {
                                                        echo '<span class="badge badge-danger" style="width: 100%; pointer-events: none; text-decoration: none;">Alpha</span>';
                                                    } else if ($d['status_absen'] == 5) {
                                                        echo '<span class="badge badge-dark" style="width: 100%; pointer-events: none; text-decoration: none;">Cuti</span>';
                                                    } else if ($d['status_absen'] == 6) {
                                                        echo '<span class="badge badge-primary" style="width: 100%; pointer-events: none; text-decoration: none;">Dinas Diluar</span>';
                                                    }  ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Row-->

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

            <!--Akhir-Container Fluid-->
        </div>