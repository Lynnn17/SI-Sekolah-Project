<?php
include '../koneksi.php';

$tahun_angkatan =   $_POST ['tahun_angkatan'];
$id_angkatan    =   $_POST ['id_angkatan'];
if ($tahun_angkatan  ==  "" OR $id_angkatan == "") {
    echo "Tahun Angkatan Dan Id Angkatan Tidak Boleh Kosong";
} else {
    $insert     =    $conn->query("UPDATE angkatan SET tahun_angkatan = '$tahun_angkatan'  WHERE id_angkatan='$id_angkatan'");
    echo "Update Berhasil";
}
