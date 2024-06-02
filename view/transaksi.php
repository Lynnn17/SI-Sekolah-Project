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
                    <h1 class="h3 mb-2 text-gray-800">Transaksi Pembayaran</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Isi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") {?>
                                <button type="button" class="btn btn-primary" onclick="insertTransaksi()">
                              Input Transaksi
                                </button>
                                <a href="../back/iuran/kwitansi.php" onclick="location.href=this.href+'?siswa='+id_siswa;
                                return false;" class="btn btn-primary">Cetak Kwitansi</a>
                                 <button type="button" class="btn btn-success" onclick="BukaLaporan()">
                              Laporan Record
                                </button>
                                <br>
                                <br>
                                <?php } ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Nama Iuran</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Total Pembayaran</th>
                                            <th>Sisa</th>
                                            <th>Total Iuran</th>
                                            <th>Status</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Input Transaksi</h5>
      </div>
      <div class="modal-body">
      <div class="form-group">
        <label>Nama Iuran:</label>
                <input type="text" class="form-control form-control-user" id="nama_pembayaran" placeholder="Masukkan Nama Iuran">
            <label>Total Iuran:</label>
                <input type="text" class="form-control form-control-user" id="total_pembayaran" placeholder="Masukkan Total Iuran">
            <!-- <label>Nominal Pembayaran:</label>
                <input type="text" class="form-control form-control-user" id="total_dibayar" placeholder="Masukkan Nominal Pembayaran"> -->
            <label>Admin:</label>
                <input type="text" class="form-control form-control-user" value="<?php echo $_SESSION['nama_user']; ?>" id="admin" readonly> 
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanIuran()">Simpan</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Bayar</h5>
     
      </div>
      <div class="modal-body">
      <div class="form-group">
            <label>Nominal Pembayaran:</label>
                <input type="text" class="form-control form-control-user" id="total_bayar" placeholder="Masukkan Nominal Pembayaran">
            <label>Admin:</label>
                <input type="text" class="form-control form-control-user" value="<?php echo $_SESSION['nama_user']; ?>" id="admin" readonly> 
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal2()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanBayar()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Iuran</h5>
      </div>
      <div class="modal-body">
      <div class="form-group">
        <label>Nama Pembayaran:</label>
                <input type="text" class="form-control form-control-user" id="n_pembayaran" placeholder="Masukkan Nama Iuran">
            <label>Total Pembayaran:</label>
                <input type="text" class="form-control form-control-user" id="t_pembayaran" placeholder="Masukkan Total Iuran">
            <label>Total Dibayar:</label>
                <input type="text" class="form-control form-control-user" id="t_dibayar" placeholder="Masukkan Nominal Pembayaran">
            <label>Admin:</label>
                <input type="text" class="form-control form-control-user" value="<?php echo $_SESSION['nama_user']; ?>" id="admin" readonly> 
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal4()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="simpanEdit()">Simpan</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Bayar</h5>
     
      </div>
      <div class="modal-body">
      <div class="form-group">
            <label>Nominal Pembayaran:</label>
                <input type="text" class="form-control form-control-user" id="total_bayar" placeholder="Masukkan Nominal Pembayaran">
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

    <!-- Bootstrap core JavaScript-->
    <div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Laporan Record Pembayaran</h5>
     
      </div>
      <div class="modal-body">     
        <div class="form-group"><form method="POST" action="../back/excel/report_pembayaranrecord.php"  >
            <label>Dari Tanggal:</label>
                <input type="date"  class="form-control" placeholder=""  id="tgl1" name="tanggal1" aria-describedby="basic-addon1">
            <label>Sampai Tanggal:</label>
            <input type="date"  class="form-control" placeholder=""  id="tgl2" name="tanggal2" aria-describedby="basic-addon1">
            <label>Nama Pembayaran:</label>
            <!-- <input type="text" class="form-control" value="" id="bayar" name="bayar" aria-describedby="basic-addon1"> -->
             <input type="text"  class="form-control" aria-label="Username" aria-describedby="basic-addon1" onclick="getNama()" name="bayar" id="ac">
            <!-- <label>ID Kelas:</label> -->
            <input type="hidden" class="form-control" value="" id="siswa" name="siswa" aria-describedby="basic-addon1">
            
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal3()">Tutup</button>
        <input type="submit" name="cetak" target="blank"  class="btn btn-primary"  onclick="tutupModal3()">
      </div>
    </div>
  </div>
</div>

</body>
<script type="text/javascript">
    $(document).ready(function() {
        initTable()
        // $('.money').mask('000.000.000.000.000,00', {reverse: true});
         $( '#total_bayar' ).mask('000.000.000', {reverse: true});
         $( '#total_dibayar' ).mask('000.000.000', {reverse: true});
         $( '#total_pembayaran' ).mask('000.000.000', {reverse: true});
         $( '#t_dibayar' ).mask('000.000.000', {reverse: true});
         $( '#t_pembayaran' ).mask('000.000.000', {reverse: true});
    } );
   
    var status      = "INSERT"
    var id_pembayaran = ""
    var id_siswa = "<?= $_GET['siswa']?>"
    var bayar2 =""
    let num = ""

    function bukaModal(){
        $('#exampleModal').modal('show');
        $('#nama_siswa').text("");
        $('#nama_pembayaran').val("");
        $('#total_dibayar').val("");
        $('#total_pembayaran').val("");

    }
    function tutupModal(){
        $('#exampleModal').modal('hide');
    }
    function bukaModal2 (){
        $('#Modal1').modal('show');
        $('#total_bayar').val("");
    }
    function tutupModal2(){
        $('#Modal1').modal('hide');
    }
    
    function insertTransaksi() {
        bukaModal();
    }
    function bukaModal3(){
         $('#Modal3').modal('show');
         $('#siswa').val(id_siswa);
         $('#tgl1').val('');
         $('#tgl2').val('');
         $('#ac').val('');
    }
    function tutupModal3(){
        $('#Modal3').modal('hide');
    }
    function bukaModal4(){
         $('#modal4').modal('show');
        
    }
    function tutupModal4(){
        $('#modal4').modal('hide');
    }
    function BukaLaporan(){
        bukaModal3();
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
    function handleBayar(row){

        var select_row = (JSON.parse(atob(row)))
        id_pembayaran = select_row.id_pembayaran;
        id_siswa = select_row.id_siswa;
        //  tahunAngkatan
        bayar2 = parseInt(select_row.total_dibayar);
        total_pembayaran = parseInt(select_row.total_pembayaran);
        nama_pembayaran=select_row.nama_pembayaran;
        status=select_row.status
        if(status=="Lunas"){
            Swal.fire(
            'Peringatan!',
            'Pembayaran Telah Lunas!',
            'warning'
            )
        }else{
            
        // $('#judul').val(select_row.judul);
        // $('#pengarang').val(select_row.pengarang);
        // $('#penerbit').val(select_row.penerbit);
        // $('#tahun').val(select_row.tahun);
        // $('#jumlah').val(select_row.jumlah);
        // $('#lokasi').val(select_row.lokasi);
        // status  = "UPDATE"
        bukaModal2();
        }
    }
function simpanBayar () {
        
        console.log(id_pembayaran);
        console.log(bayar2)
        var cicil1 = $('#total_bayar').val();
        var cicil= parseInt(cicil1.replace(/\./g,""));
        var total_dibayar = cicil + bayar2;
        console.log(typeof total_dibayar);
        var admin = $('#admin').val();
        if (cicil1 == "") {
            Swal.fire("Peringatan","Total Dibayar tidak boleh kosong","warning");
            return;
        }
        // keypreslimit input 
  var url           = "<?= BASE_URL; ?>back/iuran/simpan_cicilan.php";
  if(total_dibayar > total_pembayaran){
            Swal.fire(
            'Peringatan!',
            'Nilai Pada Total Dibayar Terlalu Besar!',
            'warning'
            )
        }else{
        var hasil = total_pembayaran - total_dibayar;
    // var Difference_In_Days =Math.floor( hasil / (1000 * 3600 * 24));
    console.log(hasil)
    var status = "Angsur";
    
    if (hasil < 1) {
     var status = "Lunas";

    }
        
        $.ajax({
            url:url,
            method:"post",
            data:{
                id_siswa:id_siswa,
                id_pembayaran:id_pembayaran,
                nama_pembayaran:nama_pembayaran,
                total_dibayar:total_dibayar,
                admin:admin,
                id_siswa:id_siswa,
                status:status,
                dibayar:cicil 
            },
            success:function(res){
                Swal.fire("Sukses","Berhasil Dicicil","success");
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
function simpanIuran(){
        
        
        var nama_pembayaran = $('#nama_pembayaran').val();
        var total_pembayaraninput = $('#total_pembayaran').val();
        var total_pembayaran = parseInt(total_pembayaraninput.replace(/\./g,""));
        var admin = $('#admin').val();
        
        var url           = "<?= BASE_URL; ?>back/iuran/simpan_iuran.php";
       if (id_siswa == "") {       
             Swal.fire("Peringatan","NISN  tidak boleh kosong","warning");        
          return;        
        }if (nama_pembayaran == "") {    
            Swal.fire("Peringatan","Nama Iuran tidak boleh kosong","warning");             
            return;         
        }else if (total_pembayaraninput == "") {             
            Swal.fire("Peringatan","Total Iuran tidak boleh kosong","warning");            
            return;         
        }else if (admin == "") {             
            Swal.fire("Peringatan","Admin tidak boleh kosong","warning");             
            return;         
        }
        var status = "Angsur";
        
        $.ajax({
            url:url,
            method:"post",
            data:{
                id_siswa:id_siswa,
                nama_pembayaran:nama_pembayaran,
                total_pembayaran:total_pembayaran,
                admin:admin,
                status:status
                
            },
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

     function handleEdit(row){
        var select_row = (JSON.parse(atob(row)))
        id_pembayaran = select_row.id_pembayaran;
        console.log(select_row.nama_pembayaran);
        //  namaKelas
        $('#n_pembayaran').val(select_row.nama_pembayaran);
        $('#t_pembayaran').val(select_row.total_pembayaran);
        $('#t_dibayar').val(select_row.total_dibayar);
        bukaModal4();

    }
    function simpanEdit(){
        
        var n_pembayaran = $('#n_pembayaran').val();
        var t_pembayaraninput = $('#t_pembayaran').val();
        var t_pembayaran = parseInt(t_pembayaraninput.replace(/\./g,""));
        var t_dibayarinput  =   $('#t_dibayar').val();
        var t_dibayar = parseInt(t_dibayarinput.replace(/\./g,""));
        var admin = $('#admin').val();
        
        var url           = "<?= BASE_URL; ?>back/iuran/edit_iuran.php";
       if (n_pembayaran == "") {    
            Swal.fire("Peringatan","Nama Iuran tidak boleh kosong","warning");             
            return;         
        }else if (t_pembayaraninput == "") {             
            Swal.fire("Peringatan","Total Iuran tidak boleh kosong","warning");            
            return;         
        }else if (admin == "") {             
            Swal.fire("Peringatan","Admin tidak boleh kosong","warning");             
            return;         
        }
        if(t_dibayar > t_pembayaran){
            Swal.fire(
            'Peringatan!',
            'Nilai Pada Total Dibayar Terlalu Besar!',
            'warning'
            )
        }else{
        var hasil = t_pembayaran - t_dibayar;
    // var Difference_In_Days =Math.floor( hasil / (1000 * 3600 * 24));
    console.log(hasil)
    var status = "Angsur";
    
    if (hasil < 1) {
     var status = "Lunas";

    }
        
        $.ajax({
            url:url,
            method:"post",
            data:{
                id_pembayaran:id_pembayaran,
                nama_pembayaran:n_pembayaran,
                total_pembayaran:t_pembayaran,
                total_dibayar:t_dibayar,
                admin:admin,
                status:status
                
            },
            success:function(res){
                console.log(res);
                Swal.fire("Info!",res,"info");
                window.table.destroy();
                initTable()
                tutupModal4()
            },
            error:function(res){
                console.log(err);
            }
        })
    }

    }

    function handleHapus(id_pembayaran) {
           Swal.fire({
  title: 'Apa Anda Yakin?',
  text: "Anda tidak dapat mengembalikannya lagi!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Hapus Transaksi!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Dihapus!',
      'Transaksi telah dihapus!',
      'success'
    )
     $.ajax({
                    url:"<?= BASE_URL; ?>back/iuran/hapus_iuran.php",
                    method:"post",
                    data:{
                        id_pembayaran:id_pembayaran
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
        var duit = "Rp";
       window.table = $('#dataTable').DataTable( {

       "paging": true,
       "searching":true,
        "ajax": "<?= BASE_URL; ?>back/iuran/select_id.php?id_siswa=" + id_siswa,
        "columns": [

            { "data": "id_pembayaran" },
            { "data": "nama_pembayaran"},
            { "data": "tanggal_dibayar"},
            { "data": "total_dibayar"},
            { "data": "id_siswa"},
            <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") {?>
            { "data": "total_pembayaran"},
            { "data": "status"},
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
                    
                    return `<a href="<?= BASE_URL ?>view/record.php?pembayaran=${row.id_pembayaran}">${data}</a>`;
                },
                "targets": 1
            },
            {
              
                "render": function ( data, type, row ) {
                 
                  
                  var bayar = row.total_dibayar;
                   num1 = new Number(bayar).toLocaleString("id-ID");

                  return "Rp" + num1;
              },
              "targets": 3
            },
            {
              
                "render": function ( data, type, row ) {
                 
                  var total = row.total_pembayaran;
                  var bayar = row.total_dibayar;
                  var hasil = total - bayar;
                   num = new Number(hasil).toLocaleString("id-ID");

                  return "Rp" + num;
              },
              "targets": 4
            },
            {
              
                "render": function ( data, type, row ) {
                 
                  var total = row.total_pembayaran;
                  
                   num2 = new Number(total).toLocaleString("id-ID");

                  return "Rp" + num2;
              },
              "targets": 5
            },
            <?php if ($_SESSION['jabatan'] == "admin" OR $_SESSION['jabatan'] == "pengurus") {?>
           {
              
                "render": function ( data, type, row ) {
                   
                    return `<button class="btn btn-warning" onclick="handleBayar('${btoa(JSON.stringify(row))}')">Bayar</button>
                    <button class="btn btn-danger" onclick="handleHapus('${row.id_pembayaran}')">Hapus</button>
                    <button class="btn btn-info" onclick="handleEdit('${btoa(JSON.stringify(row))}')">Edit</button>`;
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

// $(document).ready(() => {
//         // selector by body 
//         $('body').scannerDetection({
//             onComplete:(nisn) => {
//                 // cek apakah yang di scan itu udah masuk apa belum
//                 $('#nisn').val(nisn)
//                 // cari buku ke server
//                 cariSiswa(nisn);
//                 console.log(nisn);
//                 // array js
//             }
//         })
//         // get angkatan
//         // getAngkatan();
//     })
//     function cariSiswa(nisn){
//         $.ajax({
//             url:"<?= BASE_URL; ?>back/siswa/select_id.php",
//             method:"POST",
//             data:{
//                 nisn:nisn
//             },
//             success:(data)=>{
//                 var parsing = JSON.parse(data);
//                 for(let k of parsing.data){
//                    $('#nama_siswa').text(k.nama_siswa)
//                 //    $('#penerbit_buku').html("<b>" + k.penerbit + "</b>")
//                 //    $('#pengarang_buku').text(k.pengarang)
//                 //    $('#tahun_buku').text(k.tahun)
//                    id_siswa = k.id_siswa
//                 }
//                 console.log(JSON.parse(data));
//             },
//             error:(e) => {
//                 console.log(e)
//             }
//         })
//     }

// // function getAngkatan() {
// //         $.ajax({
// //             url:"<?= BASE_URL; ?>back/angkatan/select_all.php",
// //             success:(data) => {
// //                 var parsing = JSON.parse(data);
// //                 for(let k of parsing.data){
// //                    $('#angkatan').append("<option value='" + k.id_angkatan + "'>" + k.tahun_angkatan + "</option>")
// //                 }
// //             },
// //             error:(e) => {
// //                 console.log(e)
// //                 alert("Gagal Menyambung")
// //             }
// //         })
// //     }

// //     function getKelas(){
// //         var id_angkatan = $('#angkatan').val();
        
// //        if (id_angkatan =="") {
// //         Swal.fire("Peringatan","Kelas Tidak Boleh Kosong","warning");
// //            return;
// //        }
// //         $.ajax({
// //             url:"<?= BASE_URL; ?>back/kelas/select_all.php",
// //             data:{
// //                 id_angkatan:id_angkatan
// //             },
// //             success:(data) => {
// //                 var parsing = JSON.parse(data);
// //                 for(let k of parsing.data){
// //                    $('#kelas').append("<option value='" + k.id_kelas + "'>" + k.nama_kelas + "</option>")
// //                 }
// //             },
// //             error:(e) => {
// //                 console.log(e)
// //                 alert("Gagal Menyambung")
// //             }
// //         })
// //     }


// //     function getSiswa(){
// //         var id_kelas = $('#kelas').val();
        
// //         // SELECT id_siswa as id, nama_siswa as label, id_siswa as value FROM siswa WHERE id_kelas = '$id_kelas'
// //        if (id_kelas =="") {
// //         Swal.fire("Peringatan","Siswa Tidak Boleh Kosong","warning");
// //            return;
// //        }
// //         $.ajax({
// //             url:"<?= BASE_URL; ?>back/siswa/select_all.php",
// //             data:{
// //                 id_kelas:id_kelas
// //             },
// //             success:(data) => {
// //                 var parsing = JSON.parse(data);
// //                 for(let k of parsing.data){
// //                    $('#siswa').append("<option value='" + k.id_siswa + "'>" + k.nama_siswa + "</option>")
// //                 }
// //             },
// //             error:(e) => {
// //                 console.log(e)
// //                 alert("Gagal Menyambung")
// //             }
// //         })
// //     }

</script>