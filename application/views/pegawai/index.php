        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Table Pegawai</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item">Kelola Data Pegawai</li>
                    <li class="breadcrumb-item active" aria-current="page">Tabel Pegawai</li>
                </ol>
            </div>


            <!-- sweetalert2 -->
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>">
            </div>
            <!-- Row -->
            <div class="row">
                <!-- Datatables -->
                <div class="col-lg-12">
                    <div class="card mb-4">

                        <div class="table-responsive p-3 table-sm">
                            <table id="datatables" class="table table-sm table-striped">
                                <thead class="thead-light">
                                    <tr style="font-size: small;">
                                        <th style="text-align: center;">No</th>
                                        <th style="text-align: center;">Image</th>
                                        <th style="text-align: center;">Nama / NIP</th>
                                        <th style="text-align: center;">Jabatan</th>
                                        <th style="text-align: center;">Mengajar </th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: small;">
                                    <?php $i = 1;
                                    foreach ($pegawai as $pgw) : ?>
                                        <tr>
                                            <td style="text-align: center;"><?= $i++; ?></td>
                                            <td style="text-align: center;"><img src="<?= base_url(); ?>assets/img/<?= $pgw['gambar']; ?>" width='45' height='55' ;?></td>
                                            <td><?= $pgw['nama']; ?><br><?= $pgw['status_nomor_induk']; ?>. <?= $pgw['nomor_induk']; ?></td>
                                            <td style="text-align: center;"><?= $pgw['jabatan']; ?></td>
                                            <td style="text-align: center;"><?= $pgw['mengajar_mp']; ?></td>
                                            <td style="text-align: center;">
                                                <div class="btn-group">
                                                    <a href="<?= base_url(); ?>pegawai/detail/<?= $pgw['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
                                                    <a href="<?= base_url(); ?>pegawai/ubah/<?= $pgw['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                    <a href="<?= base_url(); ?>pegawai/hapus/<?= $pgw['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk  ini?')"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
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