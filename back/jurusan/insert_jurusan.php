<?php
    include '../koneksi.php';

    $nama_jurusan =   $_POST['nama_jurusan'];

    if($nama_jurusan  ==  ""){
        echo "Nama Jurusan Tidak Boleh Kosong";
    }else{
        $insert     =    $conn->query("INSERT INTO jurusan(nama_jurusan) VALUES ('$nama_jurusan')");
        echo "Insert Berhasil";
    }
