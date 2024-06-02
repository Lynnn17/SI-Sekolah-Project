<?php
include "../koneksi.php";

$id_kelas    =  $_GET['id_kelas'];
$db     = $conn->query("SELECT id_siswa as id, nama_siswa as label, id_siswa as value FROM siswa WHERE id_kelas = '$id_kelas'");
$result     = result($db);
     echo json_encode(array(
            "data" => $result,
            "draw" => 1,
  "recordsTotal" => count($result),
  "recordsFiltered" => count($result),
            )    
        );
