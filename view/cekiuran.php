<?php include "V_head.php";
session_start();
if (empty($_SESSION['id_user'])){
    header("location:login.php");
}
 ?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "V_sidebaraudit.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include "V_topbar.php" ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
               
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Cek Pembayaran </h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Isi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Nama Pembayaran</th>
                                            <th>Tanggal Membayar</th>
                                            <th>Total Dibayar</th>
                                            <th>Sisa</th>
                                            <th>Total Pembayaran</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Rekayasa Perangkat Lunak</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <!-- Button trigger modal -->

    <!-- Bootstrap core JavaScript-->
    

</body>
<script type="text/javascript">
    $(document).ready(function() {
        initTable()
        
    } );

  
    var id_siswa = "<?= $_GET['siswa']?>"


    function initTable() {
        var nomor = 1;
       window.table = $('#dataTable').DataTable( {

       "paging": true,
       "searching":true,
        "ajax": "<?= BASE_URL; ?>back/siswa/select_cekiuran.php?id_siswa=" + id_siswa,
        "columns": [
             { "data": "id_pembayaran" },
            { "data": "nama_pembayaran"},
            { "data": "tanggal_dibayar"},
            { "data": "total_dibayar"},,
            { "data": "total_pembayaran"},
            { "data": "status"},
                   
        ],
        "columnDefs": [
            {
              
                "render": function ( data, type, row ) {
                 
                  return nomor++;
              },
              "targets": 0
            },
            {
              
                "render": function ( data, type, row ) {
                 
                  
                  var bayar = row.total_dibayar;
                   num1 = new Number(bayar).toLocaleString("id-ID");

                  return "Rp" + num1;
              },
              "targets": 3
            },
            {
              
                "render": function ( data, type, row ) {
                 
                  var total = row.total_pembayaran;
                  var bayar = row.total_dibayar;
                  var hasil = total - bayar;
                   num = new Number(hasil).toLocaleString("id-ID");

                  return "Rp" + num;
              },
              "targets": 4
            },
            {
              
                "render": function ( data, type, row ) {
                 
                  var total = row.total_pembayaran;
                  
                   num2 = new Number(total).toLocaleString("id-ID");

                  return "Rp" + num2;
              },
              "targets": 5
            },
           
           
        ]
    } );
    }
    // array ['fsddfd
// window.setTimeout("waktu()", 1000);
 
//     function waktu() {
//         var waktu = new Date();
//         var jarak = ':';
//         var jarak2 = ':';
//         setTimeout("waktu()", 1000);
//         document.getElementById("jam").innerHTML = waktu.getHours();
//         document.getElementById("jarak").innerHTML = jarak;
//         document.getElementById("menit").innerHTML = waktu.getMinutes();
//         document.getElementById("jarak2").innerHTML = jarak2;
//         document.getElementById("detik").innerHTML = waktu.getSeconds();
//     }

</script>