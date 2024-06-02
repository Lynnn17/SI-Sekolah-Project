<?php
include '../koneksi.php';

$id_mapel    =   $_POST['id_mapel'];

if ($id_mapel  ==  "") {
    echo "ID Mapel Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("DELETE FROM mapel WHERE id_mapel='$id_mapel'");
    $insert     =    $conn->query("DELETE FROM guru WHERE id_mapel='$id_mapel'");
    echo "Delete Berhasil";
}
