<?php
include '../koneksi.php';

$nama_guru =   $_POST['nama_guru'];
    $nik =   $_POST['nik'];
    $alamat =   $_POST['alamat'];
    $no_tlpn =   $_POST['no_tlpn'];
    $username =   $_POST['username'];
    $password =   $_POST['password'];
    $id_guru =   $_POST['id_guru'];
    $id_mmapel =   $_POST['id_mapel'];

    if($nama_guru  ==  "" or $nik == "" or $alamat == "" or $no_tlpn == "" or $username =="" or $password==""){
        echo "Input Tidak Boleh Kosong";
    }else{        
    $insert     =    $conn->query("UPDATE guru SET nama_guru = '$nama_guru',nik='$nik',alamat='$alamat',
    no_tlpn='$no_tlpn',username='$username',password='$password',id_mapel='$id_mapel'  WHERE id_guru='$id_guru'");
    echo "Update Berhasil";
}
