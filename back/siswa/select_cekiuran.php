<?php
include "../koneksi.php";


$id_siswa    =  $_GET['id_siswa'];
$db = $conn->query("SELECT * FROM pembayaran INNER JOIN siswa ON pembayaran.id_siswa=siswa.id_siswa
                    WHERE pembayaran.id_siswa = '$id_siswa' AND pembayaran.status = 'Angsur'  
                    ");
$result     = result($db);
echo json_encode(
    array(
        "data" => $result,
        "draw" => 1,
        "recordsTotal" => count($result),
        "recordsFiltered" => count($result),
    )
);
