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
                    <h1 class="h3 mb-2 text-gray-800">Data Peminjaman Barang</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Isi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                
                                <button type="button" class="btn btn-primary" onclick="InsertPinjam()">
                              Input Pinjam
                                </button>
                                <button type="button" class="btn btn-success ml-4" onclick="BukaLaporan()">
                              Laporan Peminjaman
                                </button>
                                <br>
                                <br>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Nama Barang</th>
                                            <th>Nama Peminjam</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Kondisi Dipinjam</th>
                                            <th>Kondisi Dikembalikan</th>
                                            <th>Barang Dikembalikan</th>
                                            <th>Status</th>
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
            <label>Kode Barang/Nama Barang:</label>
            <input class="form-control" type="text" value="" aria-label="readonly input example" id="scan" readonly>
            <br>
             <input class="form-control" type="text" value="" onclick="getBarang()" aria-label="readonly input example" id="ac" >
        </div>
          </div>
          <div class="col-md-6">
          <h5>Detail</h5><hr>
          Nama Barang : <span id="nama_barang"></span>
          <br>
          Sumber Barang : <span id="sumber_barang"></span>
          <hr>
          </div>
        </div>  
        <div class="row">
        <div class="col-md-6">
        <!-- <h5>Nama Peminjam</h5>
        <div class="input-group mb-3 mt-2">
        
                     <label class="input-group-text" for="inputGroupSelect01">Pilihan</label>
                 <select onchange="getKelas()"  class="form-select-sm" id="angkatan" >
                    <option  selected>Pilih Angkatan</option>
    
                 </select>
            </div> -->
            <label>Nama Peminjam:</label>
            <input class="form-control" type="text" value="" aria-label="readonly input example" id="nama_peminjam" >
        </div>
        
        <div class="col-md-6">
        <table>
           <tbody>
               <!-- <tr>
                   <td>Nama Barang</td>
                   <td>:</td>
                   <td id="nama_barang"></td>
               </tr>
               <tr> -->
                    <!-- <td>Sumber Barang</td>
                    <td>:</td>
                    <td id="sumber_barang"></td> -->
                </tr>
           </tbody>
       </table>
        </div>

        </div> 
       <!-- <div class="row">
           <div class="col-md-6">
           <h5></h5>
           <div class="input-group mb-3 mt-2">
           
           <label class="input-group-text" for="inputGroupSelect02">Pilihan</label>
    <select name="" class="form-select-sm" onchange="getSiswa()" id="kelas">
        
    </select>
           </div>
           </div>
       </div> -->
       <!-- <div class="row">
           <div class="col-md-6">
       <h5>Nama Siswa</h5>
       <div class="input-group mb-3 mt-2">
       <label class="input-group-text" for="inputGroupSelect02">Pilihan</label>
            <input type="text"  class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="ac">
       </div>
    </div>
       </div> -->
        <div class="row"><div class="col-md-6">
        <label>Jumlah Hari:</label>
        <div class="input-group mb-1 mt-1">
                 <label class="input-group-text" for="inputGroupSelect04">Pilihan</label>
            
                <input type="number" min="1" class="form-control" placeholder="" aria-label="Username" id="jumlah_hari" aria-describedby="basic-addon1">
       
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
    <label>Kondisi Dipinjam:</label>
        <div class="input-group mb-1 mt-1">
                 <label class="input-group-text" for="inputGroupSelect04">Pilihan</label>
                 <select class="form-control" aria-label="" id="kondisi_dipinjam">
                 <option selected>Kondisi</option>
                 <option value="Baik">Baik</option>
                 <option value="Rusak">Rusak</option>
                 </select>
            </div>
        </div>
        </div>

            
            <!-- <div>

    <select name="" onchange="getKelas()" id="angkatan" >
        <option value="">Pilih Angkatan</option>
    </select>

    </div>         -->
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
        <h5 class="modal-title" id="ModalLabel">Laporan Peminjaman Barang</h5>
     
      </div>
      <div class="modal-body">     
        <div class="form-group"><form method="POST" action="../back/excel/report_pbarang_hari.php"  >
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
    var id_barang = ""
    var id_siswa =""
    var id_pbarang=""

    
    function bukaModal1 (){
         $('#Modal1').modal('show');
         $('#scan').val("");
         $('#ac').val("");
         $('#nama_barang').text("");
         $('#sumber_barang').text("");
         $('#nama_peminjam').val("");
         $('#jumlah_hari').val("");
         $('#kondisi_dipinjam').val("Kondisi");
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
    
    function InsertPinjam() {
        bukaModal1();
    }
    function BukaLaporan(){
        bukaModal3();
    }
    // ketika klik btn modal tambah
    
    function handlePanjang(row){
        $('#jumlah_panjang').val("")
        var select_row = (JSON.parse(atob(row)))
         id_pbarang = select_row.id_pbarang;
         status = select_row.status
        if(status == "Kembali"){
            Swal.fire("Peringatan","Barang sudah dikembalikan","warning");
            return false;
        }
         bukaModal2();

     }
    function simpanPanjang () {
        console.log(id_pbarang);
        id_pbarang = id_pbarang;
        var pinjam_hari = $('#jumlah_panjang').val();
       
  var url           = "<?= BASE_URL; ?>back/pbarang/simpan_perpanjangan.php";
        
        $.ajax({
            url:url,
            method:"post",
            data:{
                id_pbarang:id_pbarang,
                pinjam_hari:pinjam_hari, 
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
// function handleKondisi(row){
//         $('#kondisi_dikembalikan').val("")
//         var select_row = (JSON.parse(atob(row)))
//          id_pbarang = select_row.id_pbarang;
//          id_barang = select_row.id_barang;
        
//          bukaModal3();

//      }

async function handleKembali(id_pbarang,tanggal_kembali,id_barang,barang_dikembalikan) {
    
    console.log(id_pbarang)
    console.log(tanggal_kembali)
    console.log(barang_dikembalikan)
    if(barang_dikembalikan == "null"){
    var tanggal1 = new Date(tanggal_kembali + ' 23:59:59')
    console.log(tanggal1)
    var tanggal2 = new Date()
    var hasil = tanggal1.getTime() - tanggal2.getTime();
    var Difference_In_Days =Math.floor( hasil / (1000 * 3600 * 24));
    console.log(Difference_In_Days)
    var status = "Kembali"
    
    if (hasil < 0) {
        status="Terlambat"
    }

        //   var r = confirm("Buku Dikembalikan?");
        //       if (r == true) {
            const res = await Swal.fire({
  title: 'Pilih Kondisi Barang',
  input: 'select',
  inputOptions: {
   
      Baik: 'Baik',
      Rusak: 'Rusak'
    },
  inputPlaceholder: 'Silahkan Pilih Kondisi Barang',
  showCancelButton: true,
  inputValidator: (value) => {
    return new Promise((resolve) => {
      if (value === '') {
        resolve('Anda Harus Memilih  Kondisi :)')
      }else{
          resolve()
      }
    })
  }
})

console.log(res)
if(res.isConfirmed){
                 $.ajax({
                    url:"<?= BASE_URL; ?>back/pbarang/simpan_kembali.php",
                    method:"post",
                    data:{
                        id_pbarang:id_pbarang,
                        id_barang:id_barang,
                        status:status,
                        kondisi_dikembalikan:res.value
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
            }
        }else{
            Swal.fire(
                'INFO!',
                'Barang Telah Dikembalikan!',
                'info'
                )
        }
    }
    function initTable() {
        var nomor = 1;
       window.table = $('#dataTable').DataTable( {

       "paging": true,
       
        "ajax": "<?= BASE_URL; ?>back/pbarang/select_all.php",
        "columns": [
            { "data": "id_pbarang" },
            { "data": "nama_barang" },
            { "data": "nama_peminjam"},
            { "data": "tgl_pinjam"},
            { "data": "tgl_kembali"},
            { "data": "kondisi_dipinjam"},
            { "data": "kondisi_dikembalikan"},
            { "data": "barang_dikembalikan"},
            { "data": "status"},
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
                   
                    return `<button class="btn btn-warning" onclick="handlePanjang('${btoa(JSON.stringify(row))}')">Perpanjang</button>
                    <button class="btn btn-danger" onclick="handleKembali('${row.id_pbarang}','${row.tgl_kembali}','${row.id_barang}','${row.barang_dikembalikan}')">Kembali</button>`;
                },
                "targets": 9
            },
           
        ]
    }  );
    }
    
var list_barang   = [];
    // dokumen ketika sudah di load
    $(document).ready(() => {
        // selector by body 
        $('body').scannerDetection({
            onComplete:(kode_barang) => {
                // cek apakah yang di scan itu udah masuk apa belum
                $('#scan').val(kode_barang)
                // cari buku ke server
                caribarang(kode_barang);
                console.log(kode_barang);
                // array js
            }
        })

        // get angkatan
        // getAngkatan();
    })

    function caribarang(kode_barang){
        $.ajax({
            url:"<?= BASE_URL; ?>back/barang/select_id.php",
            method:"POST",
            data:{
                kode_barang:kode_barang
            },
            success:(data)=>{
                var parsing = JSON.parse(data);
                for(let k of parsing.data){
                   $('#nama_barang').text(k.nama_barang)
                   $('#sumber_barang').html("<b>" + k.sumber + "</b>")
                //    $('#pengarang_buku').text(k.pengarang)
                //    $('#tahun_buku').text(k.tahun)
                   id_barang = k.id_barang
                }
                console.log(JSON.parse(data));
            },
            error:(e) => {
                console.log(e)
            }
        })
    }

    // function getAngkatan() {
    //     $.ajax({
    //         url:"<?= BASE_URL; ?>back/angkatan/select_all.php",
    //         success:(data) => {
    //             var parsing = JSON.parse(data);
    //             for(let k of parsing.data){
    //                $('#angkatan').append("<option value='" + k.id_angkatan + "'>" + k.tahun_angkatan + "</option>")
    //             }
    //         },
    //         error:(e) => {
    //             console.log(e)
    //             alert("Gagal Menyambung")
    //         }
    //     })
    // }

    // function getKelas(){
    //     var id_angkatan = $('#angkatan').val();
    //     $('#kelas').html("<option value=''>Pilih Kelas</option>");
    //    if (id_angkatan =="") {
    //        return;
    //    }
    //     $.ajax({
    //         url:"<?= BASE_URL; ?>back/kelas/select_all.php",
    //         data:{
    //             id_angkatan:id_angkatan
    //         },
    //         success:(data) => {
    //             var parsing = JSON.parse(data);
    //             for(let k of parsing.data){
    //                $('#kelas').append("<option value='" + k.id_kelas + "'>" + k.nama_kelas + "</option>")
    //             }
    //         },
    //         error:(e) => {
    //             console.log(e)
    //             alert("Gagal Menyambung")
    //         }
    //     })
    // }

    // function getSiswa(){
    //     var id_kelas = $('#kelas').val();
    //     // SELECT id_siswa as id, nama_siswa as label, id_siswa as value FROM siswa WHERE id_kelas = '$id_kelas'
    //    if (id_kelas =="") {
    //        return;
    //    }
    //     $.ajax({
    //         url:"<?= BASE_URL; ?>back/peminjaman/select_siswaac.php",
    //         data:{
    //             id_kelas:id_kelas
    //         },
    //         success:(data) => {
    //             $( "#ac" ).autocomplete({
    //                 source: JSON.parse(data),
    //                 select: function( event, ui ) {
    //                     $('#detail_nama').text(ui.item.label)
    //                     id_siswa = ui.item.id
    //                 }
    //             });
    //             console.log(data);
    //         },
    //         error:(e) => {
    //             console.log(e)
    //             alert("Gagal Menyambung")
    //         }
    //     })
    // }
    
    function simpanPinjam(){
        
        var pinjam_hari = $('#jumlah_hari').val();
        var nama_peminjam = $('#nama_peminjam').val();
        var kondisi_dipinjam = $('#kondisi_dipinjam').val();
        
        
        var url           = "<?= BASE_URL; ?>back/pbarang/simpan_peminjaman.php";
        if (id_barang == "") {
            Swal.fire("Peringatan","Kode Barang tidak boleh kosong","warning");
            return;
        } if (nama_peminjam == "") {
            Swal.fire("Peringatan","Nama Peminjam tidak boleh kosong","warning");
            return;
        }if (pinjam_hari == "") {
            Swal.fire("Peringatan","Jumlah Hari tidak boleh kosong","warning");
            return;
        }if (kondisi_dipinjam == "Kondisi") {
            Swal.fire("Peringatan","Silahkan Pilih Salah Satu Kondisi","warning");
            return;
        }
        
        $.ajax({
            url:url,
            method:"post",
            data:{
                // id_guru:id_guru,
                pinjam_hari:pinjam_hari,
                nama_peminjam:nama_peminjam,
                kondisi_dipinjam:kondisi_dipinjam,
                id_barang:id_barang
                
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
    function getBarang(){
        // var id_kelas = $('#kelas').val();
        // SELECT id_siswa as id, nama_siswa as label, id_siswa as value FROM siswa WHERE id_kelas = '$id_kelas'
       // if (id_kelas =="") {
       //     return;
       // }
        $.ajax({
            url:"<?= BASE_URL; ?>back/barang/select_barang.php",
            success:(data) => {
                $( "#ac" ).autocomplete({
                    source: JSON.parse(data),
                    select: function( event, ui ) {
                        $('#nama_barang').text(ui.item.label),
                        $('#sumber_barang').text(ui.item.sumber)
                        id_barang = ui.item.id
                    }
                });
                console.log(data);
            },
            error:(e) => {
                console.log(e)
                alert("Gagal Menyambung")
            }
        })
    }
    
</script>