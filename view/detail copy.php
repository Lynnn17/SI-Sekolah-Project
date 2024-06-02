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
        <?php include "V_sidebarsmk.php" ?>
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
                            <?php if ($_SESSION['jabatan'] == "admin") {?>
                                <button type="button" class="btn btn-primary" onclick="insertKelas()">
                              Input Siswa
                                </button>                               
                                <br>
                                <br>
                                <?php };?>
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
    

</body>
<script type="text/javascript">
    $(document).ready(function() {
        // initTable()

    } );
 
    
    var status      = "INSERT"
    var id_siswa = "<?= $_GET['siswa']?>"

    function bukaModal(){
        $('#exampleModal').modal('show');
    }
    function tutupModal(){
        $('#exampleModal').modal('hide');
    }
    function simpanData(){
        var namaSiswa = $('#namaSiswa').val();
        var Alamat = $('#Alamat').val();
        var notelepon = $('#notelepon').val();
        var jk = $('#jk').val();
       
       
        var url           = "<?= BASE_URL; ?>back/siswa/insert_siswa.php";

        if(status == "UPDATE"){
            url           = "<?= BASE_URL; ?>back/siswa/update_siswa.php"
        }

        if (namaSiswa == "") {
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
        $('#namaSiswa').val(select_row.nama_siswa);
        $('#Alamat').val(select_row.alamat);
        $('#notelepon').val(select_row.no_tlpn);
        $('#jk').val(select_row.jenis_kelamin);
       
       
        status  = "UPDATE"
        bukaModal();

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