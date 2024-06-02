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
        <?php include "V_sidebarsurat.php";?>
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
                            <h6 class="m-0 font-weight-bold text-primary">Data User </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <?php if ($_SESSION['jabatan'] == "admin") {?>
                                <button type="button" class="btn btn-primary" onclick="insertUser()">
                              Input User
                                </button>
                                <br>
                                <br>
                                <?php };?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <?php if ($_SESSION['jabatan'] == "admin") {?>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <?php }?>
                                            <th>Nama User</th>
                                            <th>Alamat</th>
                                            <th>No Telpon</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Jabatan</th>
                                            <?php if ($_SESSION['jabatan'] == "admin") {?>
                                            <th>Aksi</th>
                                            <?php }; ?>
                                            
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
        <h5 class="modal-title" id="exampleModalLabel">Input User</h5>
     
      </div>
      <div class="modal-body">
        <div class="form-group">
        <label>Username:</label>
            <input type="text" class="form-control form-control-user" id="usr" placeholder="Username">
        <label>Password:</label>
            <input type="text" class="form-control form-control-user" id="psw" placeholder="Password">
        <label>Nama User:</label>
            <input type="text" class="form-control form-control-user" id="nama" placeholder="Nama User">
        <label>Alamat:</label>
            <input type="text" class="form-control form-control-user" id="Alamat" placeholder="Alamat">
        <label>No Telpon:</label>
            <input type="text" class="form-control form-control-user" id="no" placeholder="No Telpon">
        <label>Jenis Kelamin:</label>
            <select class="form-control" aria-label="" id="jk">
                <option selected>Pilih Jenis Kelamin</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        <label>Jabatan:</label>
            <select class="form-control" aria-label="" id="jabatan">
                <option selected>Pilih Jabatan</option>
                <option value="admin">Admin</option>
                <option value="pengurus">Pengurus</option>
                <option value="user">User</option>
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
    var id_user = "";
    var status      = "INSERT"


    function bukaModal(){
        $('#exampleModal').modal('show');
    }
    function tutupModal(){
        $('#exampleModal').modal('hide');
    }
    function simpanData(){
        
        var usr = $('#usr').val();
        var psw = $('#psw').val();
        var alamat = $('#Alamat').val();
        var no_tlpn = $('#no').val();
        var nama_user = $('#nama').val();
        var jk = $('#jk').val();
        var jabatan = $('#jabatan').val();
        var url           = "<?= BASE_URL; ?>back/userlaporan/insert_user.php";

        if(status == "UPDATE"){
            url           = "<?= BASE_URL; ?>back/userlaporan/update_user.php"
        }
        if (usr == "") {
            Swal.fire("Peringatan","Username Tidak Boleh Kosong","warning");
            return;
        }if (psw == "") {
            Swal.fire("Peringatan","Password Tidak Boleh Kosong","warning");
            return;
        }if (nama_user == "") {
            Swal.fire("Peringatan","Nama User Tidak Boleh Kosong","warning");
            return;
        }if (alamat == "") {
            Swal.fire("Peringatan","Alamat Tidak Boleh Kosong","warning");
            return;
        }if (no_tlpn == "") {
            Swal.fire("Peringatan","No Telpon Tidak Boleh Kosong","warning");
            return;
        }if (jk == "Pilih Jenis Kelamin") {
            Swal.fire("Peringatan","Silahkan Pilih Salah Satu Jenis Kelamin","warning");
            return;
        }if (jabatan == "Pilih Jabatan") {
            Swal.fire("Peringatan","Silahkan Pilih Salah Satu Jabatan","warning");
            return;
        }if (jk == "") {
            Swal.fire("Peringatan"," Pilih Salah Satu Jenis Kelamin","warning");
            return;
        }if (jabatan == "") {
            Swal.fire("Peringatan"," Pilih Salah Satu Jabatan","warning");
            return;
        }

        $.ajax({
            url:url,
            method:"post",
            data:{
                username:usr,
                password:psw,
                alamat:alamat,
                no_tlpn:no_tlpn,
                nama_user:nama_user,
                jenis_kelamin:jk,
                jabatan:jabatan,
                id_user:id_user,
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
    function insertUser() {
        // body...
        $('#psw').val("");
        $('#usr').val("");
        $('#Alamat').val("");
        $('#no').val("");
        $('#nama').val("");
        $('#jk').val("Pilih Jenis Kelamin");
        $('#jabatan').val("Pilih Jabatan");
        status = "INSERT";
        bukaModal();
    }
    function handleEdit(row){
        var select_row = (JSON.parse(atob(row)))
        id_user = select_row.id_user;
        //  tahunAngkatan
        $('#psw').val(select_row.password);
        $('#usr').val(select_row.username);
        $('#Alamat').val(select_row.alamat);
        $('#no').val(select_row.no_tlpn);
        $('#nama').val(select_row.nama_user);
        $('#jk').val(select_row.jenis_kelamin);
        $('#jabatan').val(select_row.jabatan);
        status  = "UPDATE"
        bukaModal();
        

    }
    function handleHapus(id_user) {
        Swal.fire({
        title: 'Apa Anda Yakin?',
        text: "Anda tidak dapat mengembalikannya lagi!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus User!'
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Dihapus!',
            'User telah dihapus!',
            'success'
            )
                 $.ajax({
                    url:"<?= BASE_URL; ?>back/usersurat/delete_user.php",
                    method:"post",
                    data:{
                        id_user:id_user
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
        "ajax": "<?= BASE_URL; ?>back/userlaporan/select_all.php",
        "columns": [
            { "data": "id_user" },
            <?php if ($_SESSION['jabatan'] == "admin") {?>
            { "data": "username" },
            { "data": "password" },
            <?php }?>
            { "data": "nama_user" },
            { "data": "alamat" },
            { "data": "no_tlpn" },
            { "data": "jenis_kelamin" },
            { "data": "jabatan" },
            <?php if ($_SESSION['jabatan'] == "admin") {?>
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
            <?php if ($_SESSION['jabatan'] == "admin") {?>
           {
              
                "render": function ( data, type, row ) {
                   
                    return `<button class="btn btn-warning" onclick="handleEdit('${btoa(JSON.stringify(row))}')">Edit</button>
                    <button class="btn btn-danger" onclick="handleHapus('${row.id_user}')">Hapus</button>`;
                },
                "targets": 8
            },
            <?php };?>
           
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