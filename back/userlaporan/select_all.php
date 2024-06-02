<?php
include "../koneksi.php";

$db     = $conn->query("SELECT * FROM userlaporan");

$result     = result($db);
     echo json_encode(array(
            "data" => $result,
             "draw" => 1,
  "recordsTotal" => count($result),
  "recordsFiltered" => count($result),
            )    
        );
