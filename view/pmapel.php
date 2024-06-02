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
        <?php include "V_sidebar.php" ?>
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
                            <h6 class="m-0 font-weight-bold text-primary">Data Mapel</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Nama Mapel</th>
                                            <th>Aksi</th>
                                            
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
        <h5 class="modal-title" id="exampleModalLabel">Input Mapel</h5>
     
      </div>
      <div class="modal-body">
        <div class="form-group">
             <label>Nama Mapel:</label>
            <input type="text" class="form-control form-control-user" id="nama_mapel" placeholder="Nama Mapel">
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
    var id_mapel    = ""
    var status      = "INSERT"


    function bukaModal(){
        $('#exampleModal').modal('show');
    }
    function tutupModal(){
        $('#exampleModal').modal('hide');
    }
    function simpanData(){
        var nama_mapel = $('#nama_mapel').val();
        var url           = "<?= BASE_URL; ?>back/mapel/insert_mapel.php";

        if(status == "UPDATE"){
            url           = "<?= BASE_URL; ?>back/mapel/update_mapel.php"
        }

        if (nama_mapel == "") {
            Swal.fire("Peringatan","Nama Mapel tidak boleh kosong","warning");
            return;
        }
        $.ajax({
            url:url,
            method:"post",
            data:{
                nama_mapel:nama_mapel,
                id_mapel:id_mapel
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
    function insertMapel() {
        // body...
        $('#nama_mapel').val("")
        status = "INSERT";
        bukaModal();
    }
    function handleEdit(row){
        var select_row = (JSON.parse(atob(row)))
        id_mapel = select_row.id_mapel;
        //  tahunAngkatan
        $('#nama_mapel').val(select_row.nama_mapel);
        status  = "UPDATE"
        bukaModal();
        

    }
    function handleHapus(id_mapel) {
        Swal.fire({
        title: 'Apa Anda Yakin?',
        text: "Anda tidak dapat mengembalikannya lagi!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus Mapel!'
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Dihapus!',
            'Mapel telah dihapus!',
            'success'
            )
                 $.ajax({
                    url:"<?= BASE_URL; ?>back/mapel/delete_mapel.php",
                    method:"post",
                    data:{
                        id_mapel:id_mapel
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
        "ajax": "<?= BASE_URL; ?>back/mapel/select_all.php",
        "columns": [
            { "data": "id_mapel" },
            { "data": "nama_mapel" },
            { "data": null},
           
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
                    
                    return `<a href="<?= BASE_URL ?>view/data_guru.php?mapel=${row.id_mapel}">${data}</a>`;
                },
                "targets": 1
            },
           {
              
                "render": function ( data, type, row ) {
                   
                    return `<button class="btn btn-warning" onclick="handleEdit('${btoa(JSON.stringify(row))}')">Edit</button>
                    <button class="btn btn-danger" onclick="handleHapus('${row.id_mapel}')">Hapus</button>`;
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