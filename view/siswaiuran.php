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
                    <h1 class="h3 mb-2 text-gray-800">Data Master</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Siswa
                            <?php include '../back/koneksi.php';
                            $id_kelas    =  $_GET['kelas'];
                    $data = $conn->query("select * from kelas where id_kelas = '$id_kelas'");
                if ($data=== FALSE) {
                    die(mysqli_error());
                }
                $no = 1;
                while($d = mysqli_fetch_assoc($data)){ ?>
                    <?php echo $d['nama_kelas'];?>
                   </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            
                                <button type="button" class="btn btn-success" onclick="BukaLaporan()">
                              Laporan Pembayaran Per Kelas
                                </button> 
                                <a class="btn btn-success ml-4" href="../back/excel/report_siswa.php?id_kelas=<?php echo $d['id_kelas'];?>"
                                >Export Data Siswa Perkelas</a>
                                <button type="button" class="btn btn-info ml-4" onclick="insertExcel()">
                                Input Transaksi Excel
                                </button>                             
                                <br>
                                <br>
                                 <?php } ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>NISN</th>
                                            <th>Nama Siswa</th>
                                            <th>Alamat</th>
                                            <th>No.Telepon</th>
                                            <th>Jenis Kelamin</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Input Siswa</h5>
     
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>NISN:</label>
                <input type="text" class="form-control form-control-user" id="nisn" placeholder="">
            <label>Nama Siswa:</label>
                <input type="text" class="form-control form-control-user" id="namaSiswa" placeholder="Nama Siswa">
            <label>Alamat:</label>
                <input type="text" class="form-control form-control-user" id="Alamat" placeholder="Alamat Siswa">
            <label>Nomor Telepon:</label>
                <input type="text" class="form-control form-control-user" id="notelepon" placeholder="Nomor Siswa">
            <label>Jenis Kelamin:</label>
            <select class="form-control" aria-label="" id="jk">
                 <option selected>Pilih Jenis Kelamin</option>
                 <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>               
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
        <h5 class="modal-title" id="ModalLabel">Laporan Pembayaran Per Kelas</h5>
     
      </div>
      <div class="modal-body">     
        <div class="form-group"><form method="POST" action="../back/excel/report_pembayaran.php"  >
            <label>Dari Tanggal:</label>
                <input type="date"  class="form-control" placeholder=""  id="tgl1" name="tanggal1" aria-describedby="basic-addon1">
            <label>Sampai Tanggal:</label>
            <input type="date"  class="form-control" placeholder=""  id="tgl2" name="tanggal2" aria-describedby="basic-addon1">
            <label>Nama Pembayaran:</label>
            <!-- <input type="text" class="form-control" value="" id="bayar" name="bayar" aria-describedby="basic-addon1"> -->
             <input type="text"  class="form-control" aria-label="Username" aria-describedby="basic-addon1" onclick="getNama()" name="bayar" id="ac">
            <!-- <label>ID Kelas:</label> -->
            <input type="hidden" class="form-control" value="" id="kelas" name="kelas" aria-describedby="basic-addon1">
            
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal3()">Tutup</button>
        <input type="submit" name="cetak" target="blank"  class="btn btn-primary" onclick="tutupModal3()">
      </div>
    </div>
  </div>
</div>   

<!-- Modal Excel -->
<div class="modal fade" id="modalExcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Excel Buku</h5>
     
      </div>
      <div class="modal-body">
      <div class="form-group">
            <label for="formFile" class="form-label">File Excel</label>
                <input class="form-control" type="file" id="file">
             <label>Admin:</label>
                <input type="text" class="form-control form-control-user" value="<?php echo $_SESSION['nama_user']; ?>" id="admin" readonly> 
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal2()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanExcel()">Simpan</button>
      </div>
    </div>
  </div>
</div>

</body>
<script type="text/javascript">
    $(document).ready(function() {
        initTable()
    } );
 
    var id_kelas = "<?= $_GET['kelas']?>";
    var status      = "INSERT"
    var id_siswa    = "";
    var id_kelas2 = "<?= $_GET['kelas']?>"
    function bukaModal3(){
         $('#Modal3').modal('show');
         $('#kelas').val(id_kelas2);
         $('#tgl1').val('');
         $('#tgl2').val('');
         $('#ac').val('');
    }
    function tutupModal3(){
        $('#Modal3').modal('hide');
    }
    function bukaModal(){
        $('#exampleModal').modal('show');
    }
    function tutupModal(){
        $('#exampleModal').modal('hide');
    }
    function exportDataSiswa(){
         $('#kelas').val(id_kelas2);
    }
    function bukaModal2(){
        $('#modalExcel').modal('show');
        $('#file').val('');
    }
    function tutupModal2(){
        $('#modalExcel').modal('hide');
    }
    function insertExcel() {
        bukaModal2();
    }
    function simpanExcel(){
        
        let file = $("#file")[0]['files'];
        if (file.length == 0) {
            console.log(file)
            Swal.fire("Peringatan","Silahkan Upload File Excel","warning");
            return
        }
        var name = document.getElementById("file").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
       var admin = $('#admin').val();
        
       form_data.append("file",file[0])
        form_data.set("admin", admin);
        
        var url           = "<?= BASE_URL; ?>back/siswa/excel_pembayaran.php";
        // if (file == "") {
        //     Swal.fire("Peringatan","File tidak boleh kosong","warning");
        //     return;
        // }
        $.ajax({
            url:url,
            method:"post",
            data:form_data,
            processData: false,
              contentType: false,
            cache: false,
            success:function(res){
                console.log(res);
                Swal.fire("Info!",res,"info");
                window.table.destroy();
                initTable()
                tutupModal2()
            },
            error:function(res){
                console.log(err);
            }
        })
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
        var nisn = $('#nisn').val();
        var namaSiswa = $('#namaSiswa').val();
        var Alamat = $('#Alamat').val();
        var notelepon = $('#notelepon').val();
        var jk = $('#jk').val();
       
       
        var url           = "<?= BASE_URL; ?>back/siswa/insert_siswa.php";

        if(status == "UPDATE"){
            url           = "<?= BASE_URL; ?>back/siswa/update_siswa.php"
        }
        if (nisn == "") {
            Swal.fire("Peringatan","Nisn Siswa tidak boleh kosong","warning");
            return;
        }if (namaSiswa == "") {
            Swal.fire("Peringatan","Nama Siswa tidak boleh kosong","warning");
            return;
        }if (Alamat == "") {
            Swal.fire("Peringatan","Alamat tidak boleh kosong","warning");
            return;
        }if (notelepon == "") {
            Swal.fire("Peringatan","No Telepon tidak boleh kosong","warning");
            return;
        }if (jk == "") {
            Swal.fire("Peringatan","Jenis kelamin tidak boleh kosong","warning");
            return;
        }if (jk == "Pilih Jenis Kelamin") {
            Swal.fire("Peringatan","Silahkan Pilih Salah Satu Jenis Kelamin","warning");
            return;
        }
        $.ajax({
            url:url,
            method:"post",
            data:{
                nisn:nisn,
                nama_siswa: namaSiswa,
                alamat: Alamat,
                no_tlpn: notelepon,
                jenis_kelamin: jk,
                id_siswa: id_siswa,
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
        $('#nisn').val("");
        $('#namaSiswa').val("");
        $('#Alamat').val("");
        $('#notelepon').val("");
         $('#jk').val("Pilih Jenis Kelamin");
        status = "INSERT";
        bukaModal();
    }
    function handleEdit(row){
        var select_row = (JSON.parse(atob(row)))
        id_kelas = select_row.id_kelas;
        id_siswa = select_row.id_siswa;
        //  namaKelas
        $('#nisn').val(select_row.nisn);
        $('#namaSiswa').val(select_row.nama_siswa);
        $('#Alamat').val(select_row.alamat);
        $('#notelepon').val(select_row.no_tlpn);
        $('#jk').val(select_row.jenis_kelamin);
       
       
        status  = "UPDATE"
        bukaModal();

    }
     function BukaLaporan(){
        bukaModal3();
    }
    function handleHapus(id_siswa) {
          Swal.fire({
  title: 'Apa Anda Yakin?',
  text: "Anda tidak dapat mengembalikannya lagi!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Hapus Siswa!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Dihapus!',
      'Siswa telah dihapus!',
      'success'
    )
                 $.ajax({
                    url:"<?= BASE_URL; ?>back/siswa/delete_siswa.php",
                    method:"post",
                    data:{
                        id_siswa:id_siswa
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

        "paging": true,

        "ajax": "<?= BASE_URL; ?>back/siswa/select_all.php?id_kelas=" + id_kelas,
        "columns": [
            { "data": "id_siswa" },
            { "data": "nisn" },
            { "data": "nama_siswa" },
            { "data": "alamat"},
            { "data": "no_tlpn"},
            { "data": "jenis_kelamin"},
            
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
                 
                    return `<a href="<?= BASE_URL ?>view/transaksi.php?siswa=${row.id_siswa}">${data}</a>`;
                },
                "targets": 2
            },
        //     <?php if ($_SESSION['jabatan'] == "admin") {?>
        //    {
              
        //         "render": function ( data, type, row ) {
                   
        //             return `<button class="btn btn-warning" onclick="handleEdit('${btoa(JSON.stringify(row))}')">Edit</button>
        //             <button class="btn btn-danger" onclick="handleHapus('${row.id_siswa}')">Hapus</button>`;
        //         },
        //         "targets": 6
        //     },
        //     <?php };?>
           
        ]
    } );
    }


</script>