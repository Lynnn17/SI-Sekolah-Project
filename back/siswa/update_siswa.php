<?php
include '../koneksi.php';

$id_siswa        =   $_POST['id_siswa'];
$nama_siswa      =   $_POST['nama_siswa'];
$alamat          =   $_POST['alamat'];
$no_tlpn         =   $_POST['no_tlpn'];
$id_kelas        =   $_POST['id_kelas'];
$jenis_kelamin        =   $_POST['jenis_kelamin'];
$nisn        =   $_POST['nisn'];

if ($id_siswa == ""  or  $nama_siswa  ==  ""   or    $alamat  ==  ""   or     $no_tlpn  == ""   or
    $id_kelas  == "" OR $jenis_kelamin =="" OR $nisn == "")
{
    echo "Input Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("UPDATE siswa SET nama_siswa = '$nama_siswa',alamat = '$alamat',
      no_tlpn = '$no_tlpn',id_kelas = '$id_kelas',jenis_kelamin='$jenis_kelamin',nisn='$nisn' WHERE id_siswa='$id_siswa'");

    echo "Update Berhasil";
}

