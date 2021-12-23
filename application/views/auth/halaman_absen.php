<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url(); ?>assets/img/logo.png" rel="icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?= base_url(); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?= base_url(); ?>assets/DataTables/datatables.min.css">

    <link href="<?= base_url(); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="<?= base_url(); ?>assets/js/JsBarcode.all.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


    <script type="text/javascript">
        window.onload = function() {
            jam();
        }

        function jam() {
            var e = document.getElementById('jam'),
                d = new Date(),
                h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());
            e.innerHTML = h + ':' + m + ':' + s + ' WIB';
            setTimeout('jam()', 1000);
        }

        function set(e) {
            e = e < 10 ? '0' + e : e;
            return e;
        }
    </script>

    <title>Halaman Absen</title>
</head>

<body>
    <div class="jumbotron jumbotron-fluid" style="background-color: #3B5B8A; margin-bottom :-1%;">
        <div class="container-fluid">
            <div class="row" style="color: white;">
                <div class="col-6">
                    <h1 class="display-6" style="font-family: 'Oswald', sans-serif;  margin-top:-23px;  margin-left:10px;">Sistem Absensi Pegawai</h1>
                    <h1 style="font-size: 40px; margin-left:20px; font-family: 'ZCOOL QingKe HuangYou', cursive;" id="jam"></h1>
                </div>
                <div class="col-6">
                    <img src="<?= base_url(); ?>assets/img/logo.png" style="width: 15%;  margin-top:-6%;">
                    <h1 class="display-6" style="margin-left: 17%; margin-top:-16%; font-family: 'Oswald', sans-serif;">SMK N 1 BINTAN TIMUR</h1>
                    <h6 class="display" style="margin-left: 17%; margin-top:10px;">Jl. Korindo Km. 22, Sungai Lekop, Kode Pos : 29151 <br>Kec. Bintan Timur, Kab. Bintan, Prov. Kepulauan Riau</h6>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar" style="margin-bottom: 2%; background-color:#CEA513">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modallogin" style="margin-left: 81%;"> <i class="far fa-user-circle"></i> &nbsp;Admin</button>
    </nav>

    <div class="modal fade" tabindex="-1" role="dialog" id="modallogin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="text-align: center;">
                    <div style="width: 100%;">
                        <img src="<?= base_url(); ?>assets/img/logo.png" style="width: 15%;">
                        <h5 class="modal-title">Login Admin</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="user" method="post" action="<?= base_url('auth') ?>">
                        <div class="form-group">
                            <?= $this->session->flashdata('message'); ?>
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" id="password" name="password">
                        </div>
                        <div class="text-center">
                            <input type="submit" href="index.html" class="btn btn-primary" value="Login">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="card text-center">
            <div class=" card-header">
                SCAN BARCODE

                <br>

                <h5 id="status-absen"></h5>
            </div>
            <div class="card-body">
                <!-- <img src="<?= base_url(); ?>assets/img/code_39.gif" alt=""> -->
                <img id="barcode" />
            </div>
        </div>


        <div class="row" style="margin-top: 3%;">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title" style="text-align: center;"><strong>PEGAWAI MASUK</strong></h6>
                        <table class="table align-items-center table-bordered" id="masuk">
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
                                        <td><?= $d['nama'] ?></td>
                                        <td><?= $d['penempatan_sebagai'] ?></td>
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
                        <h6 class="card-title" style="text-align: center;"><strong>PEGAWAI TIDAK MASUK</strong></h6>
                        <table class="table align-items-center table-bordered" id="tidakmasuk">
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
                                        <td><?= $d['nama'] ?></td>
                                        <td><?= $d['penempatan_sebagai'] ?></td>
                                        <td>
                                            <?php if ($d['status_absen'] == 2) {
                                                echo '<span class="badge badge-warning" style="width: 100%; pointer-events: none; text-decoration: none;">Sakit</span>';
                                            } else if ($d['status_absen'] == 3) {
                                                echo '<span class="badge badge-info" style="width: 100%; pointer-events: none; text-decoration: none;">Izin</span>';
                                            } else if ($d['status_absen'] == 4) {
                                                echo '<span class="badge badge-danger" style="width: 100%; pointer-events: none; text-decoration: none;">Alpha</span>';
                                            } else if ($d['status_absen'] == 5) {
                                                echo '<span class="badge badge-secondary" style="width: 100%; pointer-events: none; text-decoration: none;">Cuti</span>';
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

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-4">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            <div class="copyright text-center my-auto">
                <span>copyright &copy; Sistem Absensi <script>
                        document.write(new Date().getFullYear());
                    </script>
                </span>
            </div>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    <script>
        $(document).ready(function() {

            let date = new Date();
            let today = new Date(date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds());

            let barcodeExpired = Math.round(new Date() / 1000);
            let barcodeCreated = Math.round(new Date() / 1000);

            let weekdays = new Array(7);
            weekdays[0] = "Sun";
            weekdays[1] = "Mon";
            weekdays[2] = "Tue";
            weekdays[3] = "Wed";
            weekdays[4] = "Thu";
            weekdays[5] = "Fri";
            weekdays[6] = "Sat";
            let nameOfDay = weekdays[date.getDay()];

            JsBarcode("#barcode", `${nameOfDay}.${barcodeExpired}`);
            $('#barcode-text').val(`${nameOfDay}.${barcodeExpired}`)

            generateQR()

            setInterval(function() {
                // barcodeExpired = parseInt(Math.round(new Date() / 1000)) + parseInt(20)
                // barcodeCreated = Math.round(new Date() / 1000)

                generateQR()
            }, 20000);

            // function addToleransi(waktuMasuk, waktuSekarang) {
            //     var sliceJamMasuk = waktuMasuk.split(':')[0]
            //     var sliceMenitMasuk = waktuMasuk.split(':')[1]

            //     var sliceJamSekarang = waktuSekarang.split(':')[0]
            //     var sliceMenitSekarang = waktuSekarang.split(':')[1]

            //     var newJamMasuk, newMenitMasuk, waktuFinal;

            //     newMenitMasuk = parseInt(sliceMenitMasuk) + parseInt(30)

            //     if (newMenitMasuk > 60) {
            //         var selisih = newMenitMasuk - 60

            //         newJamMasuk = parseInt(sliceJamMasuk) + parseInt(1)

            //         waktuFinal = `${newJamMasuk}:${selisih}`
            //     } else {
            //         newJamMasuk = sliceJamMasuk

            //         waktuFinal = `${newJamMasuk}:${newMenitMasuk}`
            //     }

            //     return waktuFinal
            // }

            // function cekJamAbsen(waktuFinal, waktuSekarang) {
            //     var sliceWaktuFinal
            // }

            function cekJamAbsen(jamMasuk) {
                let waktuAbsensiBuka = moment(`${moment().date()}-${moment().month() + parseInt(1)}-${moment().year()} ${jamMasuk}`, "D-M-YYYY HH:mm")

                if (moment().unix() >= waktuAbsensiBuka.unix() && moment().unix() <= waktuAbsensiBuka.add(30, 'minutes').unix()) {
                    return true
                } else {
                    return false
                }
            }

            function generateQR() {
                var today = new Date();
                var hours = today.getHours();
                var minutes = today.getMinutes();

                var newHours = hours;
                var newMinutes = minutes;

                if (hours < 10) {
                    newHours = ('0' + hours).slice(-2);
                }

                if (minutes < 10) {
                    newMinutes = ('0' + minutes).slice(-2);
                }

                var waktuMasuk = "";
                var waktuPulang = "";

                var jamSekarang = `${newHours}:${newMinutes}`;

                $.ajax({
                    url: '<?= site_url('api/absensi/get_waktu_absen') ?>',
                    type: "GET",
                    dataType: "json",
                    success: function(response) {

                        let waktuSekarang = `${moment(`${moment().date()}-${moment().month() + parseInt(1)}-${moment().year()} ${moment().hours()}:${moment().minutes()}`, "D-M-YYYY HH:mm").unix()}`
                        let waktuAbsenMasuk = `${moment(`${moment().date()}-${moment().month() + parseInt(1)}-${moment().year()} ${response.data.masuk}`, "D-M-YYYY HH:mm").add(30, 'minutes').unix()}`
                        let waktuAbsenPulang = `${moment(`${moment().date()}-${moment().month() + parseInt(1)}-${moment().year()} ${response.data.masuk}`, "D-M-YYYY HH:mm").add(30, 'minutes').unix()}`


                        let dapatAbsen

                        if (waktuSekarang < waktuAbsenMasuk) {
                            // alert("absen masuk")
                            $('#status-absen').html("Absen Masuk")
                            dapatAbsen = cekJamAbsen(response.data.masuk)
                        } else {
                            if (waktuSekarang < waktuAbsenPulang) {
                                // alert("absen pulang")
                                $('#status-absen').html("Absen Pulang")
                                dapatAbsen = cekJamAbsen(response.data.pulang)
                            } else {
                                // alert("absen pulanf")]
                                $('#status-absen').html("Absen Pulang")
                                dapatAbsen = cekJamAbsen(response.data.pulang)
                            }
                        }

                        // if (waktuSekarang)

                        // alert(`INI WAKTU ABSEN PULANG : ${response.data.pulang}, INI WAKTU SEKARANG : ${moment().hours()}:${moment().minutes()}`)


                        if (dapatAbsen) {
                            $.ajax({
                                url: '<?= site_url('api/absensi/generate_barcode') ?>',
                                data: {
                                    created_at: Math.round(new Date() / 1000),
                                    expired_at: parseInt(Math.round(new Date() / 1000)) + parseInt(20)
                                },
                                type: "POST",
                                dataType: "json",
                                success: function(response) {
                                    console.log(`${nameOfDay}.${parseInt(Math.round(new Date() / 1000)) + parseInt(20)}`)
                                    // document.getElementById('barcode').style.display = "block";
                                    $('#barcode').css('display', '');
                                    JsBarcode("#barcode", `${nameOfDay}.${parseInt(Math.round(new Date() / 1000)) + parseInt(20)}`);
                                    console.log(response)
                                }
                            })
                        } else {
                            // document.getElementById('barcode').style.display = "none";
                            $('#barcode').css('display', 'none');
                        }

                        // alert(moment().add(30, 'minutes').unix())
                        // alert(moment("22-11-2021 21:45", "D-M-YYYY HH:mm").add(30, 'minutes'))

                        // if (response.data.masuk === jamSekarang || response.data.pulang === jamSekarang) {
                        //     $.ajax({
                        //         url: '<?= site_url('api/absensi/generate_barcode') ?>',
                        //         data: {
                        //             created_at: Math.round(new Date() / 1000),
                        //             expired_at: parseInt(Math.round(new Date() / 1000)) + parseInt(20)
                        //         },
                        //         type: "POST",
                        //         dataType: "json",
                        //         success: function(response) {
                        //             console.log(`${nameOfDay}.${parseInt(Math.round(new Date() / 1000)) + parseInt(20)}`)
                        //             document.getElementById('barcode').style.display = "block";
                        //             JsBarcode("#barcode", `${nameOfDay}.${parseInt(Math.round(new Date() / 1000)) + parseInt(20)}`);
                        //             console.log(response)
                        //         }
                        //     })
                        // } else {
                        //     document.getElementById('barcode').style.display = "none";
                        // }
                    }
                });
            }

        });
    </script>




    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- sweetalert -->
    <script src="<?= base_url(); ?>assets/js/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/myscript.js"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#masuk').DataTable({
                "scrollY": "300px",
                "scrollCollapse": true,
                "searching": false,
                "paging": false
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#tidakmasuk').DataTable({
                "scrollY": "300px",
                "scrollCollapse": true,
                "searching": false,
                "paging": false
            });
        });
    </script>

</body>

</html>