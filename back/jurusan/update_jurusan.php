<?php
include '../koneksi.php';

$nama_jurusan =   $_POST ['nama_jurusan'];
$id_jurusan    =   $_POST ['id_jurusan'];
if ($nama_jurusan  ==  "" OR $id_jurusan == "") {
    echo "Input Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("UPDATE jurusan SET nama_jurusan = '$nama_jurusan'  WHERE id_jurusan='$id_jurusan'");
    echo "Update Berhasil";
}
