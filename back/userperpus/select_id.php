<?php
include "../koneksi.php";

$id_user    =   $_POST['id_user'];

$db     = $conn->query("SELECT * FROM user WHERE id_user='$id_user'");

echo json_encode(result($db));
