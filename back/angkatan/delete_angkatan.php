<?php
include '../koneksi.php';

$id_angkatan    =   $_POST['id_angkatan'];

if ($id_angkatan  ==  "") {
    echo "ID Angkatan Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("DELETE FROM angkatan WHERE id_angkatan='$id_angkatan'");
    $insert     =    $conn->query("DELETE FROM kelas WHERE id_angkatan='$id_angkatan'");
    echo "Delete Berhasil";
}
