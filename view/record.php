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
                    <h1 class="h3 mb-2 text-gray-800">Transaksi Pembayaran</h1>
                    

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
                                            <th>Nama Iuran</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Pembayaran</th>
                                            <th>Total Pembayaran</th>
                                            <th>Status</th>
                                            <th>Nama Admin</th> 
                                            <!-- <th>Aksi</th>  -->
                                           
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
        <h5 class="modal-title" id="exampleModalLabel">Input Transaksi</h5>
     
      </div>
      <div class="modal-body">
      <div class="form-group">
        <label>Angkatan:</label>
            <select onchange="getKelas()"  class="form-control form-control-user" id="angkatan" >
                    <option selected>Pilih Angkatan</option>
            </select> 
        <label>Kelas:</label>
            <select name="" class="form-control form-control-user" onchange="getSiswa()" id="kelas">
                    <option selected>Pilih Kelas</option>
            </select>
        <label>Siswa:</label>
            <select name="" class="form-control form-control-user"  id="siswa">
                    <option selected>Pilih Siswa</option>
            </select>
            <label>Nama Iuran:</label>
                <input type="text" class="form-control form-control-user" id="nama_pembayaran" placeholder="Masukkan Nama Iuran">
            <label>Total Iuran:</label>
                <input type="text" class="form-control form-control-user" id="total_pembayaran" placeholder="Masukkan Total Iuran">
            <label>Total Dibayar:</label>
                <input type="text" class="form-control form-control-user" id="total_dibayar" placeholder="Masukkan Total Dibayar">
                <label>Admin:</label>
                <input type="text" class="form-control form-control-user" value="<?php echo $_SESSION['nama_user']; ?>" id="admin" readonly> 
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanIuran()">Simpan</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Cicilan</h5>
     
      </div>
      <div class="modal-body">
      <div class="form-group">
            <label>Total Dibayar:</label>
                <input type="text" class="form-control form-control-user" id="total_bayar" placeholder="Masukkan Total Dibayar">
                <label>Admin:</label>
                <input type="text" class="form-control form-control-user" value="<?php echo $_SESSION['nama_user']; ?>" id="admin" readonly> 
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal1()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanCicil()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Iuran</h5>
      </div>
      <div class="modal-body">
      <div class="form-group">
        <label>Nama Pembayaran:</label>
                <input type="text" class="form-control form-control-user" id="n_pembayaran" placeholder="Masukkan Nama Iuran">
            <label>Total Pembayaran:</label>
                <input type="text" class="form-control form-control-user" id="t_pembayaran" placeholder="Masukkan Total Iuran">
            <label>Total Dibayar:</label>
                <input type="text" class="form-control form-control-user" id="t_dibayar" placeholder="Masukkan Nominal Pembayaran">
            <label>Admin:</label>
                <input type="text" class="form-control form-control-user" value="<?php echo $_SESSION['nama_user']; ?>" id="admin" readonly> 
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal4()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanEdit()">Simpan</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Bayar</h5>
     
      </div>
      <div class="modal-body">
      <div class="form-group">
            <label>Nominal Pembayaran:</label>
                <input type="text" class="form-control form-control-user" id="total_bayar" placeholder="Masukkan Nominal Pembayaran">
            <label>Admin:</label>
                <input type="text" class="form-control form-control-user" value="<?php echo $_SESSION['nama_user']; ?>" id="admin" readonly> 
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal2()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanEdit()">Simpan</button>
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

    var id_angkatan = "";
    var status      = "INSERT"
    var nama_pembayaran = "<?= $_GET['pembayaran']?>"
    var bayar2 =""
    let num = ""
    
    function bukaModal(){
        $('#exampleModal').modal('show');
        $('#nama_siswa').text("");
        $('#nama_pembayaran').val("");
        $('#total_dibayar').val("");
        $('#total_pembayaran').val("");

    }
    function tutupModal(){
        $('#exampleModal').modal('hide');
    }
    function bukaModal1 (){
        $('#Modal1').modal('show');
        $('#total_bayar').val("");
    }
    function tutupModal1(){
        $('#Modal1').modal('hide');
    }
    
    function insertTransaksi() {
        bukaModal();
    }
    function handleHapus(id_pembayaran,id_record,dibayar){

        Swal.fire({
  title: 'Apa Anda Yakin?',
  text: "Anda tidak dapat mengembalikannya lagi!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Hapus Transaksi!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Dihapus!',
      'Transaksi telah dihapus!',
      'success'
    )
     $.ajax({
                    url:"<?= BASE_URL; ?>back/iuran/delete_record.php",
                    method:"post",
                    data:{
                        id_pembayaran:id_pembayaran,
                        id_record : id_record,
                        dibayar : dibayar
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
        var duit = "Rp";
       window.table = $('#dataTable').DataTable( {

       "paging": true,
       "searching":true,
        "ajax": "<?= BASE_URL; ?>back/iuran/select_record.php?pembayaran=" + nama_pembayaran,
        "columns": [
            { "data": "id_record" },
            { "data": "nama_pembayaran"},
            { "data": "tanggal_dibayar"},
            { "data": "dibayar"},
            { "data": "total_dibayar"},
            { "data": "status"},
            { "data": "admin"},
            
            

            <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") {?>
        <?php } ?>
           
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
                 
                  
                  var bayar1 = row.dibayar;
                   num1 = new Number(bayar1).toLocaleString("id-ID");

                  return "Rp" + num1;
              },
              "targets": 3
            },
            {
              
                "render": function ( data, type, row ) {
                 
                  
                  var bayar = row.total_dibayar;
                   num = new Number(bayar).toLocaleString("id-ID");

                  return "Rp" + num;
              },
              "targets": 4
            },
        //     <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") {?>
        //    {
              
        //         "render": function ( data, type, row ) {
                   
        //             return ` <button class="btn btn-danger" onclick="handleHapus('${row.id_pembayaran}','${row.id_record}','${row.dibayar}')">Hapus</button>`;
        //         },
        //         "targets": 7
        //     },
        // <?php } ?>
           
        ]
    } );
    }
   

</script>