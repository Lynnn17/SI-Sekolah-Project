<?php
include '../koneksi.php';

$id_record    =   $_POST['id_record'];
$id_pembayaran    = $_POST['id_pembayaran'];
$dibayar = $_POST['dibayar'];


if ($id_record ==  "") {
    echo "ID Record Tidak Boleh Kosong";
} else {
    $delete    =    $conn->query("DELETE FROM pembayaranrecord WHERE id_record='$id_record'");
    $update = $conn->query("UPDATE pembayaran SET total_dibayar =(total_dibayar-'$dibayar')  WHERE id_pembayaran='$id_pembayaran'");
    echo "Delete Berhasil";
}
