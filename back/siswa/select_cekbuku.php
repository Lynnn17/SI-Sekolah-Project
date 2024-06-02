<?php
include "../koneksi.php";


$id_siswa    =  $_GET['id_siswa'];
$db = $conn->query("SELECT buku.judul, siswa.nama_siswa, siswa.id_siswa, peminjaman.status
                    ,peminjaman.tgl_pinjam,peminjaman.tgl_kembali FROM 
                    peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku 
                    INNER JOIN siswa ON siswa.id_siswa = peminjaman.id_siswa
                    WHERE peminjaman.id_siswa = '$id_siswa' AND peminjaman.status = 'Pinjam'  
                    ");
$result     = result($db);
echo json_encode(
    array(
        "data" => $result,
        "draw" => 1,
        "recordsTotal" => count($result),
        "recordsFiltered" => count($result),
    )
);
