<?php
include '../koneksi.php';

$id_siswa    =   $_POST['id_siswa'];

if ($id_siswa  ==  "") {
    echo "ID Siswa Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("DELETE FROM siswa WHERE id_siswa='$id_siswa'");
    echo "Delete Berhasil";
}
