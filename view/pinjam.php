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
                    <h1 class="h3 mb-2 text-gray-800">Data Peminjaman Buku</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Isi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") {?>
                                <button type="button" class="btn btn-primary" onclick="InsertPinjam()">
                              Input pinjam
                                </button>
                                <button type="button" class="btn btn-success ml-4" onclick="BukaLaporan()">
                              Laporan Peminjaman
                                </button>
                                <br>
                                <br>
                                <?php } ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Judul</th>
                                            <th>Nama Siswa</th>
                                            <th>Kelas</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Buku Dikembalikan</th>
                                            <th>Jumlah Denda</th>
                                            <th>Status</th>
                                            <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") {?>
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

<div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Input Pinjam</h5>
     
      </div>
      <!-- <div class="row">
      <div class="col-md-4">.col-md-4</div>
      <div class="col-md-4 ms-auto">.col-md-4 .ms-auto</div>
    </div> -->
      <div class="modal-body">
      <div class="row">
          <div class="col-md-6">
        <div class="form-group">
            <label>ISBN:</label>
            <input class="form-control" type="text" value="" aria-label="readonly input example" id="scan" >
            <label>NISN Siswa:</label>
            <input class="form-control" type="text" value="" aria-label="readonly input example" id="nisn" >
        </div>
          </div>
          <div class="col-md-6">
          <h5>Detail</h5><hr>
        <table>
           <tbody>
               <tr>
                   <td>Judul Buku</td>
                   <td>:</td>
                   <td id="judul_buku"></td>
               </tr><tr>
                   <td>Nama Siswa</td>
                   <td>:</td>
                   <td id="nama_siswa"></td>
               </tr>
               <tr>
                    <td>Penerbit</td>
                    <td>:</td>
                    <td id="penerbit_buku"></td>
                </tr>
                <tr>
                    <td>Pengarang</td>
                    <td>:</td>
                    <td id="pengarang_buku"></td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td>:</td>
                    <td id="tahun_buku"></td>
                </tr>
           </tbody>
       </table>
    
          
          </div>
        </div>  
        <!-- <div class="row">
        <div class="col-md-6">
            <hr>
        
            <label>Angkatan:</label>
            <select onchange="getKelas()"  class="form-control form-control-user" id="angkatan" >
                    <option selected>Pilih Angkatan</option>
            </select> 
        </div>
        <div class="col-md-6">
        
        </div>
        </div>  -->
       <!-- <div class="row">
           <div class="col-md-6">

           <label>Kelas:</label>
            <select name="" class="form-control form-control-user" onchange="getSiswa()" id="kelas">
                    <option selected>Pilih Kelas</option>
            </select>
           </div>
       </div> -->
<!-- pl -->
 <!-- <div class="row">
           <div class="col-md-6">
           <label>Siswa:</label>
            <select name="" class="form-control form-control-user"  id="siswa">
                    <option selected>Pilih Siswa</option>
            </select>
    </div> -->
    <div class="col-md-6">

    </div>
       <!-- </div>        -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal1()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanPinjam()">Simpan</button>
      </div>
    </div>
  </div>
</div>
    <!-- Bootstrap core JavaScript-->
<!-- Modal2 -->
<div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Input Perpanjangan</h5>
     
      </div>
      <div class="modal-body">     
        <div class="form-group">
            <label>Jumlah hari:</label>
                <input type="number" min="1" class="form-control" placeholder="" aria-label="Username" id="jumlah_panjang" aria-describedby="basic-addon1">
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal2()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanPanjang()">Simpan</button>
        <!-- <button class="btn btn-danger" onclick="handleKembali(${row.id_peminjaman})">Hapus</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Modal3 -->
<div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Laporan Peminjaman Buku</h5>
     
      </div>
      <div class="modal-body">     
        <div class="form-group"><form method="POST" action="../back/excel/report_pinjam_hari.php"  >
            <label>Dari Tanggal:</label>
                <input type="date"  class="form-control" placeholder=""  id="tgl1" name="tanggal1" aria-describedby="basic-addon1">
            <label>Sampai Tanggal:</label>
            <input type="date"  class="form-control" placeholder=""  id="tgl2" name="tanggal2" aria-describedby="basic-addon1">
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

    var id_angkatan = "";
    var status      = "INSERT"
    var id_buku = ""
    var id_siswa =""

    
    function bukaModal1 (){
         $('#Modal1').modal('show');
         $('#scan').val("");
         $('#angkatan').val("Pilih Angkatan");
        $('#kelas').val("Pilih Kelas");
        $('#siswa').val("Pilih Siswa");
         $('#judul_buku').text("");
        $('#penerbit_buku').text("");
        $('#pengarang_buku').text("");
        $('#tahun_buku').text("");
    }
    function tutupModal1(){
        $('#Modal1').modal('hide');
    }
    function bukaModal2 (){
         $('#Modal2').modal('show');

         
    }
    function tutupModal2(){
        $('#Modal2').modal('hide');
    }
    function bukaModal3(){
         $('#Modal3').modal('show');
          $('#tgl1').val('');
         $('#tgl2').val('');
    }
    function tutupModal3(){
        $('#Modal3').modal('hide');
    }
    function BukaLaporan(){
        bukaModal3();
    }
    function InsertPinjam() {
        bukaModal1();
    }
    // ketika klik btn modal tambah
    
    function handlePanjang(row){
        $('#jumlah_panjang').val("")
        var select_row = (JSON.parse(atob(row)))
         id_peminjaman = select_row.id_peminjaman;
         kembali_tgl = select_row.tgl_kembali
         if(status)
            bukaModal2()

     }
    function simpanPanjang () {
        console.log(id_peminjaman);
        id_peminjaman = id_peminjaman;

        var pinjam_hari = $('#jumlah_panjang').val();
        // keypreslimit input
       if(pinjam_hari>3){
        Swal.fire(
        'Peringatan!',
        'Maksimal 3 Hari!',
        'error'
        )
       }else{

       
  var url           = "<?= BASE_URL; ?>back/peminjaman/simpan_perpanjangan.php";
        
        $.ajax({
            url:url,
            method:"post",
            data:{
                id_peminjaman:id_peminjaman,
                pinjam_hari:pinjam_hari,
                kembali_tgl : kembali_tgl 
            },
            success:function(res){
                Swal.fire("Sukses","Berhasil Diperpanjang","success");
                console.log(res);
                window.table.destroy();
                tutupModal2();
                initTable()
                
            },
            error:function(res){
                console.log(err);
            }
        })
    }
  
}
function handleKembali(id_peminjaman,tanggal_kembali,id_buku,buku_dikembalikan) {
    
    if(buku_dikembalikan=="null"){
    var tanggal1 = new Date(tanggal_kembali + ' 23:59:59')
    console.log(tanggal1)
    var tanggal2 = new Date()
    var hasil = tanggal1.getTime() - tanggal2.getTime();
    var Difference_In_Days =Math.floor( hasil / (1000 * 3600 * 24));
    console.log(Difference_In_Days)
    var jumlah_denda = 0;
    var status = "Kembali";
    
    if (hasil < 0) {
     denda = Difference_In_Days*3000;
     var jumlah_denda = Math.abs(denda);
     var status = "Terlambat";

    }

        //   var r = confirm("Buku Dikembalikan?");
        //       if (r == true) {
            Swal.fire({
        title: 'Buku Dikembalikan?',
        text: "Apakah Buku Sudah Sesuai Dengan Buku Yang Telah Dipinjam?!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Kembalikan Buku!'
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Berhasil!',
            'Buku Telah Dikembalikan!',
            'success'
            )
                 $.ajax({
                    url:"<?= BASE_URL; ?>back/peminjaman/simpan_kembali.php",
                    method:"post",
                    data:{
                        id_peminjaman:id_peminjaman,
                        id_buku:id_buku,
                        jumlah_denda:jumlah_denda,
                        status:status,
                    },
                    success:function(res){
                        console.log(res);
                        window.table.destroy();
                        initTable()
                        
                    },
                    error:function(res){
                        console.log(err);
                    }
                })
            // }
            }
        })
    }else{
            Swal.fire(
                'INFO!',
                'Buku Telah Dikembalikan!',
                'info'
                )
        }
    }
            
    
        
        
    
    function initTable() {
        var nomor = 1;
       window.table = $('#dataTable').DataTable( {

       "paging": true,
       
        "ajax": "<?= BASE_URL; ?>back/peminjaman/select_all.php",
        "columns": [
            { "data": "id_peminjaman" },
            { "data": "judul" },
            { "data": "nama_siswa"},
            { "data": "nama_kelas"},
            { "data": "tgl_pinjam"},
            { "data": "tgl_kembali"},
            { "data": "buku_dikembalikan"},
            { "data": "jumlah_denda"},
            { "data": "status"},
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
             {
              
                "render": function ( data, type, row ) {
                  var denda = row.jumlah_denda;
                   num = new Number(denda).toLocaleString("id-ID");

                  return "Rp" + num;
              },
              "targets": 7
            },
            <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") {?>
           {
              
                "render": function ( data, type, row ) {
                   
                    return `<button class="btn btn-warning" onclick="handlePanjang('${btoa(JSON.stringify(row))}')">Perpanjang</button>
                    <button class="btn btn-danger" onclick="handleKembali('${row.id_peminjaman}','${row.tgl_kembali}','${row.id_buku}','${row.buku_dikembalikan}')">Kembali</button>`;
                },
                "targets": 9
            },
            <?php } ?>
           
        ]
    }  );
    }
    
var list_buku   = [];
      
    // dokumen ketika sudah di load
    $(document).ready(() => {
        // selector by body 
        $('#scan').scannerDetection({
            onComplete:(no_isbn) => {
                // cek apakah yang di scan itu udah masuk apa belum
                $('#scan').val(no_isbn)
                // cari buku ke server
                cariBuku(no_isbn);
                console.log(no_isbn);
                // array js
            }
        })
        // getAngkatan();
    })
    $('#nisn').scannerDetection({
            onComplete:(nisn) => {
                // cek apakah yang di scan itu udah masuk apa belum
                $('#nisn').val(nisn)
                // cari buku ke server
                cariSiswa(nisn);
                console.log(nisn);
                // array js
            }
        })


    function cariBuku(no_isbn){
        $.ajax({
            url:"<?= BASE_URL; ?>back/buku/select_id.php",
            method:"POST",
            data:{
                isbn:no_isbn
            },
            success:(data)=>{
                var parsing = JSON.parse(data);
                for(let k of parsing.data){
                   $('#judul_buku').text(k.judul)
                   $('#penerbit_buku').html("<b>" + k.penerbit + "</b>")
                   $('#pengarang_buku').text(k.pengarang)
                   $('#tahun_buku').text(k.tahun)
                   id_buku = k.id_buku
                }
                console.log(JSON.parse(data));
            },
            error:(e) => {
                console.log(e)
            }
        })
    }

    function cariSiswa(nisn){
        $.ajax({
            url:"<?= BASE_URL; ?>back/siswa/select_id.php",
            method:"POST",
            data:{
                nisn:nisn
            },
            success:(data)=>{
                var parsing = JSON.parse(data);
                for(let k of parsing.data){
                   $('#nama_siswa').text(k.nama_siswa)
                   id_siswa = k.id_siswa
                }
                console.log(JSON.parse(data));
            },
            error:(e) => {
                console.log(e)
            }
        })
    }


    
    function simpanPinjam(){
        
        var pinjam_hari = $('#jumlah_hari').val();
        // var id_siswa = $('#siswa').val();
        
        
        var url           = "<?= BASE_URL; ?>back/peminjaman/simpan_peminjaman.php";
        if (id_buku == "") {
            Swal.fire("Peringatan","ISBN tidak boleh kosong","warning");
            return;
        } if (id_siswa == "") {
            Swal.fire("Peringatan","NISN  tidak boleh kosong","warning");
            return;
        }
        
        $.ajax({
            url:url,
            method:"post",
            data:{
                id_siswa:id_siswa,
                pinjam_hari:pinjam_hari,
                id_buku:id_buku
                
            },
            success:function(res){
                console.log(res);
                Swal.fire("Info!",res,"info");
                window.table.destroy();
                initTable()
                tutupModal1()
            },
            error:function(res){
                console.log(err);
            }
        })

    }
</script>