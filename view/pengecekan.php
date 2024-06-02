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
        <?php include "V_sidebaraudit.php";?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            <?php include "V_topbar.php" ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Auditor</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Cek Data</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="form-group form-inline">
                            <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">NISN</span>
  </div>
  <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Scan NISN disini" aria-label="Username" aria-describedby="basic-addon1" autocomplete = "off">
</div>
            <!-- <h5 id="mbuh"></h5> -->
        </div>
                               <div class="data"></div>
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
        <h5 class="modal-title" id="exampleModalLabel">Input Angkatan</h5>
     
      </div>
      <div class="modal-body">
        <div class="form-group">
             <label>Tahun Angkatan:</label>
            <input type="text" class="form-control form-control-user" id="tahunAngkatan" placeholder="Tahun Angkatan">
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
    <!-- Modal 2-->
<div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input NISN</h5>
     
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Nis Siswa:</label>
            <input class="form-control" type="text" value="" aria-label="readonly input example" id="nisn" readonly>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="tutupModal2()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="cek()">Cek</button>
      </div>
    </div>
  </div>
</div>

</body>
<script type="text/javascript">
    $(document).ready(function() {
        // initTable()
        // load_data();
        function load_data(keyword)
        {
            $.ajax({
                method:"POST",
                url:"cekdata.php",
                data: { keyword:keyword},
                success:function(hasil)
                {
                    $('.data').html(hasil);
                }
            });
        }
        $('#nisn').keypress(function(){
            setTimeout(function(){
                var keyword = $("#nisn").val();
                load_data(keyword);
            },500
            )
            // var keyword = $("#nisn").val();
            // load_data(keyword);
        });
        $('#nisn').change(function(){
            var keyword = $("#nisn").val();
            load_data(keyword);
        });
    } );
    var id_angkatan = "";
    var id_siswa = "";
    var id_buku = "";
    var status      = "INSERT"


    function bukaModal(){
        $('#exampleModal').modal('show');
    }
    function tutupModal(){
        $('#exampleModal').modal('hide');
    }
    function bukaModal2(){
        $('#Modal2').modal('show');
    }
    function tutupModal2(){
        $('#Modal2').modal('hide');
    }
    function Cekdata() {
        bukaModal2()
    }
    $(document).ready(() => {
        // selector by body 
        $('body').scannerDetection({
            onComplete:(nisn) => {
                // cek apakah yang di scan itu udah masuk apa belum
                $('#nisn').val(nisn)
                // cari buku ke server
                cariBuku(nisn);
                console.log(nisn);
                // array js
            }
        })
        // getAngkatan();
    })
    function cariBuku(nisn){
        console.log(nisn)
        $.ajax({
            url:"<?= BASE_URL; ?>back/siswa/select_id.php",
            method:"POST",
            data:{
                nisn:nisn
            },
            success:(data)=>{
                var parsing = JSON.parse(data);
                for(let k of parsing.data){
                   $('#nisn').val(k.id_siswa)
                }
                console.log(JSON.parse(data));
            },
            error:(e) => {
                console.log(e)
            }
        })
    }
    function simpanData(){
        var tahunAngkatan = $('#tahunAngkatan').val();
        var url           = "<?= BASE_URL; ?>back/angkatan/insert_angkatan.php";

        if(status == "UPDATE"){
            url           = "<?= BASE_URL; ?>back/angkatan/update_angkatan.php"
        }

        if (tahunAngkatan == "") {
            Swal.fire("Peringatan","Tahun Angkatan tidak boleh kosong","warning");
            return;
        }
        $.ajax({
            url:url,
            method:"post",
            data:{
                tahun_angkatan:tahunAngkatan,
                id_angkatan:id_angkatan
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
    function insertAngkatan() {
        // body...
        $('#tahunAngkatan').val("")
        status = "INSERT";
        bukaModal();
    }
    function handleEdit(row){
        var select_row = (JSON.parse(atob(row)))
        id_angkatan = select_row.id_angkatan;
        //  tahunAngkatan
        $('#tahunAngkatan').val(select_row.tahun_angkatan);
        status  = "UPDATE"
        bukaModal();
        

    }
    function handleHapus(id_angkatan) {
        Swal.fire({
        title: 'Apa Anda Yakin?',
        text: "Anda tidak dapat mengembalikannya lagi!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus Angkatan!'
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Dihapus!',
            'Angkatan telah dihapus!',
            'success'
            )
                 $.ajax({
                    url:"<?= BASE_URL; ?>back/angkatan/delete_angkatan.php",
                    method:"post",
                    data:{
                        id_angkatan:id_angkatan
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
        "ajax": "<?= BASE_URL; ?>back/angkatan/select_all.php",
        "columns": [
            { "data": "id_angkatan" },
            { "data": "tahun_angkatan" },
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
            {
              
                "render": function ( data, type, row ) {
                    
                    return `<a href="<?= BASE_URL ?>view/kelasaudit.php?angkatan=${row.id_angkatan}">${data}</a>`;
                },
                "targets": 1
            },
            <?php if ($_SESSION['jabatan'] == "admin") {?>
           {
              
                "render": function ( data, type, row ) {
                   
                    return `<button class="btn btn-warning" onclick="handleEdit('${btoa(JSON.stringify(row))}')">Edit</button>
                    <button class="btn btn-danger" onclick="handleHapus('${row.id_angkatan}')">Hapus</button>`;
                },
                "targets": 2
            },
            <?php };?>
           
        ]
    } );
    }
</script>
</html>