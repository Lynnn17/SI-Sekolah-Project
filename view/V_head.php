<?php include 'core.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMKN PURWOSARI</title>

    <!-- Custom fonts for this template-->
    <link href="<?= BASE_URL; ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= BASE_URL; ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
	<script src="<?= BASE_URL; ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= BASE_URL; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/css/datatables.bootstrap5.min.css"/>
    
    
 
<script type="text/javascript" src="<?= BASE_URL; ?>assets/js/datatables.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?= BASE_URL; ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= BASE_URL; ?>assets/js/sb-admin-2.min.js"></script>
    <script src="<?= BASE_URL; ?>assets/js/jquery.mask.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= BASE_URL; ?>assets/js/jquery.scannerdetection.js"></script>
    <script src="<?= BASE_URL; ?>assets/js/jquery-ui.js"></script>
    <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/jquery-ui.css">

<style type="text/css">/*.jam-digital-malasngoding {
        
        width: 12vw;
            
    display: block;
    margin-left: auto;
    margin-right: auto;
   
        border-radius: 4px;
    }
    .kotak{
        float: left;
        width: 2vw;
        height: 2vh;
        
    }
    .jam-digital-malasngoding p {
        color: white;
        font-size: 20px;
        text-align: center;
        margin-top: 2vh;
    }
    #jarak {
        margin-top: 20px;
        font-size:2% ;
        text-align: center;
        color: white;
    }
    #jarak2 {
        margin-top: 20px;
        font-size: 25px;
        text-align: center;
        color: white;
    }
    */
    .nav-link:active {
        color: white;
    }
    .ui-front {
        z-index: 9999999 !important;
    }
    /* select#angkatan {
        width:75%;
    }
    select#kelas {
        width: 75%;
    }
    select#siswa {
        width: 75%;
    } */
    
    .smklogo {
            clear: both;
    display: block;
    margin-left: auto;
    margin-right: auto;
    
    }
</style>
<script>
 
    /** tambah class active jika di klik */
 
    var link = window.location;
 
// ini untuk menambahkan class active pada menu yg tidak memiliki anak atau single link
 
$('li.nav-item a.nav-link').filter(function() {
 
 return this.href == link;
 
}).parent().addClass('active');

// kanggo toggle seng neng side bar

$(document).ready(function(){
  $("#sidebarToggle").click(function(){
    $("#accordionSidebar").toggleClass("toggled");
  });
});
$(document).ready(function(){
  $("#sidebarToggleTop").click(function(){
    $("#accordionSidebar").toggleClass("toggled");
  });
});
// $(document).ready(function(){
//     $("select.form-select-sm-nama").change(function(){
//         var selectedNama = $(this).children("option:selected").val();
//         alert("You have selected the country - " + selectedNama);
//     });
// });
</script>
</head>

	<body style="background-image: url(<?= BASE_URL; ?>assets/img/bg.png); background-size: cover">

   
