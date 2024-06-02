<?php
include '../koneksi.php';

$id_kelas    =   $_POST['id_kelas'];

if ($id_kelas  ==  "") {
    echo "ID Kelas Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("DELETE FROM kelas WHERE id_kelas='$id_kelas'");
    
    echo "Delete Berhasil";
}
