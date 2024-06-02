
<?php
include "../koneksi.php";
date_default_timezone_set('Asia/Jakarta');

$tanggal1 = date('Y-m-d 1:00:00');
$tanggal2 = date('Y-m-d 23:00:00');
$db     = $conn->query("SELECT id_record,nama_pembayaran,tanggal_dibayar, SUM(dibayar) 
as total_didapat
FROM pembayaranrecord WHERE tanggal_dibayar BETWEEN '$tanggal1' AND '$tanggal2'
GROUP BY nama_pembayaran");
// $db=$conn->query("SELECT pembayaran.id_pembayaran,pembayaran.nama_pembayaran,pembayaran.tanggal_dibayar,siswa.nama_siswa,kelas.nama_kelas
// FROM pembayaran
// INNER JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
// INNER JOIN kelas ON siswa.id_kelas= kelas.id_kelas 
// ");
$result     = result($db);
 echo json_encode(array(
            "data" => $result,
             "draw" => 1,
  "recordsTotal" => count($result),
  "recordsFiltered" => count($result),
            )    
        );