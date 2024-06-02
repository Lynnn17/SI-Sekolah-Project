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
        <?php include "V_sidebariuran.php" ?>
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
                            <h6 class="m-0 font-weight-bold text-primary">Data Pendapatan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                           
                                <button type="button" class="btn btn-success" onclick="BukaLaporan()">
                              Laporan Pendapatan
                                </button>
                                
                                 <?php
                                $koneksi = new mysqli("localhost","root","","esemkasari");
                                date_default_timezone_set('Asia/Jakarta');
                                $tanggal1 = date('Y-m-d 1:00:00');
                                $tanggal2 = date('Y-m-d 23:00:00');
                                 $sum = $koneksi->query("SELECT SUM(dibayar) FROM pembayaranrecord WHERE tanggal_dibayar BETWEEN '$tanggal1' AND '$tanggal2'");
                                    while ($hasil=$sum->fetch_assoc()) { ?>
                                <div class="float-right mr-5">Total Pendapatan Hari Ini :<?php echo "Rp".number_format($hasil['SUM(dibayar)']); ?></div>
                            <?php } ?>
                                <br>
                                <br>
                                
                                
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Nama Pembayaran</th>
                                            <th>Pendapatan</th>
                                            <th>Tanggal</th>
                                            
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Jurusan</h5>
     
      </div>
      <div class="modal-body">
        <div class="form-group">
             <label>Nama Jurusan:</label>
            <input type="text" class="form-control form-control-user" id="nama_jurusan" placeholder="Nama Jurusan">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanData()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal3 -->
<div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Laporan Peminjaman Barang</h5>
     
      </div>
      <div class="modal-body">     
        <div class="form-group"><form method="POST" action="../back/excel/report_pendapatan_hari.php"  >
            <label>Dari Tanggal:</label>
                <input type="date"  class="form-control" placeholder=""  id="tgl1" name="tanggal1" aria-describedby="basic-addon1">
            <label>Sampai Tanggal:</label>
            <input type="date"  class="form-control" placeholder=""  id="tgl2" name="tanggal2" aria-describedby="basic-addon1">
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal3()">Tutup</button>
        
        <input type="submit" name="cetak" target="blank"  class="btn btn-primary" onclick="tutupModal3()">
      </div>
    </div>
  </div>
</div>
    <!-- Bootstrap core JavaScript-->
    

</body>
<script type="text/javascript">
    $(document).ready(function() {
        initTable()

    } );
    // klik simpan
    var id_jurusan    = ""
    var status      = "INSERT"


    function bukaModal(){
        $('#exampleModal').modal('show');
    }
    function tutupModal(){
        $('#exampleModal').modal('hide');
    }
    function bukaModal3(){
         $('#Modal3').modal('show');
         $('#tgl1').val('');
         $('#tgl2').val('');
    }
    function tutupModal3(){
        $('#Modal3').modal('hide');
    }
    function BukaLaporan(){
        bukaModal3();
    }
    function simpanData(){
        var nama_jurusan = $('#nama_jurusan').val();
        var url           = "<?= BASE_URL; ?>back/jurusan/insert_jurusan.php";

        if(status == "UPDATE"){
            url           = "<?= BASE_URL; ?>back/jurusan/update_jurusan.php"
        }

        if (nama_jurusan == "") {
            Swal.fire("Peringatan","Nama Jurusan tidak boleh kosong","warning");
            return;
        }
        $.ajax({
            url:url,
            method:"post",
            data:{
                nama_jurusan:nama_jurusan,
                id_jurusan:id_jurusan
            },
            success:function(res){
                Swal.fire("Sukses!","Data berhasil dimasukkan","success");
                console.log(res);
                window.table.destroy();
                initTable()
                tutupModal()
            },
            error:function(res){
                console.log(err);
            }
        })

    }
    // ketika klik btn modal tambah
    function insertJurusan() {
        // body...
        $('#nama_jurusan').val("")
        status = "INSERT";
        bukaModal();
    }
    function handleEdit(row){
        var select_row = (JSON.parse(atob(row)))
        id_jurusan = select_row.id_jurusan;
        //  tahunAngkatan
        $('#nama_jurusan').val(select_row.nama_jurusan);
        status  = "UPDATE"
        bukaModal();
        

    }
    function handleHapus(id_jurusan) {
        Swal.fire({
        title: 'Apa Anda Yakin?',
        text: "Anda tidak dapat mengembalikannya lagi!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus Jurusan!'
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Dihapus!',
            'Jurusan telah dihapus!',
            'success'
            )
                 $.ajax({
                    url:"<?= BASE_URL; ?>back/jurusan/delete_jurusan.php",
                    method:"post",
                    data:{
                        id_jurusan:id_jurusan
                    },
                    success:function(res){
                        console.log(res);
                        window.table.destroy();
                        initTable()
                        tutupModal()
                    },
                    error:function(res){
                        console.log(err);
                    }
                })
              }
    })
}
    function initTable() {
        var nomor = 1;
       window.table = $('#dataTable').DataTable( {

       "paging" : true,
        "ajax": "<?= BASE_URL; ?>back/iuran/select_grub.php",
        "columns": [
            { "data": "id_record" },
            { "data": "nama_pembayaran" },
            { "data": "total_didapat" },
            { "data": "tanggal_dibayar" },
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
                 
                  
                  var bayar = row.total_didapat;
                   num1 = new Number(bayar).toLocaleString("id-ID");

                  return "Rp" + num1;
              },
              "targets": 2
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
</html>