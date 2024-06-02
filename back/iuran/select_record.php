<?php
    include "../koneksi.php";
    
$id_pembayaran    =  $_GET['pembayaran'];
$db     = $conn->query("SELECT pembayaranrecord.id_pembayaran,pembayaranrecord.id_record,pembayaran.nama_pembayaran, pembayaranrecord.tanggal_dibayar, pembayaranrecord.dibayar, 
        pembayaranrecord.total_dibayar,pembayaranrecord.status,pembayaranrecord.admin FROM pembayaranrecord INNER JOIN pembayaran ON 
        pembayaran.id_pembayaran=pembayaranrecord.id_pembayaran 
        WHERE pembayaran.id_pembayaran = '$id_pembayaran'");


// $db     = $conn->query("SELECT * FROM pembayaranrecord INNER JOIN pembayaran ON pembayaran.nama_pembayaran=
//           pembayaranrecord.nama_pembayaran WHERE pembayaran.nama_pembayaran = '$nama_pembayaran'");

$result     = result($db);

     echo json_encode(array(
            "data" => $result,
             "draw" => 1,
  "recordsTotal" => count($result),
  "recordsFiltered" => count($result),
            )    
        );

       