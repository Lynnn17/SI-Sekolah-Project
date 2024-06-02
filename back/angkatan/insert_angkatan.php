<?php
    include '../koneksi.php';

    $tahun_angkatan =   $_POST['tahun_angkatan'];

    if($tahun_angkatan  ==  ""){
        echo "Tahun Angkatan Tidak Boleh Kosong";
    }else{
        $insert     =    $conn->query("INSERT INTO angkatan(tahun_angkatan) VALUES ('$tahun_angkatan')");
        echo "Insert Berhasil";
    }
