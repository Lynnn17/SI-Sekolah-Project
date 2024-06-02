<?php
    include "../koneksi.php";

    $db     = $conn->query("SELECT * FROM jurusan");
$result     = result($db);
     echo json_encode(array(
            "data" => $result,
             "draw" => 1,
  "recordsTotal" => count($result),
  "recordsFiltered" => count($result),
            )    
        );
    //echo json_encode(array("data" => array("Tes","123")));