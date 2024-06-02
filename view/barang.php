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
        <?php include "V_sidebarsarpras.php" ?>
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
                    <h1 class="h3 mb-2 text-gray-800">Data Barang</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Isi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <?php if ($_SESSION['jabatan'] == "admin"  OR $_SESSION['jabatan'] == "pengurus") { ?>
                                <button type="button" class="btn btn-primary" onclick="insertBarang()">
                              Input Barang
                                </button>
                                 <button type="button" class="btn btn-info ml-4" onclick="insertExcel()">
                              Input Excel
                                </button>
                                <a class="btn btn-success ml-4" href="../back/excel/report_barang.php">Laporan Barang</a>
                                <?php } ?>
                                <br>
                                <br>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Sumber</th>
                                            <?php if ($_SESSION['jabatan'] == "admin"  OR $_SESSION['jabatan'] == "pengurus") { ?>
                                            <th>Aksi</th>
                                            <?php } ?>
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
        <h5 class="modal-title" id="exampleModalLabel">Input Barang</h5>
     
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Kode Barang:</label>
                <input type="text" class="form-control form-control-user" id="kode_barang" placeholder="Masukkan Kode Barang">
        </div>        
        <div class="form-group">
            <label>Nama Barang:</label>
                <input type="text" class="form-control form-control-user" id="nama_barang" placeholder="Masukkan Nama Barang">
        </div>        
        <div class="form-group">
            <label>Jumlah:</label>
                <input type="text" class="form-control form-control-user" id="jumlah" placeholder="Masukkan Jumlah Barang">
        </div>        
        <div class="form-group">
            <label>Sumber Barang:</label>
                <input type="text" class="form-control form-control-user" id="sumber" placeholder="Masukkan Sumber Barang">
        </div>        


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanData()">Simpan</button>
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
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal2()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanExcel()">Simpan</button>
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

    var status      = "INSERT"
    var id_barang = ""


    function bukaModal(){
        $('#exampleModal').modal('show');
    }
    function tutupModal(){
        $('#exampleModal').modal('hide');
    }
    function bukaModal1 (){
         $('#Modal1').modal('show');
         $('#scan').val("");
    }
    function tutupModal1(){
        $('#Modal1').modal('hide');
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
       
        
       form_data.append("file",file[0])

        
        var url           = "<?= BASE_URL; ?>back/barang/insert_excel.php";
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
    function simpanData(){
        var kode_barang = $('#kode_barang').val();
        var nama_barang = $('#nama_barang').val();
        var jumlah = $('#jumlah').val();
        var sumber = $('#sumber').val();
        
        var url           = "<?= BASE_URL; ?>back/barang/insert.php";

        if(status == "UPDATE"){
            url           = "<?= BASE_URL; ?>back/barang/update.php";
        }
        if (kode_barang == "") {
            Swal.fire("Peringatan","Kode Barang tidak boleh kosong","warning");
            return;
        }if (nama_barang == "") {
            Swal.fire("Peringatan","Nama Barang tidak boleh kosong","warning");
            return;
        }if (jumlah == "") {
            Swal.fire("Peringatan","Jumlah tidak boleh kosong","warning");
            return;
        }if (jumlah.value < "0") {
            Swal.fire("Peringatan","Jumlah tidak boleh negatif","warning");
            return;
        }if (sumber == "") {
            Swal.fire("Peringatan","Sumber Barang tidak boleh kosong","warning");
            return;
        }
        
        $.ajax({
            url:url,
            method:"post",
            data:{
                id_barang:id_barang,
                kode_barang:kode_barang,
                nama_barang:nama_barang,
                jumlah:jumlah,
                sumber:sumber
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
    function insertBarang() {
        // body...
        $('#kode_barang').val("");
        $('#nama_barang').val("");
        $('#jumlah').val("");
        $('#sumber').val("");
        
        status = "INSERT";
        bukaModal();
    }
    function handleEdit(row){
        var select_row = (JSON.parse(atob(row)))
        id_barang = select_row.id_barang;
        //  tahunAngkatan
        $('#kode_barang').val(select_row.kode_barang);
        $('#nama_barang').val(select_row.nama_barang);
        $('#jumlah').val(select_row.jumlah);
        $('#sumber').val(select_row.sumber);
        status  = "UPDATE"
        bukaModal();

    }
    function handleHapus(id_barang) {
           Swal.fire({
  title: 'Apa Anda Yakin?',
  text: "Anda tidak dapat mengembalikannya lagi!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Hapus Barang!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Dihapus!',
      'Barang telah dihapus!',
      'success'
    )
     $.ajax({
                    url:"<?= BASE_URL; ?>back/barang/delete.php",
                    method:"post",
                    data:{
                        id_barang:id_barang
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
       "searching":true,
        "ajax": "<?= BASE_URL; ?>back/barang/select_all.php",
        "columns": [
            { "data": "id_buku" },
            { "data": "kode_barang" },
            { "data": "nama_barang"},
            { "data": "jumlah"},
            { "data": "sumber"},
           
        ],
        "columnDefs": [
            {
              
                "render": function ( data, type, row ) {
                 
                  return nomor++;
              },
              "targets": 0
            },
            <?php if ($_SESSION['jabatan'] == "admin"  OR $_SESSION['jabatan'] == "pengurus") { ?>
           {
              
                "render": function ( data, type, row ) {
                   
                    return `<button class="btn btn-warning" onclick="handleEdit('${btoa(JSON.stringify(row))}')">Edit</button>
                    <button class="btn btn-danger" onclick="handleHapus('${row.id_barang}')">Hapus</button>`;
                },
                "targets":5
            },
           <?php } ?>
        ]
    } );
    }
</script>