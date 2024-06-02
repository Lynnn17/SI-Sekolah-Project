<?php
include '../koneksi.php';

$id_buku    =   $_POST['id_buku'];

if ($id_buku  ==  "") {
    echo "ID Buku Tidak Boleh Kosong";
} else {
    $delete    =    $conn->query("DELETE FROM buku WHERE id_buku='$id_buku'");
    echo "Delete Berhasil";
}
