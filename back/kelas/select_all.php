<?php
    include "../koneksi.php";
    
$id_angkatan    =  $_GET['id_angkatan'];
$db     = $conn->query("SELECT * FROM kelas WHERE id_angkatan = '$id_angkatan'");
$result     = result($db);

     echo json_encode(array(
            "data" => $result,
             "draw" => 1,
  "recordsTotal" => count($result),
  "recordsFiltered" => count($result),
            )    
        );