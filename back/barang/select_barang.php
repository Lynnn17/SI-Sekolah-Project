<?php
include "../koneksi.php";
// $id_kelas   =   $_GET["id_kelas"];


// $db     = $conn->query("SELECT * FROM siswa WHERE id_kelas = '$id_kelas'");
// $result     = result($db);

//      echo json_encode(array(
//             "data" => $result,
//              "draw" => 1,
//   "recordsTotal" => count($result),
//   "recordsFiltered" => count($result),
//             )    
//         );

$db =   $conn->query("SELECT id_barang as id, nama_barang as label,sumber as sumber, id_barang as value FROM barang");
echo json_encode(result($db));