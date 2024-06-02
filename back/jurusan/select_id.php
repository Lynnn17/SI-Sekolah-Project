<?php
include "../koneksi.php";

$id_jurusan    =   $_POST ['id_jurusan'];

$db     = $conn->query("SELECT * FROM jurusan WHERE id_jurusan='$id_jurusan'");

echo json_encode(result($db));
