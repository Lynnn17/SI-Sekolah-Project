<?php include "V_head.php";
session_start();
if (empty($_SESSION['id_user'])){
    header("location:dashboard.php");
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
                    <h1 class="h3 mb-2 text-gray-800">Data Master</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Detail</th>
                                            
                                        </tr>
                                    </thead>
                                     <tr>
                                            <th>1</th>
                                            <th> <a href="cekbuku.php" onclick="location.href=this.href+'?siswa='+id_siswa;
                                return false;">Cek Buku</a></th>
                                        </tr>
                                         <tr>
                                            <th>2</th>
                                            <th> <a href="cekiuran.php" onclick="location.href=this.href+'?siswa='+id_siswa;
                                return false;">Cek Pembayaran</a></th>
                                        </tr>
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

</body>
<script type="text/javascript">
    $(document).ready(function() {
        // initTable()

    } );
 
    
    var status      = "INSERT"
    var id_siswa = "<?= $_GET['siswa']?>"


    // function initTable() {
    //     var nomor = 1;
    //    window.table = $('#dataTable').DataTable( {

    //     "paging": true,

    //     "ajax": "<?= BASE_URL; ?>back/siswa/select_all.php?id_kelas=" + id_kelas,
    //     "columns": [
    //         { "data": "id_siswa" },
    //         { "data": "nama_siswa" },
    //         { "data": "alamat"},
    //         { "data": "no_tlpn"},
    //         { "data": "jenis_kelamin"},
    //         <?php if ($_SESSION['jabatan'] == "admin") {?>
    //         { "data": null},
    //        <?php };?>
    //     ],
    //     "columnDefs": [
    //         {
              
    //           "render": function ( data, type, row ) {
                 
    //               return nomor++;
    //           },
    //           "targets": 0
    //       },
    //         // {
              
    //         //     "render": function ( data, type, row ) {
                 
    //         //         return `<a href="<?= BASE_URL ?>view/kelas.php?angkatan=${row.id_kelas}">${data}</a>`;
    //         //     },
    //         //     "targets": 1
    //         // },
    //         <?php if ($_SESSION['jabatan'] == "admin") {?>
    //        {
              
    //             "render": function ( data, type, row ) {
                   
    //                 return `<button class="btn btn-warning" onclick="handleEdit('${btoa(JSON.stringify(row))}')">Edit</button>
    //                 <button class="btn btn-danger" onclick="handleHapus('${row.id_siswa}')">Hapus</button>`;
    //             },
    //             "targets": 5
    //         },
    //         <?php };?>
           
    //     ]
    // } );
    // }


</script>