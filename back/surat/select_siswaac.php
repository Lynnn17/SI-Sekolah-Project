<?php
include "../koneksi.php";
$id_siswa   =   $_GET["id_siswa"];


// $db     = $conn->query("SELECT * FROM siswa WHERE id_siswa = '$id_siswa'");
// $result     = result($db);

//      echo json_encode(array(
//             "data" => $result,
//              "draw" => 1,
//   "recordsTotal" => count($result),
//   "recordsFiltered" => count($result),
//             )    
//         );

$db =   $conn->query("SELECT id_siswa as id, nama_siswa as label, id_siswa as value FROM siswa
                    WHERE id_siswa = '$id_siswa'");
echo json_encode(result($db));