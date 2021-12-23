<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Statistik Kehadiran</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Statistik</li>
        </ol>
    </div>

    <!-- Row -->
    <div class="card">
        <div class="card-body">
            <ol class="breadcrumb mb-1">
                <div class="sb-nav-link-icon"><i class="fas fa-book fa-fw"></i></div>
                <li class="breadcrumb-item active">Pilih bulan yang ingin di lihat...</li>
            </ol>
            <div class="row">
                <div class="col-sm-12 mb-2">
                    <table border="0" style="width: 30%;">
                        <tr>
                            <td><input type="text" id="LihatBulan" class="form-control" name="LihatPerbulan" required></td>
                            <td style="text-align: center;">
                                <button type="submit" id="buttonBulan" class="btn btn-primary btn-sm"><i class="fas fa-eye mr-2"></i>lihat</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Bar Chart -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" style="text-align: center;">Chart Kehadiran Pegawai</h6>
                        </div>
                        <div class="card-body">
                            <div style="margin-top: -40px;">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Donut Chart -->
                <div class="col-lg-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Grafik Status Ketidakhadiran</h6>
                        </div>
                        <div class="card-body">
                            <div>
                                <canvas id="myPieChartPegawai"></canvas>
                            </div>
                            <hr>
                            <div class="media">
                                <img class="align-self-center mr-3" src="img/girl.png" alt="Generic placeholder image" style="width: 40px;" id="image-pegawai">
                                <div class="media-body">
                                    <h6 class="mt-2" id="text-nama">Nama</h6>
                                </div>
                            </div>
                            <hr>
                            <!-- <div class="input-group md-form form-sm form-2 pl-0">
                        <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search" style="height: 30px;">
                        <div class="input-group-append">
                            <span class="input-group-text red lighten-3" id="basic-text1"><i class="fas fa-search text-grey" aria-hidden="true"></i></span>
                        </div>
                    </div> -->
                            <select class="form-control form-control-sm mt-2" id="pilihpegawai">
                                <option selected='true' disabled>Cari</option>
                                <?php foreach ($pegawai as $pgw) : ?>
                                    <option value="<?= $pgw['id']; ?>+<?= $pgw['nama']; ?>+<?= $pgw['gambar']; ?>"><?= $pgw['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
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
    </div>
</div>
<!---Container Fluid-->