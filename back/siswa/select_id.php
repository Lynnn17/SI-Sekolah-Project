<?php
include "../koneksi.php";

// $id_siswa    =   $_POST['id_siswa'];

// $db     = $conn->query("SELECT * FROM siswa WHERE id_siswa='$id_siswa'");

// echo json_encode(result($db));

$nisn    =   $_POST ['nisn'];
$db     = $conn->query("SELECT * FROM siswa WHERE nisn = $nisn");
$result     = result($db);
echo json_encode(
    array(
        "data" => $result,
        "draw" => 1,
        "recordsTotal" => count($result),
        "recordsFiltered" => count($result),
    )
);
