<?php
include '../koneksi.php';
$options = [
    'cost' => 10,
];
$id_user         =   $_POST['id_user'];
$username        =   $_POST['username'];
$password        =   password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
$jabatan         =   $_POST['jabatan'];
$nama_user       =   $_POST['nama_user'];
$alamat          =   $_POST['alamat'];
$no_tlpn         =   $_POST['no_tlpn'];
$jenis_kelamin   =   $_POST['jenis_kelamin'];

if (
    $username  ==  ""   or    $password  ==  ""   or     $jabatan  == ""   or  $nama_user  == ""   or
    $alamat  == ""   or    $no_tlpn == ""    or    $jenis_kelamin  ==  ""
) {
    echo "Input Tidak Boleh Kosong";
} else {
    $insert =  $conn->query("UPDATE usersarpras SET username = '$username',password = '$password', jabatan = '$jabatan',
      nama_user = '$nama_user',alamat = '$alamat', no_tlpn = '$no_tlpn', no_tlpn = '$no_tlpn',
      jenis_kelamin = '$jenis_kelamin' WHERE id_user='$id_user'");

    echo "Update Berhasil";
}
