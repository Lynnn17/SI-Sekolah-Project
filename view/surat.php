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
        <?php include "V_sidebarsurat.php" ?>
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
                    <h1 class="h3 mb-2 text-gray-800">Data Surat</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Isi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") {?>
                                <button type="button" class="btn btn-primary" onclick="insertSurat()">
                              Input Surat
                                </button>
                                <button type="button" class="btn btn-success ml-4" onclick="BukaLaporan()">
                              Laporan Surat
                                </button>
                                
                                <br>
                                <br>
                                <?php } ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Nomer Surat</th>
                                            <th>Nama Surat</th>
                                            <th>Jenis Surat</th>
                                            <th>File</th>
                                            <th>Diperuntukkan</th>
                                            <th>Tanggal</th>
                                            <th>Admin</th>
                                            
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
        <h5 class="modal-title" id="exampleModalLabel">Input Surat</h5>
     
      </div>
      <div class="modal-body">
      <div class="form-group">
        <label>Nomer Surat :</label>
        <input type="text" class="form-control form-control-user" id="no_surat" placeholder="Masukkan Nomer Surat">
        <label>Nama Surat:</label>
                <input type="text" class="form-control form-control-user" id="nama_surat" placeholder="Masukkan Nama Iuran">
            <label for="formFile" class="form-label">File Surat</label>
                <input class="form-control" type="file" id="file">
            <label>Diperuntukkan :</label>
                <input type="text" class="form-control form-control-user" id="diperuntukkan" placeholder="Masukkan Nama ">
            <label>Jenis Surat:</label>
                 <select class="form-control" aria-label="" id="js">
                    <option selected>Jenis</option>
                    <option value="Surat Masuk">Surat Masuk</option>
                    <option value="Surat Keluar">Surat Keluar</option>
                 </select>
            <label>Admin:</label>
                <input type="text" class="form-control form-control-user" value="<?php echo $_SESSION['nama_user']; ?>" id="admin" readonly> 
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanSurat()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Surat</h5>
     
      </div>
      <div class="modal-body">
      <div class="form-group">
        <label>Nomer Surat :</label>
        <input type="text" class="form-control form-control-user" id="no_surat1" placeholder="Masukkan Nomer Surat">
        <label>Nama Surat:</label>
                <input type="text" class="form-control form-control-user" id="nama_surat1" placeholder="Masukkan Nama Iuran">
            <label for="formFile" class="form-label">File Surat</label>
                <input class="form-control" type="file" id="file1">
            <label>Diperuntukkan :</label>
                <input type="text" class="form-control form-control-user" id="diperuntukkan1" placeholder="Masukkan Nama ">
            <label>Jenis Surat:</label>
                 <select class="form-control" aria-label="" id="js1">
                    <option selected>Jenis</option>
                    <option value="Surat Masuk">Surat Masuk</option>
                    <option value="Surat Keluar">Surat Keluar</option>
                 </select>
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

<!-- modal gambar -->
<div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail File Surat</h5>
      </div>
      <div class="modal-body"  id="gambar">
      
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal3()">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal4 -->
<div class="modal fade" id="Modal4" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Laporan Peminjaman Barang</h5>
     
      </div>
      <div class="modal-body">     
        <div class="form-group"><form method="POST" action="../back/excel/report_surat.php"  >
            <label>Dari Tanggal:</label>
                <input type="date"  class="form-control" placeholder=""  id="tgl1" name="tanggal1" aria-describedby="basic-addon1">
            <label>Sampai Tanggal:</label>
            <input type="date"  class="form-control" placeholder=""  id="tgl2" name="tanggal2" aria-describedby="basic-addon1">
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal4()">Tutup</button>
        <input type="submit" name="cetak" target="blank"  class="btn btn-primary" onclick="tutupModal4()">
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


    var id_surat = ""
   

    function bukaModal(){
        $('#exampleModal').modal('show');
        $('#no_surat').val("");
        $('#nama_surat').val("");
        $('#file').val("");
        $('#diperuntukkan').val("");
        $('#js').val("Jenis");

    }
    function tutupModal(){
        $('#exampleModal').modal('hide');
    }
    function bukaModal2 (){
        $('#Modal2').modal('show');
         $('#file1').val("");
        // $('#nama_siswa').text("");
        // $('#nama_pembayaran').val("");
        // $('#total_dibayar').val("");
        // $('#total_pembayaran').val("");
    }
    function tutupModal2(){
        $('#Modal2').modal('hide');
    }
    
    function insertSurat() {
        bukaModal();
    }
    function bukaModal3() {
         $('#Modal3').modal('show');
         
    }
    function tutupModal3() {
         $('#Modal3').modal('hide');
         $('#gambar').html("");
    }
    function bukaModal4(){
         $('#Modal4').modal('show');
          $('#tgl1').val('');
         $('#tgl2').val('');
    }
    function tutupModal4(){
        $('#Modal4').modal('hide');
    }
    function BukaLaporan(){
        bukaModal4();
    }

    function handleEdit(row){
        
        var select_row = (JSON.parse(atob(row)))
        id_surat = select_row.id_surat;
       
        $('#no_surat1').val(select_row.no_surat);
        $('#nama_surat1').val(select_row.nama_surat);
        $('#js1').val(select_row.jenis_surat);
        $('#diperuntukkan1').val(select_row.diperuntukkan);
        $('#admin').val(select_row.admin);
        fileedit = select_row.file;
            
        // $('#judul').val(select_row.judul);
        // $('#pengarang').val(select_row.pengarang);
        // $('#penerbit').val(select_row.penerbit);
        // $('#tahun').val(select_row.tahun);
        // $('#jumlah').val(select_row.jumlah);
        // $('#lokasi').val(select_row.lokasi);
        // status  = "UPDATE"
        bukaModal2();
        
    }
    function simpanEdit () {
    console.log(fileedit)
        let file = $("#file1")[0]['files'];
        console.log(file)
        if (file.length == 0) {
        //    file = [null]
        Swal.fire("Peringatan","Silahkan Upload File Surat Dan File Lama Akan Diganti Dengan File Baru","warning");
        return
        }else{
        var name = document.getElementById("file1").files[0].name;
        var ext = name.split('.').pop().toLowerCase();
         if(ext != 'jpg' && ext != 'png' && ext != 'pdf'){
       Swal.fire("Peringatan","File Harus berformat jpg/png/pdf","warning");
        return
    }
        }
        var form_data = new FormData();
        
        var no_surat = $('#no_surat1').val();
        var nama_surat = $('#nama_surat1').val();
        // var file = $('#file').val();
        var diperuntukkan = $('#diperuntukkan1').val();
        var js = $('#js1').val();
        var admin = $('#admin').val();
    
        
       form_data.append("file",file[0])
       form_data.set("fileedit",fileedit);
        form_data.set("id_surat", id_surat);
        form_data.set("no_surat", no_surat);
        form_data.set("nama_surat", nama_surat);
       
        form_data.set("diperuntukkan", diperuntukkan );
        form_data.set("jenis_surat", js);
        form_data.set("admin", admin);
        
        var url           = "<?= BASE_URL; ?>back/surat/update_surat.php";
        if (no_surat == "") {
            Swal.fire("Peringatan","Nomer Surat tidak boleh kosong","warning");
            return;
        }if (nama_surat == "") {
            Swal.fire("Peringatan","Nama Surat tidak boleh kosong","warning");
            return;
        }if (diperuntukkan == "") {
            Swal.fire("Peringatan","Diperuntukkan tidak boleh kosong","warning");
            return;
        }if (js == "") {
            Swal.fire("Peringatan","Jenis Surat tidak boleh kosong","warning");
            return;
        }Swal.fire({
  title: 'Peringatan!!!',
  text: "File Lama Akan Diganti Dengan File Yang Baru Dan File Yang Lama Akan Terhapus!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Lanjutkan!'
}).then((result) => {
  if (result.isConfirmed) {
    // Swal.fire(
    //   'UPDATE!',
    //   'Data Telah Berhasil Diupdate!',
    //   'success'
    // )
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
        })     

    }
function simpanSurat(){
        let file = $("#file")[0]['files'];
        if (file.length == 0) {
            console.log(file)
            Swal.fire("Peringatan","Silahkan Upload File Surat","warning");
            return
        }
        var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
    if(ext != 'jpg' && ext != 'png' && ext != 'pdf'){
       Swal.fire("Peringatan","File Harus berformat jpg/png/pdf","warning");
        return
    }
        var no_surat = $('#no_surat').val();
        var nama_surat = $('#nama_surat').val();
        // var file = $('#file').val();
        var diperuntukkan = $('#diperuntukkan').val();
        var js = $('#js').val();
        var admin = $('#admin').val();
    
        
       form_data.append("file",file[0])
       
        form_data.set("no_surat", no_surat);
        form_data.set("nama_surat", nama_surat);
       
        form_data.set("diperuntukkan", diperuntukkan );
        form_data.set("jenis_surat", js);
        form_data.set("admin", admin);
        
        var url           = "<?= BASE_URL; ?>back/surat/simpan_surat.php";
        if (no_surat == "") {
            Swal.fire("Peringatan","Nomer Surat tidak boleh kosong","warning");
            return;
        }if (nama_surat == "") {
            Swal.fire("Peringatan","Nama Surat tidak boleh kosong","warning");
            return;
        }if (diperuntukkan == "") {
            Swal.fire("Peringatan","Diperuntukkan tidak boleh kosong","warning");
            return;
        }if (js == "Jenis") {
            Swal.fire("Peringatan","Silahkan Pilih Salah Satu Jenis Surat ","warning");
            return;
        }
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
                tutupModal()
            },
            error:function(res){
                console.log(err);
            }
        })
        

    }
    function handleHapus(id_surat,filename) {
           Swal.fire({
  title: 'Apa Anda Yakin?',
  text: "Anda tidak dapat mengembalikannya lagi!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Hapus Surat!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Dihapus!',
      'Surat telah dihapus!',
      'success'
    )
     $.ajax({
                    url:"<?= BASE_URL; ?>back/surat/hapus_surat.php",
                    method:"post",
                    data:{
                        id_surat:id_surat,
                        filename:filename
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

    function handleGambar(id_surat,file) {
    var myImage = new Image(450, 450);
	myImage.src = "<?= BASE_URL; ?>assets/uploads/surat/" + file;
	x = document.getElementById("gambar");
	x.appendChild(myImage);	
        bukaModal3()
    }
    
    function initTable() {
        var nomor = 1;
        var duit = "Rp";
       window.table = $('#dataTable').DataTable( {

       "paging": true,
       "searching":true,
        "ajax": "<?= BASE_URL; ?>back/surat/select_all.php",
        "columns": [
            { "data": "id_surat" },
            { "data": "no_surat" },
            { "data": "nama_surat"},
            { "data": "jenis_surat"},
            { "data": "file"},
            { "data": "diperuntukkan"},
            { "data": "tanggal"},
            <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") {?>
            { "data": "admin"},
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
             {
                "render": function ( data, type, row ) {
                 
                    return `<a href="" data-toggle="modal" onclick="handleGambar('${row.id_surat}','${row.file}')">${data}</a>`;
                },
                "targets": 4
            },
               
            <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") {?>
           {
              
                "render": function ( data, type, row ) {
   
                    return `<button class="btn btn-warning" onclick="handleEdit('${btoa(JSON.stringify(row))}')">Edit</button>
                    <button class="btn btn-danger" onclick="handleHapus('${row.id_surat}','${row.file}')">Hapus</button>`;
                },
                "targets": 8
            },
        <?php } ?>
           
        ]
    } );
    }


</script>