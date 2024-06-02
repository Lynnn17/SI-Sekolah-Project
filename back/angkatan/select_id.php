<?php
include "../koneksi.php";

$id_angkatan    =   $_POST ['id_angkatan'];

$db     = $conn->query("SELECT * FROM angkatan WHERE id_angkatan='$id_angkatan'");

echo json_encode(result($db));
