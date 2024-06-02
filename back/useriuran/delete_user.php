<?php
include '../koneksi.php';

$id_user    =   $_POST['id_user'];

if ($id_user  ==  "") {
    echo "ID User Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("DELETE FROM useriuran WHERE id_user='$id_user'");
    echo "Delete Berhasil";
}
