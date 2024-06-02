<?php
include "../koneksi.php";

$id_siswa    =   $_GET['id_siswa'];

$db     = $conn->query("SELECT * FROM pembayaran WHERE id_siswa = '$id_siswa'");
$result = result($db);
echo json_encode(array(
            "data" => $result,
             "draw" => 1,
  "recordsTotal" => count($result),
  "recordsFiltered" => count($result),
            )    
        );
