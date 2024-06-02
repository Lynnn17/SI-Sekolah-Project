<?php
$tgl1 = date($_POST['tanggal1']." 1:00:00");
$tgl2 = date($_POST['tanggal2']." 23:00:00");
$id_angkatan = $_POST['angkatan'];
$nama_pembayaran = $_POST['bayar'];
echo $tgl1;
echo $tgl2;
echo $id_angkatan;
echo $nama_pembayaran;