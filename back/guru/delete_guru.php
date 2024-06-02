<?php
include '../koneksi.php';

$id_guru    =   $_POST['id_guru'];

if ($id_guru  ==  "") {
    echo "ID Guru Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("DELETE FROM guru WHERE id_guru='$id_guru'");
    echo "Delete Berhasil";
}
