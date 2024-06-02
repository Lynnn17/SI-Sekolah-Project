<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');
$total_dibayar      =   "0";
$nama_pembayaran          = $_POST['nama_pembayaran'];
$tanggal_dibayar         =    date("Y-m-d H:i:s");
$total_pembayaran        =  $_POST['total_pembayaran'];

$admin       =  $_POST['admin'];
$status       =  $_POST['status'];
// $dibayar      =   $_POST['dibayar'];
$id_angkatan = $_POST['id_angkatan'];
if ($admin  ==  ""  or  $total_dibayar  == "" or  $nama_pembayaran  == ""
or  $status  == "" or  $total_pembayaran  == "") 
{
    echo "Input Tidak Boleh Kosong";
}else {
$id_siswa = $conn->query("SELECT siswa.id_siswa FROM kelas INNER JOIN siswa ON kelas.id_kelas = siswa.id_kelas WHERE kelas.id_angkatan = '$id_angkatan'");
$result = result($id_siswa);
$value = [];
foreach ($result as $k) {
	$id_siswa = $k['id_siswa'];
	$value[] = "('$id_siswa','$total_dibayar','$nama_pembayaran','$tanggal_dibayar','$total_pembayaran','$admin','$status')";
}

$query = "INSERT INTO pembayaran (id_siswa,total_dibayar,nama_pembayaran,tanggal_dibayar,total_pembayaran,admin,status) VALUES ".implode (',', $value);
$insert = $conn->query($query);
echo "Berhasil Disimpan!";
}
