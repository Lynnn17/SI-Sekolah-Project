<?php
include "../koneksi.php";

$id_siswa    =   $_GET['id_siswa'];

$db     = $conn->query("SELECT * FROM peminjaman.id_peminjaman,siswa.nama_siswa, COUNT(peminjaman.id_peminjaman) as Jumlah_buku 
FROM peminjaman INNER JOIN siswa 
ON peminjaman.id_siswa = siswa.id_siswa 
GROUP BY siswa.id_siswa");
$result     = result($db);
 echo json_encode(array(
            "data" => $result,
             "draw" => 1,
  "recordsTotal" => count($result),
  "recordsFiltered" => count($result),
            )    
        );