<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Token Pengguna</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Kelola Token</li>
            <li class="breadcrumb-item active" aria-current="page">Kelola Token APPRES</li>
        </ol>
    </div>

    <!-- sweetalert2 -->
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>">
    </div>
    <!-- akhir sweetalert2 -->
    <div class="row">
        <!-- <div class="col-lg-12">
                </div> -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Token Pengguna APPRES</h6>
                    <?php date_default_timezone_set("Asia/Jakarta");
                    if (date('H:m') >= "15:00" and date('H:m') <= "16:00") {
                    ?>
                        <a href="<?= base_url(); ?>token_pengguna/hapusTokenPengguna" class="btn btn-danger float-right" onclick="return confirm('Hapus semua token pengguna?')">
                            <i class="fas fa-trash-alt mr-2"></i> Hapus semua token pengguna
                        </a>


                    <?php } else { ?>
                        <a href="" class="btn btn-danger float-right disabled">
                            <i class="fas fa-trash-alt mr-2"></i> Hapus semua token pengguna
                        </a>
                    <?php } ?>
                </div>
                <div class="table-responsive p-3 table-sm" style="margin-top: -15px;">
                    <table id="datatables" class="table table-sm table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th style="text-align: center; width:25px;">No</th>
                                <th style="text-align: center;">Nama</th>
                                <th style="text-align: center;">Token</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($token_pengguna as $tkn) : ?>
                                <tr>
                                    <td style="text-align: center;"><?= $i++; ?></td>
                                    <td style="text-align: center;"><?= $tkn['nama']; ?></td>
                                    <td style="text-align: center;"><?= $tkn['token']; ?></td>
                                    <td style="text-align: center;">
                                        <?php date_default_timezone_set("Asia/Jakarta");
                                        if (date('H:m') >= "15:00" and date('H:m') <= "16:00") {
                                        ?>
                                            <a href="<?= base_url(); ?>token_pengguna/hapus/<?= $tkn['id_token']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk  ini?')"><i class="fas fa-trash-alt"></i></a>
                                        <?php } else { ?>
                                            <a href="" class="btn btn-danger disabled btn-sm"><i class="fas fa-trash-alt"></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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

    <div class="card-footer" style="margin-bottom:5%;"></div>
</div>