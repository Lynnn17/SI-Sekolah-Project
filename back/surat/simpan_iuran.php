<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');
$total_dibayar      =   $_POST['total_dibayar'];
$dibayar      =   $_POST['dibayar'];
$nama_pembayaran          =   $_POST['nama_pembayaran'];
$tanggal_dibayar         =    date("Y-m-d H:i:s");
$total_pembayaran        =   $_POST['total_pembayaran'];
$id_siswa        =   $_POST['id_siswa'];
$admin       =   $_POST['admin'];
$status       =   $_POST['status'];
if ($admin  ==  ""  or  $total_dibayar  == "" or  $nama_pembayaran  == "" or  $id_siswa  == ""
or  $status  == "" or  $total_pembayaran  == "") 
{
    echo "Input Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("INSERT INTO pembayaran(id_siswa,total_dibayar,nama_pembayaran,tanggal_dibayar,total_pembayaran,admin,status) 
    VALUES ('$id_siswa','$total_dibayar','$nama_pembayaran','$tanggal_dibayar','$total_pembayaran','$admin','$status')");
    $insert2     =    $conn->query("INSERT INTO pembayaranrecord(id_siswa,total_dibayar,dibayar,nama_pembayaran,tanggal_dibayar,total_pembayaran,admin,status) 
    VALUES ('$id_siswa','$total_dibayar','$dibayar','$nama_pembayaran','$tanggal_dibayar','$total_pembayaran','$admin','$status')");
    echo "Insert Berhasil";
}
