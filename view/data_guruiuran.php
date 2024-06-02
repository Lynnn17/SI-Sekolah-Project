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
                            <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <?php if ($_SESSION['jabatan'] == "admin") {?>
                                <button type="button" class="btn btn-primary" onclick="insertGuru()">
                              Input Guru
                                </button>
                                <br>
                                <br>
                                <?php };?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>NIK</th>
                                            <th>Nama Guru</th>
                                            <th>Alamat</th>
                                            <th>No.Telepon</th>
                                            <th>Jenis kelamin</th>
                                            <?php if ($_SESSION['jabatan'] == "admin") {?> 
                                            <th>Username</th>
                                            <th>Password</th>                                         
                                            <th>Aksi</th>
                                            <?php };?>
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
        <h5 class="modal-title" id="exampleModalLabel">Input Guru</h5>
     
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>NIK:</label>
          <input type="text" class="form-control form-control-user" id="nik" placeholder="NIK">
          <label>Nama Guru:</label>
          <input type="text" class="form-control form-control-user" id="nama_guru" placeholder="Nama Guru">
          <label>Alamat:</label>
          <input type="text" class="form-control form-control-user" id="Alamat" placeholder="Alamat Guru">
          <label>Nomor Telepon:</label>
          <input type="text" class="form-control form-control-user" id="notelepon" placeholder="Nomor Guru">
          <label>Username:</label>
          <input type="text" class="form-control form-control-user" id="username" placeholder="Username">
          <label>Password:</label>
          <input type="text" class="form-control form-control-user" id="password" placeholder="Password">
          <label>Jenis Kelamin:</label>
            <select class="form-control form-control-user" aria-label="" placeholder="" id="jk">
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
    

</body>
<script type="text/javascript">
    $(document).ready(function() {
        initTable()

    } );
 
    var id_jurusan = "<?= $_GET['jurusan']?>";
    var status      = "INSERT"
    var id_guru    = "";

    function bukaModal(){
        $('#exampleModal').modal('show');
    }
    function tutupModal(){
        $('#exampleModal').modal('hide');
    }
    function simpanData(){
        var nama_guru = $('#nama_guru').val();
        var Alamat = $('#Alamat').val();
        var notelepon = $('#notelepon').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var nik = $('#nik').val();
        var jk = $('#jk').val();

       
       
        var url           = "<?= BASE_URL; ?>back/guru/insert_guru.php";

        if(status == "UPDATE"){
            url           = "<?= BASE_URL; ?>back/guru/update_guru.php"
        }

        if (nik == "") {
            Swal.fire("Peringatan","NIK tidak boleh kosong","warning");
            return;
        }if (nama_guru == "") {
            Swal.fire("Peringatan","Nama Guru tidak boleh kosong","warning");
            return;
        }if (Alamat == "") {
            Swal.fire("Peringatan","Alamat tidak boleh kosong","warning");
            return;
        }if (notelepon == "") {
            Swal.fire("Peringatan","No Telepon tidak boleh kosong","warning");
            return;
        }if (username == "") {
            Swal.fire("Peringatan","Username tidak boleh kosong","warning");
            return;
        }if (password == "") {
            Swal.fire("Peringatan","Password tidak boleh kosong","warning");
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
                nama_guru: nama_guru,
                alamat: Alamat,
                no_tlpn: notelepon,
                jenis_kelamin: jk,
                username: username,
                password: password,
                nik: nik,
                id_guru: id_guru,
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
    function insertGuru() {
        // body...
        $('#nama_guru').val("")
        $('#Alamat').val("")
        $('#notelepon').val("")
        $('#username').val("")
        $('#password').val("")
        $('#nik').val("")
        $('#jk').val("Pilih Jenis Kelamin")
       
       
        status = "INSERT";
        bukaModal();
    }
    function handleEdit(row){
        var select_row = (JSON.parse(atob(row)))
        id_jurusan = select_row.id_jurusan;
        id_guru = select_row.id_guru;
        //  namaKelas
        $('#nama_guru').val(select_row.nama_guru);
        $('#Alamat').val(select_row.alamat);
        $('#notelepon').val(select_row.no_tlpn);
        $('#username').val(select_row.username);
        $('#password').val(select_row.password);
        $('#nik').val(select_row.nik);
        $('#jk').val(select_row.jenis_kelamin);

       
       
        status  = "UPDATE"
        bukaModal();

    }
    function handleHapus(id_guru) {
          Swal.fire({
  title: 'Apa Anda Yakin?',
  text: "Anda tidak dapat mengembalikannya lagi!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Hapus Guru!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Dihapus!',
      'Guru telah dihapus!',
      'success'
    )
                 $.ajax({
                    url:"<?= BASE_URL; ?>back/guru/delete_guru.php",
                    method:"post",
                    data:{
                        id_guru:id_guru
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

        "ajax": "<?= BASE_URL; ?>back/guru/select_all.php?id_jurusan=" + id_jurusan,
        "columns": [
            { "data": "id_guru" },
            { "data": "nik" },
            { "data": "nama_guru" },
            { "data": "alamat"},
            { "data": "no_tlpn"},
            { "data": "jenis_kelamin"},
             <?php if ($_SESSION['jabatan'] == "admin") {?>
            { "data": "username"},
            { "data": "password"},
            { "data": null},
            <?php };?>
           
        ],
        "columnDefs": [
            {
              
              "render": function ( data, type, row ) {
                 
                  return nomor++;
              },
              "targets": 0
          },
            // {
              
            //     "render": function ( data, type, row ) {
                 
            //         return `<a href="<?= BASE_URL ?>view/kelas.php?angkatan=${row.id_kelas}">${data}</a>`;
            //     },
            //     "targets": 1
            // },
            <?php if ($_SESSION['jabatan'] == "admin") {?>
           {
              
                "render": function ( data, type, row ) {
                   
                    return `<button class="btn btn-warning" onclick="handleEdit('${btoa(JSON.stringify(row))}')">Edit</button>
                    <button class="btn btn-danger" onclick="handleHapus('${row.id_guru}')">Hapus</button>`;
                },
                "targets": 8
            },
            <?php };?>
           
        ]
    } );
    }


</script>