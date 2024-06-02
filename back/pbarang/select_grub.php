<?php
include "../koneksi.php";

$id_guru    =   $_GET['id_guru'];

$db     = $conn->query("SELECT * FROM pbarang.id_pbarang,guru.nama_guru, COUNT(pbarang.id_pbarang) as Jumlah_buku 
FROM pbarang INNER JOIN guru 
ON pbarang.id_guru = guru.id_guru 
GROUP BY guru.id_guru");
$result     = result($db);
 echo json_encode(array(
            "data" => $result,
             "draw" => 1,
  "recordsTotal" => count($result),
  "recordsFiltered" => count($result),
            )    
        );