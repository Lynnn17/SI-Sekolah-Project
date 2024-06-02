<?php
include '../koneksi.php';

$id_surat    =   $_POST['id_surat'];
$filename    =   $_POST['filename'];
$folder = "../../assets/uploads/";

if ($id_surat  ==  "") {
    echo "ID Pembayaran Tidak Boleh Kosong";
} else {
    $delete    =    $conn->query("DELETE FROM surat WHERE id_surat='$id_surat'");
    unlink($folder.$filename);
    echo "Delete Berhasil";
}
