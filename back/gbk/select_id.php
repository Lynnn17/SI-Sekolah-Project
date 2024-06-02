<?php
include "../koneksi.php";

$id_guru   =   $_POST ['id_guru'];

$db     = $conn->query("SELECT * FROM angkatan WHERE id_guru='$id_guru'");

echo json_encode(result($db));
