<?php
include '../koneksi.php';

$nama_iuran = $_POST ['nama_iuran'];
$jumlah = $_POST ['jumlah'];
$id_angkatan = $_POST ['id_angkatan'];
$id_diuran = $_POST ['id_diuran'];

if ($nama_iuran  ==  ""  or  $jumlah  == "" OR $id_angkatan == "") {
echo "Input Tidak Boleh Kosong";
} else {
    $sql = $conn->query("UPDATE diuran set nama_iuran='$nama_iuran', jumlah='$jumlah',
    id_angkatan='$id_angkatan' where id_diuran='$id_diuran'");
    echo "Update berhasil";
}

        