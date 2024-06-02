<?php
include '../koneksi.php';

$id_pembayaran    =   $_POST['id_pembayaran'];

if ($id_pembayaran  ==  "") {
    echo "ID Pembayaran Tidak Boleh Kosong";
} else {
    $delete    =    $conn->query("DELETE FROM pembayaran WHERE id_pembayaran='$id_pembayaran'");
    echo "Delete Berhasil";
}
