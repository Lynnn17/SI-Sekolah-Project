<?php

    include '../koneksi.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    // select 
    $db       = $conn->query("SELECT * FROM userperpustakaan WHERE username ='$username'");
    $data     = result($db);
    
    // check username
    if (count($data) == 0) {
        echo "Username tidak ditemukkan";
        exit();
    }

    $password_db    =   $data[0]['password'];

    if (password_verify($password,$password_db) === FALSE) {
        echo "Password Salah";
        exit();
    }

    // sesi
    session_start();
    // php sesi
    $_SESSION["id_user"]  =   $data[0]["id_user"];
    $_SESSION["username"]  =   $data[0]["username"];
    $_SESSION["nama_user"]  =   $data[0]["nama_user"];
    $_SESSION["alamat"]  =   $data[0]["alamat"];
    $_SESSION["jenis_kelamin"]  =   $data[0]["jenis_kelamin"];
    $_SESSION["no_tlpn"]    =   $data[0]["no_tlpn"];
    $_SESSION["jabatan"]  =   $data[0]["jabatan"];

    echo "Login Berhasil";