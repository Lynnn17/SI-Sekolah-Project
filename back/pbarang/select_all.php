<?php
include "../koneksi.php";

// $id_siswa    =   $_GET['id_siswa'];$id_buku    =   $_GET['id_buku'];

$db     = $conn->query("SELECT * FROM pbarang INNER JOIN barang ON pbarang.id_barang=barang.id_barang");
$result = result($db);
echo json_encode(array(
            "data" => $result,
             "draw" => 1,
  "recordsTotal" => count($result),
  "recordsFiltered" => count($result),
            )    
        );

