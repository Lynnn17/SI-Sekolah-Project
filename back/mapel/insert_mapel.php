<?php
    include '../koneksi.php';

    $nama_mapel =   $_POST['nama_mapel'];

    if($nama_mapel  ==  ""){
        echo "Nama Mapel Tidak Boleh Kosong";
    }else{
        $insert     =    $conn->query("INSERT INTO mapel(nama_mapel) VALUES ('$nama_mapel')");
        echo "Insert Berhasil";
    }
