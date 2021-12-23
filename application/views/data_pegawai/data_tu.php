<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Staf Tata Usaha dan Layanan Khusus</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Staf</li>
        </ol>
    </div>


    <div class="row mb-3">
        <?php foreach ($data_tu as $d) : ?>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><?= $d['penempatan_sebagai'] ?></div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800" style="font-size: 12px;"> <?= $d['nama'] ?>
                                    <p><?= $d['status_nomor_induk'] ?> : <?= $d['nomor_induk'] ?></p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <img class="img-profile " src="<?= base_url(); ?>assets/img/<?= $d['gambar'] ?>" width="50" height="60">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
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

    <!--Akhir Container Fluid-->
</div>