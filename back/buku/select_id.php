<?php
include "../koneksi.php";
$isbn    =   $_POST ['isbn'];
$db     = $conn->query("SELECT * FROM buku WHERE isbn = '$isbn'");
$result     = result($db);
echo json_encode(
    array(
        "data" => $result,
        "draw" => 1,
        "recordsTotal" => count($result),
        "recordsFiltered" => count($result),
    )
);
