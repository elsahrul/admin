   <!-- Footer -->
   <footer class="sticky-footer bg-white" style="margin-top:30px;">
       <div class="container my-auto">
           <div class="copyright text-center my-auto">
               <span>copyright &copy; Sistem Absensi <script>
                       document.write(new Date().getFullYear());
                   </script>
               </span>
           </div>
       </div>
   </footer>
   <!-- Footer -->
   </div>
   </div>

   <!-- Scroll to top -->
   <a class="scroll-to-top rounded" href="#page-top">
       <i class="fas fa-angle-up"></i>
   </a>

   <script src="<?= base_url(); ?>vendor/jquery/jquery.min.js"></script>
   <script src="<?= base_url(); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="<?= base_url(); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
   <script src="<?= base_url(); ?>js/ruang-admin.min.js"></script>
   <script src="<?= base_url(); ?>vendor/chart.js/Chart.min.js"></script>
   <script src="<?= base_url(); ?>js/demo/chart-area-demo.js"></script>
   <script src="<?= base_url(); ?>js/demo/chart-bar-demo.js"></script>
   <script src="<?= base_url(); ?>js/demo/chart-pie-demo.js"></script>


   <!-- sweetalert -->
   <script src="<?= base_url(); ?>assets/js/sweetalert2.all.min.js"> </script>
   <script src="<?= base_url(); ?>assets/js/customjs.js"> </script>


   <script src="assets/DataTables/datatables.min.js"> </script>


   <link href="<?= base_url(); ?>assets/css/datepicker.min.css" rel="stylesheet">
   <script src="<?= base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>


   <script>
       //Awal Tanggal Guru Per Hari//
       $('#LihatTanggalHari').change(function() {
           var InputDate = this.value;
           $('#LihatTanggalPerhari').val(InputDate)
       });
       //Akhir Tanggal Guru Per Hari//

       //Awal Tanggal Tu Per Hari//
       $('#LihatTanggalTuHari').change(function() {
           var InputDate = this.value;
           $('#LihatTanggalTuPerhari').val(InputDate)
       });
       //Akhir Tanggal Tu Per Hari//

       //Awal Tanggal Guru Per Bulan//
       $('#LihatBulan').change(function() {
           var InputDate = this.value;
           $('#LihatPerbulan').val(InputDate)
       });
       //Akhir Tanggal Guru Per Bulan//

       //Awal Tanggal Guru Per Bulan//
       $('#LihatTuBulan').change(function() {
           var InputDate = this.value;
           $('#LihatTuPerbulan').val(InputDate)
       });
       //Akhir Tanggal Guru Per Bulan//


       // //Awal Tanggal TU Per Hari//
       // $('#LihatTanggalHari').change(function() {
       //     var InputDate = this.value;
       //     $('#LihatTanggalPerhari').val(InputDate)
       // });
       // //Akhir Tanggal TU Per Hari//


       //Tombol Lihat Guru Per Hari//
       $(document).on('submit', '#SetLihatGuruHarian', function(e) {
           e.preventDefault();
           var route = $('#SetLihatGuruHarian').data('route');

           var form_data = $(this);
           $.ajax({
               type: 'POST',
               url: route,
               data: form_data.serialize(),
               success: function(data) {
                   $("#TabelGuruAbsensiHarian").html(data.cek);
               },
               complete: function() {},
               error: function(xhr) {},
           });
       });
       //Akhir Tombol Lihat Guru Per Hari//


       //Awal Tombol Lihat TU Per Hari//
       $(document).on('submit', '#SetLihatTuHarian', function(e) {
           e.preventDefault();
           var route = $('#SetLihatTuHarian').data('route');

           var form_data = $(this);
           $.ajax({
               type: 'POST',
               url: route,
               data: form_data.serialize(),
               success: function(data) {
                   $("#TabelTuAbsensiHarian").html(data.cek);
               },
               complete: function() {},
               error: function(xhr) {},
           });
       });
       //Akhir Tombol Lihat TU Per Hari//

       //Awal Tombol Lihat Guru Per Bulan//
       $(document).on('submit', '#SetLihatGuruBulanan', function(e) {
           e.preventDefault();
           var route = $('#SetLihatGuruBulanan').data('route');

           var form_data = $(this);
           $.ajax({
               type: 'POST',
               url: route,
               data: form_data.serialize(),
               success: function(data) {
                   $("#TabelGuruAbsensiBulanan").html(data.cek);
               },
               complete: function() {},
               error: function(xhr) {},
           });
       });
       //Akhir Tombol Lihat Guru Per Bulan//

       //Awal Tombol Lihat TU Per Bulan//
       $(document).on('submit', '#SetLihatTuBulanan', function(e) {
           e.preventDefault();
           var route = $('#SetLihatTuBulanan').data('route');

           var form_data = $(this);
           $.ajax({
               type: 'POST',
               url: route,
               data: form_data.serialize(),
               success: function(data) {
                   $("#TabelTuAbsensiBulanan").html(data.cek);
               },
               complete: function() {},
               error: function(xhr) {},
           });
       });
       //Akhir Tombol Lihat TU Per Bulan//

       var myCarousel = document.querySelector('#carouselExampleSlidesOnly')
       var carousel = new bootstrap.Carousel(myCarousel, {
           interval: 2000,
           wrap: true
       })
   </script>

   <!-- //Awal Data Tables// -->
   <script>
       $(document).ready(function() {
           $('#datatables').DataTable();
       });
   </script>

   <script>
       $(document).ready(function() {
           $('#pgwmasuk').DataTable({
               "scrollY": "300px",
               "scrollCollapse": true,
               "searching": false,
               "paging": false
           });
       });
   </script>

   <script>
       $(document).ready(function() {
           $('#pgwtidakmasuk').DataTable({
               "scrollY": "300px",
               "scrollCollapse": true,
               "searching": false,
               "paging": false
           });
       });
   </script>
   <!-- //Akhir Data Tables// -->

   <script>
       $("#datepicker").datepicker({
           format: 'MM yyyy',
           viewMode: "months",
           minViewMode: "months",
           autoClose: true
       });
   </script>

   <script>
       $("#LihatBulan").datepicker({
           format: 'MM yyyy',
           viewMode: "months",
           minViewMode: "months",
           autoClose: true
       });
   </script>

   <script>
       $("#LihatTuBulan").datepicker({
           format: 'MM yyyy',
           viewMode: "months",
           minViewMode: "months",
           autoClose: true
       });
   </script>


   <!-- Awal Chart Statistik -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   <script>
       $(document).ready(function() {

           var myChart = ''
           var id_pegawai = ''

           $('#buttonBulan').click(function() {
               var pickedmonth = $('#LihatBulan').val();

               var fields = pickedmonth.split(' ');
               var monthName = fields[0];
               var year = fields[1];
               console.log(monthName);
               //    console.log(year);

               var months = {
                   jan: '01',
                   feb: '02',
                   mar: '03',
                   apr: '04',
                   may: '05',
                   jun: '06',
                   jul: '07',
                   aug: '08',
                   sep: '09',
                   oct: '10',
                   nov: '11',
                   dec: '12',
               };

               var monthNum = months[monthName.substring(0, 3).toLowerCase()];

               $.ajax({
                   type: 'GET',
                   url: '<?= base_url('statistik/getChartLinePerMonth/') ?>' + monthNum + '/' + year,
                   dataType: 'json',
                   success: function(data) {
                       createChart('myChart', data.kehadiran);
                       console.log(data.kehadiran);
                   }
               })
               myChart.destroy()

               if ($('#pilihpegawai').val() != '') {
                   id_pegawai = $('#pilihpegawai').val();

                   const value_pegawai = id_pegawai.split("+");
                   $("#text-nama").empty();
                   $("#text-nama").append(value_pegawai[1]);

                   if (value_pegawai[2] == '') {
                       $("#image-pegawai").attr("src", "assets/img/avatar.png");
                   } else {
                       $("#image-pegawai").attr("src", "assets/img/" + value_pegawai[2]);
                   }

                   console.log(id_pegawai)
                   $.ajax({
                       type: 'GET',
                       url: '<?= base_url('statistik/getStatistikAbsenPerMonth/') ?>' + value_pegawai[0] + '/' + monthNum + '/' + year,
                       dataType: 'json',
                       success: function(data) {
                           createPieChart('myPieChartPegawai', data.statistikkehadiran);

                           console.log(data.statistikkehadiran);
                       }
                   })
                   myPieChartPegawai.destroy()
               }

           })

           var today = new Date();
           var mm = today.getMonth(); //January is 0!
           var yyyy = today.getFullYear();

           var monthStart = new Date(yyyy, mm, 1);
           var monthEnd = new Date(yyyy, mm + 1, 1);
           var monthLength = (monthEnd - monthStart) / (1000 * 60 * 60 * 24);

           const date = [];
           const data_guru_hadir = [];
           for (let i = 1; i <= monthLength; i++) {

               if (i < 10) {
                   var date_list = yyyy + '-' + (mm + 1) + '-' + 0 + i;
               } else if (i >= 10) {
                   var date_list = yyyy + '-' + (mm + 1) + '-' + i;
               }


               $.ajax({
                   type: 'GET',
                   url: '<?= base_url('statistik/getChartLine') ?>',
                   dataType: 'json',
                   success: function(data) {
                       createChart('myChart', data.kehadiran);
                       console.log(data.kehadiran);
                   }
               })

               date.push(i);
           }


           function createChart(elementId, param) {
               const chart = document.getElementById(elementId).getContext('2d');
               myChart = new Chart(chart, {
                   type: 'bar',
                   data: {
                       labels: date,
                       datasets: [{
                               label: 'Guru - Tidak Hadir',
                               data: param.guru_tidak_masuk,
                               backgroundColor: [
                                   'rgba(245, 49, 49)'
                               ],
                               borderColor: [
                                   'rgba(255, 99, 132, 1)'
                               ],
                               borderWidth: 1,
                               stack: 'Stack 0',
                           },
                           {
                               label: 'Guru - Hadir',
                               data: param.guru_masuk,
                               backgroundColor: [
                                   'rgba(46, 232, 87, 1.0)'
                               ],
                               borderColor: [
                                   'rgba(75, 192, 192, 1)'
                               ],
                               borderWidth: 1,
                               stack: 'Stack 0',
                           },
                           {
                               label: 'TU - Tidak Hadir',
                               data: param.tu_tidak_masuk,
                               backgroundColor: [
                                   'rgba(242, 107, 44)'
                               ],
                               borderColor: [
                                   'rgba(255, 99, 132, 1)'
                               ],
                               borderWidth: 1,
                               stack: 'Stack 1',
                           },
                           {
                               label: 'TU - Hadir',
                               data: param.tu_masuk,
                               backgroundColor: [
                                   'rgba(36, 102, 242)'
                               ],
                               borderColor: [
                                   'rgba(75, 192, 192, 1)'
                               ],
                               borderWidth: 1,
                               stack: 'Stack 1',
                           },

                       ]
                   },
                   options: {
                       plugins: {
                           title: {
                               display: true,
                           },
                       },
                       responsive: true,
                       interaction: {
                           intersect: false,
                       },
                       scales: {
                           x: {
                               stacked: true,
                           },
                           y: {
                               stacked: true
                           }
                       }
                   }
               });
           }


           var myPieChartPegawai = ''

           $('#pilihpegawai').on('change', function() {
               id_pegawai = $(this).val();

               const value_pegawai = id_pegawai.split("+");
               $("#text-nama").empty();
               $("#text-nama").append(value_pegawai[1]);

               if (value_pegawai[2] == '') {
                   $("#image-pegawai").attr("src", "assets/img/avatar.png");
               } else {
                   $("#image-pegawai").attr("src", "assets/img/" + value_pegawai[2]);
               }

               console.log(id_pegawai)
               $.ajax({
                   type: 'GET',
                   url: '<?= base_url('statistik/getStatistikAbsen/') ?>' + value_pegawai[0],
                   dataType: 'json',
                   success: function(data) {
                       createPieChart('myPieChartPegawai', data.statistikkehadiran);

                       console.log(data.statistikkehadiran);
                   }
               })
               myPieChartPegawai.destroy()

           });



           function createPieChart(elementId, param) {
               const chart = document.getElementById(elementId).getContext('2d');
               myPieChartPegawai = new Chart(chart, {
                   type: 'pie',
                   data: {
                       labels: ['Sakit', 'Izin', 'Alpha', 'Cuti', 'Dinas Luar'],
                       datasets: [{
                           data: [param.sakit, param.izin, param.alpha, param.cuti, param.dinasluar],
                           backgroundColor: [
                               'rgba(255, 206, 86, 0.2)',
                               'rgba(54, 162, 235, 0.2)',
                               'rgba(255, 99, 132, 0.2)',
                               'rgba(201, 203, 207, 0.2)',
                               'rgba(153, 102, 255, 0.2)',
                               'rgba(255, 159, 64, 0.2)'
                           ],
                           borderColor: [
                               'rgba(255, 206, 86, 1)',
                               'rgba(54, 162, 235, 1)',
                               'rgba(255, 99, 132, 1)',
                               'rgba(201, 203, 207, 1)',
                               'rgba(153, 102, 255, 1)',
                               'rgba(255, 159, 64, 1)'
                           ],
                           borderWidth: 1
                       }]
                   },
                   options: {
                       responsive: true,
                       plugins: {
                           legend: {
                               position: 'top',
                           }
                       }
                   },
               });
           }

           const ctx = document.getElementById('myPieChartPegawai').getContext('2d');
           myPieChartPegawai = new Chart(ctx, {
               type: 'pie',
               data: {
                   labels: ['Sakit', 'Izin', 'Alpha', 'Cuti', 'Dinas Luar'],
                   datasets: [{
                       label: '# of Votes',
                       data: [1, 1, 1, 1, 1],
                       backgroundColor: [
                           'rgba(255, 206, 86, 0.2)',
                           'rgba(54, 162, 235, 0.2)',
                           'rgba(255, 99, 132, 0.2)',
                           'rgba(201, 203, 207, 0.2)',
                           'rgba(153, 102, 255, 0.2)',
                           'rgba(255, 159, 64, 0.2)'
                       ],
                       borderColor: [
                           'rgba(255, 206, 86, 1)',
                           'rgba(54, 162, 235, 1)',
                           'rgba(255, 99, 132, 1)',
                           'rgba(201, 203, 207, 1)',
                           'rgba(153, 102, 255, 1)',
                           'rgba(255, 159, 64, 1)'
                       ],
                       borderWidth: 1
                   }]
               },
               options: {
                   responsive: true,
                   plugins: {
                       legend: {
                           position: 'top',
                       }
                   }
               },
           });

       })
   </script>
   <!-- Akhir Chart Statistik -->

   <script>
       //Awal Tombol Lihat Guru Per Bulan//
       $(document).on('submit', '#LihatBulanan', function(e) {
           e.preventDefault();
           var route = $('#LihatBulanan').data('route');

           var form_data = $(this);
           $.ajax({
               type: 'POST',
               url: route,
               data: form_data.serialize(),
               success: function(data) {
                   $("#StatistikBulanan").html(data.cek);
               },
               complete: function() {},
               error: function(xhr) {},
           });
       });
       //Akhir Tombol Lihat Guru Per Bulan//
   </script>


   </body>

   </html>