<?php
include '../koneksi.php';

$username        =   $_POST['username'];
$password        =   $_POST['password'];
$jabatan         =   $_POST['jabatan'];
$nama_user       =   $_POST['nama_user'];
$alamat          =   $_POST['alamat'];
$no_tlpn         =   $_POST['no_tlpn'];
$jenis_kelamin   =   $_POST['jenis_kelamin'];

if (
    $username  ==  ""   or    $password  ==  ""   or     $jabatan  == ""   or  $nama_user  == ""   or    
    $alamat  == ""   or    $no_tlpn == ""    or    $jenis_kelamin  ==  ""
) {
    echo "Input Tidak Boleh Kosong";
} else {
    $insert   = $conn->query("INSERT INTO user (username,password,jabatan,nama_user,alamat,no_tlpn,jenis_kelamin) 
    VALUES ('$username','$password','$jabatan','$nama_user','$alamat','$no_tlpn','$jenis_kelamin')");
    echo "Insert Berhasil";
}
