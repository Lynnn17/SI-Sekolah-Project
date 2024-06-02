<?php
include "../koneksi.php";

$db     = $conn->query("SELECT * FROM user");

echo json_encode(result($db));
