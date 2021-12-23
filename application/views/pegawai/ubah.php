        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Ubah Data Pegawai</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item">Kelola Data Pegawai</li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                </ol>
            </div>

            <!-- Row -->
            <div class="row mr-6">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Form Ubah Data Pegawai
                        </div>
                        <div class="card-body">
                            <?php echo form_open_multipart('pegawai/ubahData'); ?>
                            <input type="hidden" name="id" value="<?= $pegawai['id']; ?>">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="nama">Nama Pegawai </label>
                                        <input type="text" name="nama" class="form-control" value="<?= $pegawai['nama']; ?>">
                                        <small class="form-text text-danger"> <?= form_error('nama'); ?></small>
                                    </div>
                                    <div class="col-6">
                                        <label for="status_nomor_induk">Nomor Induk Kepegawaian </label>
                                        <div class="row">
                                            <div class="col-4">
                                                <select class="form-control" id="status_nomor_induk" name="status_nomor_induk">
                                                    <?php foreach ($status_nomor_induk as $sn) : ?>
                                                        <?php if ($sn == $pegawai['status_nomor_induk']) : ?>
                                                            <option value="<?= $sn; ?>" selected> <?= $sn; ?></option>

                                                        <?php else : ?>
                                                            <option value="<?= $sn; ?>"> <?= $sn; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" name="nomor_induk" class="form-control" id="nomor_induk" value="<?= $pegawai['nomor_induk']; ?>">
                                                <small class="form-text text-danger"> <?= form_error('nip'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="email">Email Aplikasi Absensi</label>
                                        <input type="text" name="email" class="form-control" id="email" value="<?= $pegawai['email']; ?>">
                                        <small class="form-text text-danger"> <?= form_error('email'); ?></small>
                                    </div>
                                    <div class="col">
                                        <label for="password">Password Aplikasi Absensi </label>
                                        <input type="text" name="password" class="form-control" value="<?= $pegawai['password']; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="jabatan"> Jabatan</label>
                                        <input type="text" name="jabatan" class="form-control" id="jabatan" value="<?= $pegawai['jabatan']; ?>">
                                        <small class="form-text text-danger"> <?= form_error('jabatan'); ?></small>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <label for="ttl"> Tempat Tanggal Lahir</label>
                                                <input type="text" name="ttl" class="form-control" id="ttl" value="<?= $pegawai['ttl']; ?>">
                                                <small class="form-text text-danger"> <?= form_error('ttl'); ?></small>
                                            </div>
                                            <div class="col">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                                    <?php foreach ($jenis_kelamin as $jk) : ?>
                                                        <?php if ($jk == $pegawai['jenis_kelamin']) : ?>
                                                            <option value="<?= $jk; ?>" selected> <?= $jk; ?></option>

                                                        <?php else : ?>
                                                            <option value="<?= $jk; ?>"> <?= $jk; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="pendidikan_jurusan">Pendidikan Jurusan</label>
                                        <input type="text" name="pendidikan_jurusan" class="form-control" id="pendidikan_jurusan" value="<?= $pegawai['pendidikan_jurusan']; ?>">
                                        <small class="form-text text-danger"> <?= form_error('pendidikan_jurusan'); ?></small>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <label for="penempatan_sebagai">Penempatan Sebagai </label>
                                                <select class="form-control" id="penempatan_sebagai" name="penempatan_sebagai">
                                                    <?php foreach ($penempatan_sebagai as $ps) : ?>
                                                        <?php if ($ps == $pegawai['penempatan_sebagai']) : ?>
                                                            <option value="<?= $ps; ?>" selected> <?= $ps; ?></option>

                                                        <?php else : ?>
                                                            <option value="<?= $ps; ?>"> <?= $ps; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="status_kepegawaian">Status Kepegawaian </label>
                                                <select class="form-control" id="status_kepegawaian" name="status_kepegawaian">
                                                    <?php foreach ($status_kepegawaian as $sp) : ?>
                                                        <?php if ($sp == $pegawai['status_kepegawaian']) : ?>
                                                            <option value="<?= $sp; ?>" selected> <?= $sp; ?></option>

                                                        <?php else : ?>
                                                            <option value="<?= $sp; ?>"> <?= $sp; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="pendidikan_jurusan">Pendidikan Jurusan</label>
                                <input type="text" name="pendidikan_jurusan" class="form-control" id="pendidikan_jurusan" value="<?= $pegawai['pendidikan_jurusan']; ?>">
                            </div>
                            <div class="col">
                                <label for="jabatan">Jabatan </label>
                                <input type="text" name="jabatan" class="form-control" id="jabatan" value="<?= $pegawai['jabatan']; ?>">
                            </div>
                        </div>
                    </div> -->


                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="pangkat_gol">Pangkat- Gol.Ruang" </label>
                                        <input type="text" name="pangkat_gol" class="form-control" id="pangkat_gol" value="<?= $pegawai['pangkat_gol']; ?>">
                                    </div>
                                    <div class="col">
                                        <label for="nomor_tgl_sk">Nomor Tanggal SK</label>
                                        <input type="text" name="nomor_tgl_sk" class="form-control" id="nomor_tgl_sk" value="<?= $pegawai['nomor_tgl_sk']; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="pangkat_terakhir">Pangkat Terakhir</label>
                                        <input type="text" name="pangkat_terakhir" class="form-control" id="pangkat_terakhir" value="<?= $pegawai['pangkat_terakhir']; ?>">
                                    </div>
                                    <div class="col">
                                        <label for="tugas_disekolah">Tugas Di Sekolah Ini</label>
                                        <input type="text" name="tugas_disekolah" class="form-control" id="tugas_disekolah" value="<?= $pegawai['tugas_disekolah']; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="mengajar_mp">Mengajar Mata Pelajaran</label>
                                        <input type="text" name="mengajar_mp" class="form-control" id="mengajar_mp" value="<?= $pegawai['mengajar_mp']; ?>">
                                    </div>
                                    <div class="col">
                                        <label for="gambar">Uploud Foto</label>
                                        <input type="file" name="gambar" class="form-control" id="gambar">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="tambah" class="btn btn-primary float-right"> Ubah Data </button>
                            <?php echo form_close(); ?>
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