<?php
include '../koneksi.php';

$nama_kelas     =   $_POST['nama_kelas'];
$id_angkatan    =   $_POST['id_angkatan'];

if ($nama_kelas  ==  ""  OR   $id_angkatan  ==  "") {
    echo "Nama Kelas Dan ID Angkatan Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("INSERT INTO kelas(nama_kelas,id_angkatan) VALUES ('$nama_kelas','$id_angkatan')");
    echo "Insert Berhasil";
}
