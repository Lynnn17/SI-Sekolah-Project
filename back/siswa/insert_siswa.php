<?php
include '../koneksi.php';

$nama_siswa      =   $_POST['nama_siswa'];
$alamat          =   $_POST['alamat'];
$no_tlpn         =   $_POST['no_tlpn'];
$id_kelas        =   $_POST['id_kelas'];
$jenis_kelamin        =   $_POST['jenis_kelamin'];
$nisn        =   $_POST['nisn'];

if ($nama_siswa  ==  ""   OR    $alamat  ==  ""   OR     $no_tlpn  == ""   OR   $jenis_kelamin == "" OR
    $id_kelas  == "" OR $nisn=="") 
{
    echo "Input Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("INSERT INTO siswa(nama_siswa,alamat,no_tlpn,id_kelas,jenis_kelamin,nisn) 
    VALUES ('$nama_siswa','$alamat','$no_tlpn','$id_kelas','$jenis_kelamin','$nisn')");
    echo "Insert Berhasil";
}
