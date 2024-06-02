<?php
include "../koneksi.php";

// $id_siswa    =   $_GET['id_siswa'];$id_buku    =   $_GET['id_buku'];

$db     = $conn->query("SELECT * FROM pembayaran INNER JOIN siswa ON pembayaran.id_siswa=siswa.id_siswa");
$result = result($db);
echo json_encode(array(
            "data" => $result,
             "draw" => 1,
  "recordsTotal" => count($result),
  "recordsFiltered" => count($result),
            )    
        );
