<?php
    include '../koneksi.php';

    $nama_guru =   $_POST['nama_guru'];
    $nik =   $_POST['nik'];
    $alamat =   $_POST['alamat'];
    $no_tlpn =   $_POST['no_tlpn'];
    $username =   $_POST['username'];
    $password =   $_POST['password'];

    if($nama_guru  ==  "" or $nik == "" or $alamat == "" or $no_tlpn == "" or $username =="" or $password==""){
        echo "Input Tidak Boleh Kosong";
    }else{
        $insert     =    $conn->query("INSERT INTO guru(nama_guru,alamat,nik,no_tlpn,username,password)
         VALUES ('$nama_guru','$alamat','$nik','$no_tlpn','$username','$password')");
        echo "Insert Berhasil";
    }
