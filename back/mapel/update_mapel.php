<?php
include '../koneksi.php';

$nama_mapel =   $_POST ['nama_mapel'];
$id_mapel    =   $_POST ['id_mapel'];
if ($nama_mapel  ==  "" OR $id_mapel == "") {
    echo "Input Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("UPDATE mapel SET nama_mapel = '$nama_mapel'  WHERE id_mapel='$id_mapel'");
    echo "Update Berhasil";
}
