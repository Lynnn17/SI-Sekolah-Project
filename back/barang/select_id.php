<?php
include "../koneksi.php";
$kode_barang    =   $_POST ['kode_barang'];
$db     = $conn->query("SELECT * FROM barang WHERE kode_barang = '$kode_barang'");
$result     = result($db);
echo json_encode(
    array(
        "data" => $result,
        "draw" => 1,
        "recordsTotal" => count($result),
        "recordsFiltered" => count($result),
    )
);
