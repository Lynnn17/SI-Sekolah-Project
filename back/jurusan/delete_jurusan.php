<?php
include '../koneksi.php';

$id_jurusan    =   $_POST['id_jurusan'];

if ($id_jurusan  ==  "") {
    echo "ID Jurusan Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("DELETE FROM jurusan WHERE id_jurusan='$id_jurusan'");
    $insert     =    $conn->query("DELETE FROM guru WHERE id_jurusan='$id_jurusan'");
    echo "Delete Berhasil";
}
