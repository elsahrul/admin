        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Kelola Waktu Absensi</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item">Kelola Waktu Absensi</li>
                    <li class="breadcrumb-item active" aria-current="page">Set Waktu Absensi</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <!--/////////////////////* Awal Card Jam Masuk */////////////////////-->
                            <div class="card bg-success" style="width: 18rem;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <i class=" fas fa-fw fa-clock fa-5x text-white"></i>
                                        </div>
                                        <div class="col-9 text-white">
                                            <div class="row ml-4">
                                                <div class="col-12">
                                                    Jam masuk
                                                </div>
                                            </div>
                                            <div class="row ml-4">
                                                <div class="col-12" style="font-size: 45px; ">
                                                    <?php
                                                    $masuk = $this->db->query("SELECT masuk FROM `waktu_absensi` ORDER BY id DESC LIMIT 1")->row_array();
                                                    echo $masuk['masuk'];
                                                    ?>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/////////////////////* Akhir Card Jam Masuk */////////////////////-->


                            <!--/////////////////////* Awal Card Jam Pulang */////////////////////-->
                            <br>
                            <div class="card bg-danger" style="width: 18rem;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <i class=" fas fa-fw fa-clock fa-5x text-white"></i>
                                        </div>
                                        <div class="col-9 text-white">
                                            <div class="row ml-4">
                                                <div class="col-12">
                                                    Jam Pulang
                                                </div>
                                            </div>
                                            <div class="row ml-4">
                                                <div class="col-12" style="font-size: 45px;">
                                                    <?php
                                                    $masuk = $this->db->query("SELECT pulang FROM `waktu_absensi` ORDER BY id DESC LIMIT 1")->row_array();
                                                    echo $masuk['pulang'];
                                                    ?>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/////////////////////* Akhir Card Jam Pulang */////////////////////-->

                            <!--/////////////////////* Awal Card Toleransi */////////////////////-->
                            <br>
                            <div class="card  bg-warning" style="width: 20rem;">
                                <div class="card-body">
                                    <p style="color: red;" class="card-text"><strong>Toleransi Keterlambatan</strong>
                                        <span style="font-size: 20px;">
                                            <?php
                                            $masuk = $this->db->query("SELECT toleransi FROM `waktu_absensi` ORDER BY id DESC LIMIT 1")->row_array();
                                            echo $masuk['toleransi'] . ' menit';
                                            ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <!--/////////////////////* Akhir Card Toleransi */////////////////////-->
                        </div>
                    </div>
                </div>

                <!--/////////////////////* Awal Untuk Set Jam Absensi */////////////////////-->
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <!--/////////////////////* Awal Untuk Set Jam Absensi */////////////////////-->
                                <h3 class="h3 mb-0 text-gray-800" style="text-align: center;">Set Waktu Absensi</h3>
                                <!-- sweetalert2 -->
                                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>">
                                </div>
                                <!-- akhir sweetalert2 -->
                                <!-- <?php if ($this->session->flashdata('flash')) : ?>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                Waktu absensi <strong> berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?> -->
                                <form action="<?= base_url('Kelola_absensi') ?>" method="post">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-4">
                                            <label for="masuk" style="margin-top:20px;">Jam Masuk </label>
                                            <input type="time" id="masuk" name="masuk" required>
                                        </div>

                                        <div class="col-sm-6 col-sm-offset-4">
                                            <label for="pulang" style="margin-top:20px;">Jam Pulang</label>
                                            <input type="time" id="pulang" name="pulang" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <div class="input-group mb-3" style="margin-top: 20PX;">
                                                <span style="margin-top:5px;">Toleransi</span>
                                                <input type="text" name="toleransi" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" value="30" aria-describedby="basic-addon2" readonly style="margin-left: 17px;">
                                                <span class="input-group-text" id="basic-addon2">Menit</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5 col-sm-offset-4">
                                            <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                                <!--/////////////////////* Akhir Untuk Set Jam Absensi */////////////////////-->

                                <br>
                                <!--/////////////////////* Awal Untuk Tanggal Merah Manual */////////////////////-->
                                <h3 class="h3 mb-3 text-gray-800" style="text-align: center;">Set Hari Libur</h3>
                                <form action="<?= base_url() ?>/kelola_absensi/HariLibur" method="post">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-4">
                                            <td><input type="date" id="tanggal" class="form-control" name="tanggal" required></td>
                                        </div>

                                        <div class="col-sm-6 col-sm-offset-4">
                                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Libur">
                                            </td>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:12px;">
                                        <div class="col-sm-5 col-sm-offset-4" style="margin-top: 10px;">
                                            <button type="submit" name="tambah" class="btn btn-primary">Input</button>
                                        </div>
                                    </div>
                                </form>
                                <!--/////////////////////* Akhir Untuk Tanggal Merah Manual */////////////////////-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/////////////////////* Akhir Untuk Set Jam Absensi */////////////////////-->

            <div class="card mt-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Keterangan Hari Libur</h6>
                </div>
                <!-- sweetalert2 -->
                <?php if ($this->session->flashdata('flash')) : ?>
                <?php endif; ?>
                <!-- akhir sweetalert2 -->

                <div class="table-responsive p-3 table-sm">
                    <table id="datatables" class="table table-sm table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">Tanggal</th>
                                <th style="text-align: center;">Keterangan Libur</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($hari_libur as $hbn) : ?>
                                <tr>
                                    <td style="text-align: center;"><?= $i++; ?></td>
                                    <td style="text-align: center;"><?= $hbn['tanggal']; ?></td>
                                    <td style="text-align: center;"><?= $hbn['keterangan']; ?></td>
                                    <td style="text-align: center;"> <a href="<?= base_url(); ?>kelola_absensi/hapus/<?= $hbn['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk  ini?')"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
        <!---Akhir Container Fluid-->