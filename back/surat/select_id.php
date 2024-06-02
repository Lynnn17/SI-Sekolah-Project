<?php
include "../koneksi.php";

$id_siswa    =   $_GET['id_siswa'];

$db     = $conn->query("SELECT * FROM peminjaman INNER JOIN buku ON peminjaman.id_buku=id_buku
         WHERE peminjaman.id_siswa= '$id_siswa'");

echo json_encode(result($db));
