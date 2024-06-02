<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');
$id_pembayaran          =   $_POST['id_pembayaran'];
$total_dibayar          =   $_POST['total_dibayar'];
$nama_pembayaran        =   $_POST['nama_pembayaran'];
$tanggal_dibayar        =    date("Y-m-d H:i:s");
$total_pembayaran       =   $_POST['total_pembayaran'];
$admin                  =   $_POST['admin'];
$status       =   $_POST['status'];
if ($admin  ==  ""  or   $nama_pembayaran  == "" 
or  $status  == "" or  $total_pembayaran  == "" or $tanggal_dibayar =="" 
or $total_dibayar == "") 
{
    echo "Input Tidak Boleh Kosong";
} else {    
  $sql = $conn->query("UPDATE pembayaran set tanggal_dibayar='$tanggal_dibayar',nama_pembayaran='$nama_pembayaran', 
           total_pembayaran='$total_pembayaran', total_dibayar='$total_dibayar', status='$status',admin='$admin' where id_pembayaran='$id_pembayaran'");

echo "Update Berhasil";
}
