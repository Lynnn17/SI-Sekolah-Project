<?php
include "../koneksi.php";



// $db     = $conn->query("SELECT * FROM siswa WHERE id_kelas = '$id_kelas'");
// $result     = result($db);

//      echo json_encode(array(
//             "data" => $result,
//              "draw" => 1,
//   "recordsTotal" => count($result),
//   "recordsFiltered" => count($result),
//             )    
//         );

$db =   $conn->query("SELECT id_pembayaran as id, nama_pembayaran as label, nama_pembayaran as value FROM pembayaran 
                   GROUP BY nama_pembayaran");
echo json_encode(result($db));