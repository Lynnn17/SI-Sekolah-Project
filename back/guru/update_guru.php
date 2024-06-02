<?php
include '../koneksi.php';

$nama_guru      =   $_POST['nama_guru'];
$nik            =   $_POST['nik'];
$alamat          =   $_POST['alamat'];
$no_tlpn         =   $_POST['no_tlpn'];
$id_jurusan        =   $_POST['id_jurusan'];
$id_guru        =   $_POST['id_guru'];
$jenis_kelamin =  $_POST['jenis_kelamin'];


if ($nama_guru  ==  ""   OR    $alamat  ==  ""   OR     $no_tlpn  == ""   OR   $jenis_kelamin == "" OR
    $id_jurusan  == "" OR     $nik  == "") 
{
    echo "Input Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("UPDATE guru SET nama_guru = '$nama_guru',alamat = '$alamat',
      no_tlpn = '$no_tlpn',id_jurusan = '$id_jurusan',nik = '$nik',
      jenis_kelamin = '$jenis_kelamin' WHERE id_guru='$id_guru'");

    echo "Update Berhasil";
}

