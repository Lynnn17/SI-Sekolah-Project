<?php
include "../koneksi.php";

// $id_siswa    =   $_GET['id_siswa'];$id_buku    =   $_GET['id_buku'];

$db     = $conn->query("SELECT * FROM peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku INNER JOIN siswa ON peminjaman.id_siswa=siswa.id_siswa
INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas");
$result = result($db);
echo json_encode(array(
            "data" => $result,
             "draw" => 1,
  "recordsTotal" => count($result),
  "recordsFiltered" => count($result),
            )    
        );
