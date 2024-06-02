<?php
include '../koneksi.php';

$id_kelas       =   $_POST['id_kelas'];
$nama_kelas     =   $_POST['nama_kelas'];
$id_angkatan    =   $_POST['id_angkatan'];
if ($nama_kelas  ==  "" or $id_angkatan == "") {
    echo "Nama Kelas Dan Id Angkatan Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("UPDATE kelas SET nama_kelas = '$nama_kelas',id_angkatan = '$id_angkatan'  WHERE id_kelas='$id_kelas'");
    echo "Update Berhasil";
}
