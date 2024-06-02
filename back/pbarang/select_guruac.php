<?php
include "../koneksi.php";
$id_guru   =   $_GET["id_guru"];


// $db     = $conn->query("SELECT * FROM guru WHERE id_guru = '$id_guru'");
// $result     = result($db);

//      echo json_encode(array(
//             "data" => $result,
//              "draw" => 1,
//   "recordsTotal" => count($result),
//   "recordsFiltered" => count($result),
//             )    
//         );

$db =   $conn->query("SELECT id_guru as id, nama_guru as label, id_guru as value FROM guru
                    WHERE id_guru = '$id_guru'");
echo json_encode(result($db));