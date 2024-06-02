<?php
include '../koneksi.php';

$id_barang    =   $_POST['id_barang'];

if ($id_barang  ==  "") {
    echo "ID Barang Tidak Boleh Kosong";
} else {
    $delete    =    $conn->query("DELETE FROM barang WHERE id_barang='$id_barang'");
    echo "Delete Berhasil";
}
