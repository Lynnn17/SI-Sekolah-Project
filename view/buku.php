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
        <?php include "V_sidebarperpus.php" ?>
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
                    <h1 class="h3 mb-2 text-gray-800">Data Buku</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Isi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if ($_SESSION['jabatan'] == "admin"  OR $_SESSION['jabatan'] == "pengurus") {?>
                                <button type="button" class="btn btn-primary" onclick="insertBuku()">
                              Input Buku
                                </button>
                                <button type="button" class="btn btn-info ml-4" onclick="insertExcel()">
                              Input Excel
                                </button>
                                <a class="btn btn-success ml-4" href="../back/excel/report.php">Laporan Buku</a>
                                <br>
                                <br>
                                <?php } ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>ISBN</th>
                                            <th>Judul</th>
                                            <th>Pengarang</th>
                                            <th>Penerbit</th>
                                            <th>Tahun Terbit</th>
                                            <th>Jumlah</th>
                                            <th>Lokasi</th>
                                            <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") { ?>
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
        <h5 class="modal-title" id="exampleModalLabel">Input Buku</h5>
     
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>ISBN:</label>
                <input type="text" class="form-control form-control-user" id="isbn" placeholder="Masukkan ISBN">
        </div>        
        <div class="form-group">
            <label>Judul Buku:</label>
                <input type="text" class="form-control form-control-user" id="judul" placeholder="Masukkan Judul Buku">
        </div>        
        <div class="form-group">
            <label>Pengarang:</label>
                <input type="text" class="form-control form-control-user" id="pengarang" placeholder="Masukkan Pengarang">
        </div>        
        <div class="form-group">
            <label>Penerbit:</label>
                <input type="text" class="form-control form-control-user" id="penerbit" placeholder="Masukkan Penerbit">
        </div>        
        <div class="form-group">
            <label>Tahun:</label>
                <input type="text" class="form-control form-control-user" id="tahun" placeholder="Masukkan Tahun">
        </div>
        <div class="form-group">
            <label>Jumlah:</label>
                <input type="text" class="form-control form-control-user" id="jumlah" placeholder="Masukkan Jumlah Buku">
        </div>        
        <div class="form-group">
            <label>Lokasi:</label>
                <input type="text" class="form-control form-control-user" id="lokasi" placeholder="Masukkan Lokasi">
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

    var id_angkatan = "";
    var status      = "INSERT"
    var id_buku = ""


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

        
        var url           = "<?= BASE_URL; ?>back/buku/insert_excel.php";
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
        var isbn = $('#isbn').val();
        var judul = $('#judul').val();
        var pengarang = $('#pengarang').val();
        var penerbit = $('#penerbit').val();
        var jumlah = $('#jumlah').val();
        var tahun = $('#tahun').val();
        var lokasi = $('#lokasi').val();
        
        var url           = "<?= BASE_URL; ?>back/buku/insert_buku.php";

        if(status == "UPDATE"){
            url           = "<?= BASE_URL; ?>back/buku/update_buku.php"
        }
        // if (isbn == "") {
        //     Swal.fire("Peringatan","ISBN tidak boleh kosong","warning");
        //     return;
        // }
        // if (judul == "") {
        //     Swal.fire("Peringatan","Judul Buku tidak boleh kosong","warning");
        //     return;
        // }if (pengarang == "") {
        //     Swal.fire("Peringatan","Pengarang tidak boleh kosong","warning");
        //     return;
        // }if (penerbit == "") {
        //     Swal.fire("Peringatan","Penerbit tidak boleh kosong","warning");
        //     return;
        // }if (tahun == "") {
        //     Swal.fire("Peringatan","Tahun tidak boleh kosong","warning");
        //     return;
        // }if (jumlah == "") {
        //     Swal.fire("Peringatan","Jumlah tidak boleh kosong","warning");
        //     return;
        // }if (jumlah.value < "0") {
        //     Swal.fire("Peringatan","Jumlah tidak boleh negatif","warning");
        //     return;
        // }if (lokasi == "") {
        //     Swal.fire("Peringatan","Lokasi tidak boleh kosong","warning");
        //     return;
        // }
        switch( isbn ){
            case "":
                Swal.fire("Peringatan","ISBN tidak boleh kosong","warning");
                return;
        }
        switch(judul){
            case "" :
                Swal.fire("Peringatan","Judul Buku tidak boleh kosong","warning");
                return;
        }
        switch(pengarang){
            case "" :
                Swal.fire("Peringatan","Pengarangx tidak boleh kosong","warning");
                return;
        }    
        switch(penerbit){
            case "" :
                Swal.fire("Peringatan","Penerbit tidak boleh kosong","warning");
                return;
        }    
        switch (tahun) {
            case "":
            Swal.fire("Peringatan","Tahun tidak boleh kosong","warning");
            return;
        }
        switch (jumlah) {
            case "":
            Swal.fire("Peringatan","Jumlah tidak boleh kosong","warning");
            return;
        }if (jumlah < "0") {
            Swal.fire("Peringatan","Jumlah tidak boleh negatif","warning");
            return;
        }
        switch (lokasi) {
            case "":
            Swal.fire("Peringatan","Lokasi tidak boleh kosong","warning");
            return;
        }
        
        
        $.ajax({
            url:url,
            method:"post",
            data:{
                id_buku:id_buku,
                isbn:isbn,
                judul:judul,
                pengarang:pengarang,
                penerbit:penerbit,
                tahun:tahun,
                jumlah:jumlah,
                lokasi:lokasi
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
    function Laporan() {
        Swal.fire("Sukses!","Laporan berhasil dibuat!","success");
    }
    // ketika klik btn modal tambah
    function insertBuku() {
        // body...
        $('#isbn').val("")
        $('#judul').val("")
        $('#pengarang').val("")
        $('#penerbit').val("")
        $('#tahun').val("")
        $('#jumlah').val("")
        $('#lokasi').val("")
        
        status = "INSERT";
        bukaModal();
    }
    function handleEdit(row){
        var select_row = (JSON.parse(atob(row)))
        id_buku = select_row.id_buku;
        //  tahunAngkatan
        $('#isbn').val(select_row.isbn);
        $('#judul').val(select_row.judul);
        $('#pengarang').val(select_row.pengarang);
        $('#penerbit').val(select_row.penerbit);
        $('#tahun').val(select_row.tahun);
        $('#jumlah').val(select_row.jumlah);
        $('#lokasi').val(select_row.lokasi);
        status  = "UPDATE"
        bukaModal();

    }
    function handleHapus(id_buku) {
           Swal.fire({
  title: 'Apa Anda Yakin?',
  text: "Anda tidak dapat mengembalikannya lagi!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Hapus Bukunya!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Dihapus!',
      'Buku telah dihapus!',
      'success'
    )
     $.ajax({
                    url:"<?= BASE_URL; ?>back/buku/delete_buku.php",
                    method:"post",
                    data:{
                        id_buku:id_buku
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
        "ajax": "<?= BASE_URL; ?>back/buku/select_all.php",
        "columns": [
            { "data": "id_buku" },
            { "data": "isbn" },
            { "data": "judul"},
            { "data": "pengarang"},
            { "data": "penerbit"},
            { "data": "tahun"},
            { "data": "jumlah"},
            { "data": "lokasi"},
            <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") {?>
            { "data": null},
        <?php } ?>
           
        ],
        "columnDefs": [
            {
              
                "render": function ( data, type, row ) {
                 
                  return nomor++;
              },
              "targets": 0
            },
            <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") {?>
           {
              
                "render": function ( data, type, row ) {
                   
                    return `<button class="btn btn-warning" onclick="handleEdit('${btoa(JSON.stringify(row))}')">Edit</button>
                    <button class="btn btn-danger" onclick="handleHapus('${row.id_buku}')">Hapus</button>`;
                },
                "targets": 8
            },
        <?php } ?>
           
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