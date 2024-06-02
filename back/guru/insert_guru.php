<?php
include '../koneksi.php';

$nama_guru      =   $_POST['nama_guru'];
$nik            =   $_POST['nik'];
$alamat          =   $_POST['alamat'];
$no_tlpn         =   $_POST['no_tlpn'];
$id_jurusan        =   $_POST['id_jurusan'];
$jenis_kelamin =  $_POST['jenis_kelamin'];

if ($nama_guru  ==  ""   OR    $alamat  ==  ""   OR     $no_tlpn  == ""   OR $jenis_kelamin =="" OR  
    $id_jurusan  == "" OR    $nik  == "") 
{
    echo "Input Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("INSERT INTO guru(nama_guru,nik,alamat,no_tlpn,id_jurusan,jenis_kelamin) 
    VALUES ('$nama_guru','$nik','$alamat','$no_tlpn','$id_jurusan','$jenis_kelamin')");
    echo "Insert Berhasil";
}
