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
            <?php include "V_topbar.php" ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Master</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Kelas
                            <?php include '../back/koneksi.php';
                            $id_angkatan    =  $_GET['angkatan'];
                    $data = $conn->query("select * from angkatan where id_angkatan = '$id_angkatan'");
                if ($data=== FALSE) {
                    die(mysqli_error());
                }
                $no = 1;
                while($d = mysqli_fetch_assoc($data)){ ?>
                    <?php echo $d['tahun_angkatan'];?>
                    <?php } ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            
                                <!-- <button type="button" class="btn btn-primary" onclick="insertKelas()">
                              Input Kelas
                                </button> -->
                                 <button type="button" class="btn btn-success" onclick="BukaLaporan()">
                              Laporan Pembayaran Per Angkatan
                                </button> 
                                <br>
                                <br>
                                
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Nama Kelas</th>
                                            <!-- <?php if ($_SESSION['jabatan'] == "admin") {?>
                                            <th>Aksi</th>
                                            <?php };?> -->
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
        <h5 class="modal-title" id="exampleModalLabel">Input Kelas</h5>
     
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Nama Kelas:</label>
            <input type="text" class="form-control form-control-user" id="namaKelas" placeholder="Nama Kelas">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanData()">Simpan</button>
      </div>
    </div>
  </div>
</div>
    <!-- Bootstrap core JavaScript-->
     <div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Laporan Pembayaran Per Angkatan</h5>
     
      </div>
      <div class="modal-body">     
        <div class="form-group"><form method="POST" action="../back/excel/report_pembayaran_angkatan.php"  >
            <label>Dari Tanggal:</label>
                <input type="date"  class="form-control" placeholder=""  id="tanggal1" name="tanggal1" aria-describedby="basic-addon1">
            <label>Sampai Tanggal:</label>
            <input type="date"  class="form-control" placeholder=""  id="tanggal2" name="tanggal2" aria-describedby="basic-addon1">
            <label>Nama Pembayaran:</label>
            <!-- <input type="text" class="form-control" value="" id="bayar" name="bayar" aria-describedby="basic-addon1"> -->
            <input type="text"  class="form-control" aria-label="Username" aria-describedby="basic-addon1" onclick="getNama()" name="bayar" id="ac">
            <!-- <label>ID Kelas:</label> -->
            <input type="hidden" class="form-control" value="" id="angkatan" name="angkatan" aria-describedby="basic-addon1">
            
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal3()">Tutup</button>
        <input type="submit" name="cetak" target="blank"  class="btn btn-primary" onclick="tutupModal3()">
      </div>
    </div>
  </div>
</div>   


</body>
<script type="text/javascript">
    $(document).ready(function() {
        initTable()
        

    } );

    var id_angkatan = "<?= $_GET['angkatan']?>";
    var id_angkatan2 = "<?= $_GET['angkatan']?>";
    var status      = "INSERT"
    var id_kelas    = "";
     var id_kelas2 = "<?= $_GET['kelas']?>"
function bukaModal3(){
         $('#Modal3').modal('show');
         $('#angkatan').val(id_angkatan2);
         $('#tanggal1').val('');
         $('#tanggal2').val('');
         $('#ac').val('');
    }
function tutupModal3(){ 
        $('#Modal3').modal('hide');
    }
 function BukaLaporan(){
        bukaModal3();
    }
    function bukaModal(){
        $('#exampleModal').modal('show');
    }
    function tutupModal(){
        $('#exampleModal').modal('hide');
    }
function getNama(){
        
        $.ajax({
            url:"<?= BASE_URL; ?>back/iuran/select_namaiuran.php",
            
            success:(data) => {
                $( "#ac" ).autocomplete({
                    source: JSON.parse(data),
                    select: function( event, ui ) {
                    }
                });
                
            },
            error:(e) => {
                console.log(e)
                alert("Gagal Menyambung")
            }
        })
    }
    function simpanData(){
        var namaKelas = $('#namaKelas').val();
        var url           = "<?= BASE_URL; ?>back/kelas/insert_kelas.php";

        if(status == "UPDATE"){
            url           = "<?= BASE_URL; ?>back/kelas/update_kelas.php"
        }

        if (namaKelas == "") {
            Swal.fire("Peringatan","Nama Kelas tidak boleh kosong","warning");
            return;
        }
        $.ajax({
            url:url,
            method:"post",
            data:{
                nama_kelas: namaKelas,
                id_angkatan: id_angkatan,
                id_kelas:id_kelas
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
    function insertKelas() {
        // body...
        $('#namaKelas').val("")
        status = "INSERT";
        bukaModal();
    }
    function handleEdit(row){
        var select_row = (JSON.parse(atob(row)))
        id_kelas = select_row.id_kelas;
        //  namaKelas
        $('#namaKelas').val(select_row.nama_kelas);
        status  = "UPDATE"
        bukaModal();

    }
    function handleHapus(id_kelas) {
                Swal.fire({
        title: 'Apa Anda Yakin?',
        text: "Anda tidak dapat mengembalikannya lagi!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus Kelas!'
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Dihapus!',
            'Kelas telah dihapus!',
            'success'
            )
                 $.ajax({
                    url:"<?= BASE_URL; ?>back/kelas/delete_kelas.php",
                    method:"post",
                    data:{
                        id_kelas:id_kelas
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
    function BukaLaporan(){
        bukaModal3();
    }
    function initTable() {
        var nomor = 1;
       window.table = $('#dataTable').DataTable( {

       "paging" : true,
        "ajax": "<?= BASE_URL; ?>back/kelas/select_all.php?id_angkatan=" + id_angkatan,
        "columns": [
            { "data": "id_kelas" },
            { "data": "nama_kelas" },
           
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
                    
                    return `<a href="<?= BASE_URL ?>view/siswaiuran.php?kelas=${row.id_kelas}">${data}</a>`;
                },
                "targets": 1
            },
        //     <?php if ($_SESSION['jabatan'] == "admin") {?>
        //    {
              
        //         "render": function ( data, type, row ) {
                   
        //             return `<button class="btn btn-warning" onclick="handleEdit('${btoa(JSON.stringify(row))}')">Edit</button>
        //             <button class="btn btn-danger" onclick="handleHapus('${row.id_kelas}')">Hapus</button>
        //             `;
        //         },
        //         "targets": 2
        //     },
        //     <?php };?>
           
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