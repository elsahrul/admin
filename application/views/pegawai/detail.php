        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Biodata Pegawai</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item">Kelola Data Pegawai</li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </div>

            <!-- Row -->
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-3 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Profil Pegawai</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <img class="mx-auto d-block rounded " src="<?= base_url(); ?>assets/img/<?= $pegawai['gambar']; ?>" width="150" height="200">
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-9 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Informasi Pegawai</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>

                                        <td>Nama</td>
                                        <td><?= $pegawai['nama']; ?></td>

                                    </tr>

                                    <td><?= $pegawai['status_nomor_induk']; ?></td>
                                    <td><?= $pegawai['nomor_induk']; ?></td>

                                    </tr>
                                    <tr>

                                        <td>Email Aplikasi Absensi</td>
                                        <td><?= $pegawai['email']; ?></td>

                                    </tr>
                                    <tr>

                                        <td>Tempat Tanggal Lahir</td>
                                        <td><?= $pegawai['ttl']; ?></td>

                                    </tr>
                                    <tr>

                                        <td>Jenis Kelamin</td>
                                        <td><?= $pegawai['jenis_kelamin']; ?></td>

                                    </tr>
                                    <tr>

                                        <td>Pendidikan Jurusan</td>
                                        <td><?= $pegawai['pendidikan_jurusan']; ?></td>

                                    </tr>
                                    <tr>

                                        <td>Jabatan</td>
                                        <td><?= $pegawai['jabatan']; ?></td>

                                    </tr>
                                    <tr>

                                        <td>Pangkat - Gol.Ruang</td>
                                        <td><?= $pegawai['pangkat_gol']; ?></td>

                                    </tr>
                                    <tr>

                                        <td>Nomor Tanggal SK</td>
                                        <td><?= $pegawai['nomor_tgl_sk']; ?></td>

                                    </tr>
                                    <tr>

                                        <td>Pangkat Terakhir</td>
                                        <td><?= $pegawai['pangkat_terakhir']; ?></td>

                                    </tr>
                                    <tr>

                                        <td>Tugas Di Sekolah Ini</td>
                                        <td><?= $pegawai['tugas_disekolah']; ?></td>

                                    </tr>
                                    <tr>

                                        <td>Mengajar Mata Pelajaran</td>
                                        <td><?= $pegawai['mengajar_mp']; ?></td>

                                    </tr>
                                </tbody>
                            </table>
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


        </div>
        <!---Container Fluid-->