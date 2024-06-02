<?php
include "../koneksi.php";

$id_jurusan    =  $_GET['id_jurusan'];
$db     = $conn->query("SELECT * FROM guru WHERE id_jurusan = '$id_jurusan'");
$result     = result($db);
     echo json_encode(array(
            "data" => $result,
            "draw" => 1,
  "recordsTotal" => count($result),
  "recordsFiltered" => count($result),
            )    
        );
