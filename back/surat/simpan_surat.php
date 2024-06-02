<?php
include '../koneksi.php';


    $foto = $_FILES['file']['name'];
    $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
   
    // if($ext != 'jpg' && $ext != 'png' && $ext != 'pdf'){
    //     echo "File Harus berformat jpg/png/pdf";
    //     exit;
    // }
    $filename = date('dmyhis').'.'.$ext;
    $lokasi = $_FILES['file']['tmp_name'];
    $folder = "../../assets/uploads/surat/";
    $upload = move_uploaded_file($lokasi, $folder.$filename);

date_default_timezone_set('Asia/Jakarta');
$no_surat           =   $_POST['no_surat'];
$nama_surat         =   $_POST['nama_surat'];
$jenis_surat        =   $_POST['jenis_surat'];
$diperuntukkan          =   $_POST['diperuntukkan'];
$tanggal         =    date("Y-m-d H:i:s");
$admin       =   $_POST['admin'];

if ($admin  ==  ""  or  $no_surat  == "" or  $jenis_surat  == "" or  $nama_surat  == ""
or  $foto  == "" or  $diperuntukkan  == "") 
{
    echo "Input Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("INSERT INTO surat(no_surat,nama_surat,jenis_surat,file,diperuntukkan,tanggal,admin) 
    VALUES ('$no_surat','$nama_surat','$jenis_surat','$filename','$diperuntukkan','$tanggal','$admin')");
    echo "Insert Berhasil";
}



    