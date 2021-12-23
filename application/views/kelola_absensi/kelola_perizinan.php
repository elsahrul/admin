      <?php
        function checkIsAbsen($id_pegawai)
        {
            $ci = get_instance();
            $query = $ci->db->query("SELECT * FROM absen_manual WHERE tanggal_absen = '" . date('Y-m-d') . "' AND id_pegawai = " . $id_pegawai . "");

            if ($query->num_rows() > 0) {
                return false;
            } else {
                return true;
            }
        }
        ?>

      <!-- Container Fluid-->
      <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Kelola Perizinan Absensi</h1>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="./">Home</a></li>
                  <li class="breadcrumb-item">Kelola Absensi</li>
                  <li class="breadcrumb-item active" aria-current="page">Perizinan Absensi</li>
              </ol>
          </div>

          <!--/////////////////////* Awal Absensi Manual */////////////////////-->
          <div class="row">
              <div class="col-12" style="margin-top: 10px;">
                  <div class="card shadow mb-4">
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                          <h6 class="m-0 font-weight-bold text-primary">Kelola Perizinan Absensi</h6>
                      </div>

                      <!--/////////////////////* Awal Table Absensi Manual */////////////////////-->
                      <div class="card-body">
                          <div id="Tabelabsensiharian">
                              <table id="datatables" class="table table-sm table-bordered" border="1">
                                  <thead class="thead-light">
                                      <th style="text-align: center;" width="3%">No</th>
                                      <th style="text-align: center;" width="40%">Nama</th>
                                      <th style="text-align: center;">NIP</th>
                                      <th style="text-align: center;" width="15%">Aksi</th>
                                  </thead>
                                  <tbody>
                                      <?php $i = 1;
                                        foreach ($pegawai as $pgw) : ?>
                                          <?php if (checkIsAbsen($pgw['id'])) : ?>
                                              <tr>
                                                  <td style="text-align: center;"><?= $i++; ?></td>
                                                  <td><?= $pgw['nama']; ?></td>
                                                  <td><?= $pgw['status_nomor_induk']; ?>. <?= $pgw['nomor_induk']; ?></td>
                                                  <td style="text-align: center;">
                                                      <div class="btn-group">
                                                          <?php
                                                            $query = $this->db->query("SELECT * FROM absen_manual WHERE tanggal_absen = '" . date('Y-m-d') . "' AND id_pegawai = " . $pgw['id'] . "");

                                                            if ($query->num_rows() == 0) {
                                                            ?>
                                                              <a href="<?= base_url(); ?>kelola_absensi/absen/<?= $pgw['id']; ?>/2" class="badge badge-warning" style="width: 20%;">S</a>
                                                              <a href="<?= base_url(); ?>kelola_absensi/absen/<?= $pgw['id']; ?>/3" class="badge badge-info" style="width: 20%;">I</a>
                                                              <a href="<?= base_url(); ?>kelola_absensi/absen/<?= $pgw['id']; ?>/4" class="badge badge-danger" style="width: 20%;">A</a>
                                                              <a href="<?= base_url(); ?>kelola_absensi/absen/<?= $pgw['id']; ?>/5" class="badge badge-secondary" style="width: 20%;">C</a>
                                                              <a href="<?= base_url(); ?>kelola_absensi/absen//<?= $pgw['id']; ?>/6" class="badge badge-primary" style="width: 23%;">DL</a>
                                                          <?php } else if ($query->num_rows() > 0) { ?>
                                                              <a href="<?= base_url(); ?>kelola_absensi/absen/<?= $pgw['id']; ?>/2" class="badge badge-warning" style="width: 20%; pointer-events: none; text-decoration: none;">I</a>
                                                              <a href="<?= base_url(); ?>kelola_absensi/absen/<?= $pgw['id']; ?>/3" class="badge badge-info" style="width: 20%; pointer-events: none; text-decoration: none;">S</a>
                                                              <a href="<?= base_url(); ?>kelola_absensi/absen/<?= $pgw['id']; ?>/4" class="badge badge-danger" style="width: 20%; pointer-events: none; text-decoration: none;">A</a>
                                                              <a href="<?= base_url(); ?>kelola_absensi/absen/<?= $pgw['id']; ?>/5" class="badge badge-secondary" style="width: 20%; pointer-events: none; text-decoration: none;">C</a>
                                                              <a href="<?= base_url(); ?>kelola_absensi/absen//<?= $pgw['id']; ?>/6" class="badge badge-primary" style="width: 23%; pointer-events: none; text-decoration: none;">DL</a>
                                                          <?php } ?>
                                                      </div>
                                                  </td>
                                              </tr>
                                          <?php endif;  ?>

                                      <?php endforeach; ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <!--/////////////////////* Akhir Table Absensi Manual */////////////////////-->
                  </div>
              </div>
          </div>
          <!--/////////////////////* Akhir Absensi Manual */////////////////////-->


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