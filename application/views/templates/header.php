<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?= base_url(); ?>assets/img/logo.png" rel="icon">
    <title><?php echo $judul; ?></title>
    <link href="<?= base_url(); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>css/ruang-admin.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karantina&family=Russo+One&display=swap" rel="stylesheet">


    <!-- My CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/custom.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/DataTables/datatables.min.css">

</head>


<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?= base_url(); ?>assets/img/logo.png" width="40">
                </div>
                <div class=" sidebar-brand-text mx-3">SMK N 1 Bintan Timur
                </div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url(); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Features
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm1" aria-expanded="true" aria-controls="collapseForm1">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Kelola Data Pegawai</span>
                </a>
                <div id="collapseForm1" class="collapse" aria-labelledby="headingForm1" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelola Data Pegawai</h6>
                        <a class="collapse-item" href="<?= base_url(); ?>pegawai/tambah">Tambah Pegawai</a>
                        <a class="collapse-item" href="<?= base_url(); ?>pegawai">Table Pegawai</a>
                        <a class="collapse-item" href="<?= base_url(); ?>data_pegawai/guru">Data Guru</a>
                        <a class="collapse-item" href="<?= base_url(); ?>data_pegawai/tu">Data Staf</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true" aria-controls="collapseForm">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Kelola Absensi</span>
                </a>
                <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelola Absensi</h6>
                        <a class="collapse-item" href="<?= base_url(); ?>kelola_perizinan">Kelola Perizinan Absensi</a>
                        <a class="collapse-item" href="<?= base_url(); ?>kelola_absensi">Kelola Waktu Absensi</a>
                        <a class="collapse-item" href="<?= base_url(); ?>token_pengguna">Kelola Token Pengguna</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url(); ?>kelola_laporan_kehadiran">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Laporan Kehadiran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url(); ?>statistik">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>Statistik Kehadiran</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log Out</span>
                </a>
            </li>
            <hr class="sidebar-divider">

            <row style="margin-left: 9%;">
                <h1 style="font-size: 60px; font-family: Karantina;" id="jam"></h1>
            </row>
        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <!-- <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?" aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li> -->


                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" style="max-width: 60px;" src="<?= base_url(); ?>public/assets/img/undraw_profile.svg">
                                <span class="ml-2 d-none d-lg-inline text-white small"><?= $admin['name']; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->