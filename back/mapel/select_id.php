<?php
include "../koneksi.php";

$id_mapel    =   $_POST ['id_mapel'];

$db     = $conn->query("SELECT * FROM mapel WHERE id_mapel='$id_mapel'");

echo json_encode(result($db));
