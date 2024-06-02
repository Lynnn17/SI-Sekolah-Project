<?php
include "../koneksi.php";

$id_kelas    =   $_POST['id_kelas'];

$db     = $conn->query("SELECT * FROM kelas WHERE id_kelas='$id_kelas'");

echo json_encode(result($db));
